<?php

/**
 * This is the model class for table "students_projects".
 *
 * The followings are the available columns in table 'students_projects':
 * @property integer $id
 * @property integer $id_student
 * @property string $title
 * @property string $repository
 * @property string $branch
 * @property integer $need_check
 *
 * The followings are the available model relations:
 * @property User $idStudent
 */
class StudentsProjects extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'students_projects';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_student, title, repository, branch', 'required'),
			array('id_student, need_check', 'numerical', 'integerOnly'=>true),
			array('title, repository, branch', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_student, title, repository, branch, need_check', 'safe', 'on'=>'search'),
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
			'idStudent' => array(self::BELONGS_TO, 'StudentReg', 'id_student'),
            'studentTrainer' => array(self::HAS_ONE, 'TrainerStudent', array('student'=>'id_student'),
                'on' => 'end_time IS NULL'),
            'trainer' => [self::BELONGS_TO,  'StudentReg', ['trainer' => 'id'], 'through' => 'studentTrainer'],
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_student' => 'Id Student',
			'title' => 'Title',
			'repository' => 'Repository',
			'branch' => 'Branch',
			'need_check' => 'Need Check',
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
		$criteria->compare('id_student',$this->id_student);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('repository',$this->repository,true);
		$criteria->compare('branch',$this->branch,true);
		$criteria->compare('need_check',$this->need_check);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return StudentsProjects the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function pullProject(){
        $dir = Config::getTempProjectsPath()."/{$this->id_student}/{$this->title}/{$this->branch}";
        if (!is_dir($dir)){
            mkdir($dir,0644, true);
        }
            exec("cd {$dir} && git clone {$this->repository} {$dir}");
        $files = scandir($dir);
        return $files;
    }

    public function approveProject(){
        $projectDir = Config::getTempProjectsPath()."/{$this->id_student}/{$this->title}/{$this->branch}";
        $destDir =  Config::getRealProjectsPath().'/'.$this->id_student;
        if (!is_dir($destDir))
            mkdir($destDir,0644, true);
        exec("rsync -a --exclude '.git' {$projectDir} {$destDir}");
        $this->need_check = 0;
        $this->save();
    }

    public function showFiles(){
        $dir = Config::getTempProjectsPath()."/{$this->id_student}/{$this->title}/{$this->branch}";
        $files = $this->scanDir($dir);
        return $files;
    }

    private function scanDir($dir){

        $result = array();

        $cdir = scandir($dir);
        foreach ($cdir as $key => $value) {
            if (!in_array($value, array(".", "..",".git" ))) {
                if (is_dir($dir . DIRECTORY_SEPARATOR . $value)) {
                    $result[] = ['path'=>$dir, 'name'=>$value, 'children' => $this->scanDir($dir . DIRECTORY_SEPARATOR . $value)];
                } else {
                    $result[] = ['path'=>$dir, 'name'=>$value, 'children' => []];
                }
            }
        }
        return $result;
    }

    public function showFileContent($file){
        return htmlentities(file_get_contents($file));
    }
}
