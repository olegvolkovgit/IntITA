<?php

class ContractingPartyBuilder {

    const CORPORATE_ENTITY = 1;
    const PRIVATE_ENTREPRENEUR = 2;
    const PRIVATE_PERSON = 3;

    /**
     * @param CorporateEntity $entity
     * @param CheckingAccounts $account
     * @return ContractingParty
     * @throws Exception
     */
    public function makeCorporateEntity(CorporateEntity $entity, CheckingAccounts $account) {
        $transaction = Yii::app()->db->beginTransaction();
        try {
            $contractingParty = $this->createContractingParty(self::CORPORATE_ENTITY);
            $this->createContractingPartyCorporateEntity($contractingParty, $entity, $account);
            $this->createContractingPartyCorporateEntityRepresentatives($contractingParty, $entity->actualRepresentatives);
            $transaction->commit();
            return $contractingParty;
        } catch (Exception $error) {
            $transaction->rollback();
            throw $error;
        }
    }

    /**
     * @return ContractingParty
     * @param $type
     * @throws Exception
     */
    private function createContractingParty($type) {
        $contractingParty = new ContractingParty();
        $contractingParty->type_id = $type;

        if (!$contractingParty->save()) {
            throw new Exception("Unable to save Contracting Party");
        };
        return $contractingParty;
    }

    /**
     * @param ContractingParty $contractingParty
     * @param CorporateEntity $entity
     * @param CheckingAccounts $account
     * @return ContractingParty
     * @throws Exception
     */
    private function createContractingPartyCorporateEntity(ContractingParty $contractingParty, CorporateEntity $entity, CheckingAccounts $account){
        $contractingPartyCE = new ContractingPartyCorporateEntity();
        $contractingPartyCE->id = $contractingParty->id;
        $contractingPartyCE->corporate_entity_id = $entity->id;
        $contractingPartyCE->checking_account_id = $account->id;
        $contractingPartyCE->save();

        if (!$contractingPartyCE->save()) {
            throw new Exception("Unable to save Contracting Party Corporate Entity");
        };
        return $contractingParty;
    }

    /**
     * @param ContractingParty $contractingParty
     * @param CorporateEntityRepresentatives[] $representatives
     * @throws Exception
     */
    private function createContractingPartyCorporateEntityRepresentatives(ContractingParty $contractingParty, $representatives) {
        foreach ($representatives as $representative) {
            $contractingPartyRepresentative = new ContractingPartyCorporateEntityRepresentatives();
            $contractingPartyRepresentative->contracting_party_id = $contractingParty->id;
            $contractingPartyRepresentative->corporate_representative_id = $representative->corporate_representative;
            if (!$contractingPartyRepresentative->save()) {
                throw new Exception("Unable to save Contracting party representative");
            }
        }
    }

    /**
     * @param StudentReg $user
     * @return ContractingParty
     * @throws Exception
     */
    public function makePrivatePerson(StudentReg $user) {
        $transaction = null;
        if (Yii::app()->db->getCurrentTransaction() == null) {
            $transaction = Yii::app()->db->beginTransaction();
        }
        try {
            $contractingParty = $this->createContractingParty(self::PRIVATE_PERSON);
            $this->createContractingPartyPrivatePerson($contractingParty, $user);
            $this->createContractingPartyPrivatePersonDocuments($contractingParty, $user);
            if ($transaction) {
                $transaction->commit();
            }
            return $contractingParty;
        } catch (Exception $error) {
            if ($transaction) {
                $transaction->rollback();
            }
            throw $error;
        }
    }

    /**
     * @param ContractingParty $contractingParty
     * @param StudentReg $user
     * @return ContractingParty
     * @throws Exception
     */
    private function createContractingPartyPrivatePerson(ContractingParty $contractingParty, StudentReg $user){
        $contractingPartyPP = new ContractingPartyPrivatePerson();
        $contractingPartyPP->id = $contractingParty->id;
        $contractingPartyPP->user_id = $user->id;
        $contractingPartyPP->save();

        if (!$contractingPartyPP->save()) {
            throw new Exception("Unable to save Contracting Party Private Person");
        };
        return $contractingParty;
    }

    /**
     * @param ContractingParty $contractingParty
     * @param StudentReg $user
     * @throws Exception
     */
    private function createContractingPartyPrivatePersonDocuments(ContractingParty $contractingParty, $user) {

        foreach ($user->getActualUserDocuments() as $documents) {
            $contractingPartyUserDocuments = new ContractingPartyUserDocuments();
            $contractingPartyUserDocuments->id_contracting_party = $contractingParty->id;
            $contractingPartyUserDocuments->id_documents = $documents->id;
            $contractingPartyUserDocuments->checked_by = Yii::app()->user->getId();
            if (!$contractingPartyUserDocuments->save()) {
                throw new Exception("Unable to save Contracting party private person documents");
            }
        }
    }
}