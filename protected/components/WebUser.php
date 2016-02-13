<?php


class WebUser extends CWebUser
{
    protected $_roles = null;
    protected $_model;

    /**
     *
     * @return roles array
     */
    public function getRoles()
    {
        if ($this->_roles === null) {
            if ($user = $this->getModel()) {
                $this->_roles = $user->roles();
            }
        }
        return $this->_roles;
    }

    /**
     *
     * @return StudentReg
     */
    public function getModel()
    {
        if (!$this->isGuest && $this->_model === null) {
            $this->_model = StudentReg::model()->findByPk($this->getId());

        }
        return $this->_model;
    }
}