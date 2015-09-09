<?php


class MessagesHelper
{
    public static function getMessageCategory($id){
        return Sourcemessages::model()->findByPk($id)->category;
    }

    public static function getMessageCommentById($code){
        if (MessageComment::model()->exists('message_code=:code', array(':code' => $code))){
            return MessageComment::model()->findByPk($code)->comment;
        } else {
            return '';
        }

    }
}
?>

}