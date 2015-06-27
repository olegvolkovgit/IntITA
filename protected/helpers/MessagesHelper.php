<?php


class MessagesHelper
{
    public static function getMessageCategory($id){
        return Sourcemessages::model()->findByPk($id)->category;
    }
}
?>

}