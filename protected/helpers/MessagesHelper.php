<?php


class MessagesHelper
{
    public static function getMessageCategory($id){
        return Sourcemessages::model()->findByPk($id)->category;
    }

    public static function getMessageCommentById($code){
        $comment = Yii::app()->db->createCommand()
            ->select('comment')
            ->from('message_comment')
            ->where('message_code=:code', array(':code' => $code))
            ->queryRow();
        return ($comment)?$comment:'';
    }
}
?>

}