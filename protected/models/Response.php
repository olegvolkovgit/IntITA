<?php

/**
 * This is the model class for table "response".
 *
 * The followings are the available columns in table 'response':
 * @property integer $id
 * @property integer $who
 * @property integer $about
 * @property string $date
 * @property string $text
 * @property integer $rate
 * @property integer $knowledge
 * @property integer $behavior
 * @property integer $motivation
 * @property string $who_ip
 *
 * The followings are the available model relations:
 * @property User $who0
 * @property User $about0
 */
class Response extends CActiveRecord
{
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
			array('who, about, date', 'required'),
            array('knowledge', 'required', 'message'=>'знання викладача'),
            array('behavior', 'required', 'message'=>'ефективність викладача'),
            array('motivation', 'required', 'message'=>'ставлення викладача до студента'),
            array('text', 'required', 'message'=>'Відгук не може бути пустим'),
			array('who, about, rate', 'numerical', 'integerOnly'=>true),
            array('knowledge,behavior,motivation,who_ip','safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, who, about, date, text, rate', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'who0' => array(self::BELONGS_TO, 'User', 'who'),
			'about0' => array(self::BELONGS_TO, 'User', 'about'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'who' => 'Who',
			'about' => 'About',
			'date' => 'Date',
			'text' => 'Text',
			'rate' => 'Rate',
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
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('who',$this->who);
		$criteria->compare('about',$this->about);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('text',$this->text,true);
		$criteria->compare('rate',$this->rate);
        $criteria->compare('rate',$this->knowledge);
        $criteria->compare('rate',$this->behavior);
        $criteria->compare('rate',$this->motivation);
        $criteria->compare('rate',$this->who_ip);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Response the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function bbcode_to_html($bbtext){
        $bbtags = array(
            '[heading1]' => '<h1>','[/heading1]' => '</h1>',
            '[heading2]' => '<h2>','[/heading2]' => '</h2>',
            '[heading3]' => '<h3>','[/heading3]' => '</h3>',
            '[h1]' => '<h1>','[/h1]' => '</h1>',
            '[h2]' => '<h2>','[/h2]' => '</h2>',
            '[h3]' => '<h3>','[/h3]' => '</h3>',

            '[paragraph]' => '<p>','[/paragraph]' => '</p>',
            '[para]' => '<p>','[/para]' => '</p>',
            '[p]' => '<p>','[/p]' => '</p>',
            '[left]' => '<p style="text-align:left;">','[/left]' => '</p>',
            '[right]' => '<p style="text-align:right;">','[/right]' => '</p>',
            '[center]' => '<p style="text-align:center;">','[/center]' => '</p>',
            '[justify]' => '<p style="text-align:justify;">','[/justify]' => '</p>',

            '[bold]' => '<span style="font-weight:bold;">','[/bold]' => '</span>',
            '[italic]' => '<span style="font-weight:bold;">','[/italic]' => '</span>',
            '[underline]' => '<span style="text-decoration:underline;">','[/underline]' => '</span>',
            '[b]' => '<span style="font-weight:bold;">','[/b]' => '</span>',
            '[i]' => '<span style="font-weight:bold;">','[/i]' => '</span>',
            '[u]' => '<span style="text-decoration:underline;">','[/u]' => '</span>',
            '[break]' => '<br>',
            '[br]' => '<br>',
            '[newline]' => '<br>',
            '[nl]' => '<br>',

            '[unordered_list]' => '<ul>','[/unordered_list]' => '</ul>',
            '[list]' => '<ul>','[/list]' => '</ul>',
            '[ul]' => '<ul>','[/ul]' => '</ul>',

            '[ordered_list]' => '<ol>','[/ordered_list]' => '</ol>',
            '[ol]' => '<ol>','[/ol]' => '</ol>',
            '[list_item]' => '<li>','[/list_item]' => '</li>',
            '[li]' => '<li>','[/li]' => '</li>',

            '[*]' => '<li>','[/*]' => '</li>',
            '[code]' => '<code>','[/code]' => '</code>',
            '[preformatted]' => '<pre>','[/preformatted]' => '</pre>',
            '[pre]' => '<pre>','[/pre]' => '</pre>',
            '[list=1]'=>'<ul>'
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

        foreach($bbextended as $match=>$replacement){
            $bbtext = preg_replace($match, $replacement, $bbtext);
        }
        return $bbtext;
    }
}
