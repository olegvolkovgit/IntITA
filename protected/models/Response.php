<?php

/**
 * This is the model class for table "response".
 *
 * The followings are the available columns in table 'response':
 * @property integer $id
 * @property integer $who
 * @property string $date
 * @property string $text
 * @property integer $rate
 * @property integer $knowledge
 * @property integer $behavior
 * @property integer $motivation
 * @property string $who_ip
 * @property integer $is_checked
 *
 * The followings are the available model relations:
 * @property StudentReg $user
 */
class Response extends CActiveRecord
{
    const PUBLISHED = 1;
    const HIDDEN = 0;

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'response';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('who, date', 'required'),
            array('knowledge', 'required', 'message' => 'знання викладача', 'except' => 'emptyrating'),
            array('behavior', 'required', 'message' => 'ефективність викладача', 'except' => 'emptyrating'),
            array('motivation', 'required', 'message' => 'ставлення викладача до студента', 'except' => 'emptyrating'),
            array('text', 'filter', 'filter' => array($this, 'trimEndLines')),
            array('text', 'required', 'message' => Yii::t("response", "0544")),
            array('who, rate,  is_checked', 'numerical', 'integerOnly' => true),
            array('knowledge,behavior,motivation,who_ip', 'safe'),
            // The following rule is used by search().

            array('id, who, date, text, rate, is_checked', 'safe', 'on' => 'search'),
        );
    }

    public function trimEndLines($content){
        preg_match_all('/(.+)[^\n]/m', $content, $matches);
        return implode('',$matches[0]);
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'user' => array(self::BELONGS_TO, 'StudentReg', 'who'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'who' => 'Автор відгука',
            'date' => 'Дата',
            'text' => 'Відгук',
            'rate' => 'Оцінка',
            'is_checked' => 'Перевірено модератором',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('t.id', $this->id);
        $criteria->compare('who', $this->who);
        $criteria->compare('date', $this->date, true);
        $criteria->compare('text', $this->text, true);
        $criteria->compare('rate', $this->rate);
        $criteria->compare('knowledge', $this->knowledge);
        $criteria->compare('behavior', $this->behavior);
        $criteria->compare('motivation', $this->motivation);
        $criteria->compare('rate', $this->who_ip);
        $criteria->compare('is_checked', $this->is_checked);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => '50',
            ),
            'sort' => array(
                'defaultOrder' => array(
                    'date' => CSort::SORT_DESC,
                ),
            ),
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Response the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function bbcode_to_html($bbtext)
    {
        $bbtags = array(
            '[heading1]' => '<h1>', '[/heading1]' => '</h1>',
            '[heading2]' => '<h2>', '[/heading2]' => '</h2>',
            '[heading3]' => '<h3>', '[/heading3]' => '</h3>',
            '[h1]' => '<h1>', '[/h1]' => '</h1>',
            '[h2]' => '<h2>', '[/h2]' => '</h2>',
            '[h3]' => '<h3>', '[/h3]' => '</h3>',

            '[paragraph]' => '<p>', '[/paragraph]' => '</p>',
            '[para]' => '<p>', '[/para]' => '</p>',
            '[p]' => '<p>', '[/p]' => '</p>',
            '[left]' => '<p style="text-align:left;">', '[/left]' => '</p>',
            '[right]' => '<p style="text-align:right;">', '[/right]' => '</p>',
            '[center]' => '<p style="text-align:center;">', '[/center]' => '</p>',
            '[justify]' => '<p style="text-align:justify;">', '[/justify]' => '</p>',

            '[bold]' => '<b>', '[/bold]' => '</b>',
            '[italic]' => '<i>', '[/italic]' => '</i>',
            '[underline]' => '<u>', '[/underline]' => '</u>',
            '[b]' => '<b>', '[/b]' => '</b>',
            '[i]' => '<i>', '[/i]' => '</i>',
            '[u]' => '<u>', '[/u]' => '</u>',
            '[break]' => '<br>',
            '[br]' => '<br>',
            '[newline]' => '<br>',
            '[nl]' => '<br>',

            '[unordered_list]' => '<ul>', '[/unordered_list]' => '</ul>',
            '[list]' => '<ul>', '[/list]' => '</ul>',
            '[ul]' => '<ul>', '[/ul]' => '</ul>',

            '[ordered_list]' => '<ol>', '[/ordered_list]' => '</ol>',
            '[ol]' => '<ol>', '[/ol]' => '</ol>',
            '[list_item]' => '<li>', '[/list_item]' => '</li>',
            '[li]' => '<li>', '[/li]' => '</li>',

            '[*]' => '<li>', '[/*]' => '</li>',
            '[code]' => '<code>', '[/code]' => '</code>',
            '[preformatted]' => '<pre>', '[/preformatted]' => '</pre>',
            '[pre]' => '<pre>', '[/pre]' => '</pre>',
            '[list=1]' => '<ol>'
        );

        $bbtext = str_ireplace(array_keys($bbtags), array_values($bbtags), $bbtext);

        $bbextended = array(
            "/\[url](.*?)\[\/url]/i" => "<a href=\"http://$1\" title=\"$1\">$1</a>",
            "/\[url=(.*?)\](.*?)\[\/url\]/i" => "<a href=\"$1\" title=\"$1\">$2</a>",
            "/\[email=(.*?)\](.*?)\[\/email\]/i" => "<a href=\"mailto:$1\">$2</a>",
            "/\[mail=(.*?)\](.*?)\[\/mail\]/i" => "<a href=\"mailto:$1\">$2</a>",
            "/\[img\]([^[]*)\[\/img\]/i" => "<img src=\"$1\" alt=\" \" />",
            "/\[image\]([^[]*)\[\/image\]/i" => "<img src=\"$1\" alt=\" \" />",
            "/\[image_left\]([^[]*)\[\/image_left\]/i" => "<img src=\"$1\" alt=\" \" class=\"img_left\" />",
            "/\[image_right\]([^[]*)\[\/image_right\]/i" => "<img src=\"$1\" alt=\" \" class=\"img_right\" />",
        );

        foreach ($bbextended as $match => $replacement) {
            $bbtext = preg_replace($match, $replacement, $bbtext);
        }

        return $bbtext;
    }

    public function html_to_bbcode($text)
    {
        $bbtags = array(
            '<b>' => '[b]', '</b>' => '[/b]',
            '<i>' => '[i]', '</i>' => '[/i]',
            '<u>' => '[u]', '</u>' => '[/u]',
            
            '<ul>' => '[list]', '</ul>' => '[/list]',

            '<li>' => '[*]', '</li>' => '[/*]',
            '<code>' => '[code]', '</code>' => '[/code]',
            '<ol>' => '[list=1]'
        );

        $text = str_ireplace(array_keys($bbtags), array_values($bbtags), $text);
        
        return $text;
    }

    public function publishLabel()
    {
        return ($this->is_checked) ? 'опубліковано' : 'прихований';
    }

    public function setTeacherRating()
    {
        $teacherId = Yii::app()->db->createCommand()
            ->select('id_teacher')
            ->from('teacher_response')
            ->where('id_response=:id', array(':id' => $this->id))
            ->queryScalar();

        $user = StudentReg::model()->findByPk($teacherId);
        $responsesIdList = $user->getTeachersResponseId();
        Teacher::setAverageTeacherRatings($teacherId, $responsesIdList);
    }

    public function getResponseAboutTeacherName()
    {
        $name = Yii::app()->db->createCommand()
            ->select('u.firstName, u.secondName, u.middleName')
            ->from('teacher_response tr')
            ->join('user u', 'u.id=tr.id_teacher')
            ->where('id_response=:id', array(':id' => $this->id))
            ->queryRow();

        return (!empty($name)) ? implode(" ", $name) : 'викладача видалено';
    }

    public function getTeacherId()
    {
        $teacherId = Yii::app()->db->createCommand()
            ->select('id_teacher')
            ->from('teacher_response')
            ->where('id_response=:id', array(':id' => $this->id))
            ->queryScalar();
        return $teacherId;
    }

    public function getResponseAuthorName()
    {
        $model = StudentReg::model()->findByPk($this->who);
        $name = $model->firstName . " " . $model->secondName;
        if ($name == " ") return $model->email;
        else return $name . ", " . $model->email;
    }

    public function timeDesc()
    {
        return date("d.m.Y", strtotime($this->date));
    }

    public function setPublish()
    {
        $this->is_checked = Response::PUBLISHED;
        return $this->save();
    }

    public function setHidden()
    {
        $this->is_checked = Response::HIDDEN;
        return $this->save();
    }

    public static function getTeacherResponsesData()
    {
        $users = Response::model()->findAll();
        $return = array('data' => array());
        foreach ($users as $record) {
            $row = array();
            $row["author"] = $record->getResponseAuthorName();
            $row["about"] = $record->getResponseAboutTeacherName();
            $row["date"] = $record->timeDesc();
            $row["response"]["text"] = strip_tags ($record->text);
            $row["rate"] = $record->rate;
            $row["response"]["link"] = "'" . Yii::app()->createUrl("/_teacher/_admin/response/view", array("id" => $record->id)) . "'";
            $row["publish"] = $record->publishLabel();

            array_push($return['data'], $row);
        }
        return json_encode($return);
    }

    public function isChecked()
    {
        return $this->is_checked == Response::PUBLISHED;
    }
}
