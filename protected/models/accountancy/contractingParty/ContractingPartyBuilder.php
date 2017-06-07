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
            $contractingParty = $this->createContractingParty();
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
     * @throws Exception
     */
    private function createContractingParty() {
        $contractingParty = new ContractingParty();
        $contractingParty->type_id = self::CORPORATE_ENTITY;

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

        if (!$contractingParty->save()) {
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
}