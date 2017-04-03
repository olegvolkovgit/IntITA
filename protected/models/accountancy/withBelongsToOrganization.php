<?php

/**
 * Trait withBelongsToOrganization
 */
trait withBelongsToOrganization {

    /**
     * The method should return CDBCriteria to select entity belong to organisation
     * @param Organization $organization
     * @return CDbCriteria
     */
    abstract public function getOrganizationCriteria(Organization $organization);

    public function belongsToOrganization(Organization $organization = null) {
        if ($organization) {
            $this->getDbCriteria()->mergeWith($this->getOrganizationCriteria($organization));
        }
        return $this;
    }

}