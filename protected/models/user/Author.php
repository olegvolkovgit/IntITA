<?php

class Author extends Role
{
    private $dbModel;
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return "";
    }

    /**
     * @return string the role title (ua)
     */
    public function title(){
        return 'Автор';
    }

    public function attributes(StudentReg $user)
    {
        // TODO: Implement attributes() method.
    }

    public  function cancelAttribute(StudentReg $user, $attribute, $value)
    {
        return false;
    }
}