<?php

/**
 * This is the model class for table "acc_user_written_agreement".
 *
 * The followings are the available columns in table 'acc_user_written_agreement':
 * @property integer $id
 * @property integer $id_agreement
 * @property string $html_for_edit
 * @property string $html_for_pdf
 * @property integer $checked_by_user
 * @property integer $checked_by_accountant
 * @property integer $checked
 * @property integer $checked_by
 * @property string $updatedAt
 * @property integer $actual
 * @property string $checked_date
 *
 * The followings are the available model relations:
 * @property UserAgreements $agreement
 * @property StudentReg $idUser
 */
class UserWrittenAgreement extends CActiveRecord
{
    const NOT_ACTUAL = 0;
    const ACTUAL = 1;
    const CHECKED = 1;
    const NOT_CHECKED = 0;

    private $requestToApproveAgreement = 'accountant'. DIRECTORY_SEPARATOR . '_requestToApproveAgreement';
    private $generatedAgreement = 'accountant'. DIRECTORY_SEPARATOR . '_generatedAgreement';

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'acc_user_written_agreement';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_agreement', 'required'),
			array('id_agreement, checked_by_user, checked_by_accountant, checked, checked_by, actual', 'numerical', 'integerOnly'=>true),
			array('html_for_edit, checked_date, html_for_pdf', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_agreement, html_for_edit, html_for_pdf, checked_by_user, checked_by_accountant, checked, checked_by, updatedAt, actual, checked_date', 'safe', 'on'=>'search'),
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
			'agreement' => array(self::BELONGS_TO, 'UserAgreements', 'id_agreement'),
            'service' => array(self::BELONGS_TO, 'Service', ['id' => 'service_id'], 'through' => 'agreement'),
            'user' => array(self::BELONGS_TO, 'StudentReg', ['user_id' => 'id'], 'through' => 'agreement'),
            'lastEditedUserDocument' => [self::HAS_ONE, 'UserDocuments', ['id' => 'id_user'], 'scopes' => 'lastEditedDocuments', 'through' => 'user']
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_agreement' => 'Id Agreement',
			'html_for_edit' => 'Html For Edit',
            'html_for_pdf' => 'Html For Pdf',
			'checked_by_user' => 'Checked By User',
            'checked_by_accountant' => 'Checked By Accountant',
			'checked' => 'Checked',
			'checked_by' => 'Checked By',
			'updatedAt' => 'Updated At',
			'actual' => 'Actual',
			'checked_date' => 'Checked Date',
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
		$criteria->compare('id_agreement',$this->id_agreement);
		$criteria->compare('html_for_edit',$this->html_for_edit,true);
        $criteria->compare('html_for_pdf',$this->html_for_pdf,true);
		$criteria->compare('checked_by_user',$this->checked_by_user);
        $criteria->compare('checked_by_accountant',$this->checked_by_accountant);
		$criteria->compare('checked',$this->checked);
		$criteria->compare('checked_by',$this->checked_by);
		$criteria->compare('updatedAt',$this->updatedAt,true);
		$criteria->compare('actual',$this->actual);
		$criteria->compare('checked_date',$this->checked_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserWrittenAgreement the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function scopes() {
        return [
            'actualAgreement' => [
                'alias'=>'aa',
                'condition' => 'aa.actual='.self::ACTUAL,
            ]
        ];
    }

    public function saveAgreementPdf(){
        $pdf = Yii::app()->ePdf->mpdf();
        $pdf->AddPage('', // L - landscape, P - portrait
            '', '', '', '',
            25, // margin_left
            15, // margin right
            10, // margin top
            10, // margin bottom
            0, // margin header
            0); // margin footer
        $pdf->setFooter('{PAGENO}');
        $stylesheet = file_get_contents(StaticFilesHelper::fullPathTo('css', '/_teacher/agreementPdf.css')); // external css
        $pdf->WriteHTML($stylesheet,1);
        $pdf->WriteHTML($this->html_for_pdf, 2);

        if (!file_exists(Yii::app()->basePath . "/../files/documents/agreements/".$this->agreement->user_id)) {
            mkdir(Yii::app()->basePath . "/../files/documents/agreements/".$this->agreement->user_id);
        }

        $filename=Yii::getpathOfAlias('webroot').'/files/documents/agreements/'.$this->agreement->user_id.'/a'.$this->id_agreement.'.pdf';
        $pdf->Output($filename,'F');
    }

    public function notifyUserAboutAgreementRequest()
    {
        $this->notify($this->agreement->user, 'Запит на підтвердження паперового договору', $this->requestToApproveAgreement,
            array($this->agreement));
        return "Операцію успішно виконано.";
    }

    public function notifyUserAboutGenerateAgreement()
    {
        $this->notify($this->agreement->user, 'Згенеровано паперовий договір', $this->generatedAgreement,
            array($this->agreement));
        return "Операцію успішно виконано.";
    }

    public function notify(StudentReg $user, $subject, $template, $params)
    {
        $transaction = null;
        if (Yii::app()->db->getCurrentTransaction() == null) {
            $transaction = Yii::app()->db->beginTransaction();
        }
        try {
            $message = new MessagesNotifications();
            $sender = new MailTransport();
            $sender->renderBodyTemplate($template, $params);
            $message->build($subject, $sender->template(), array($user), StudentReg::model()->findByPk(Yii::app()->user->getId()));
            $message->create();

            $message->send($sender);
            if ($transaction) {
                $transaction->commit();
            }
        } catch (Exception $e) {
            if ($transaction) {
                $transaction->rollback();
            }
            throw new \application\components\Exceptions\IntItaException(500, "Повідомлення не вдалося надіслати.");
        }
    }

}
