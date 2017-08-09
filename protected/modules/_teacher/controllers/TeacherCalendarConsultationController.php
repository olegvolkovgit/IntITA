<?php

class TeacherCalendarConsultationController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}

    public function actionCalendarConsultations(){
        $this->renderPartial('/_teacher_consultant/calendar_consultations/index', array(), false, true);
    }

    public function actionGetTeacherCalendarConsultation(){
        $year = $_POST['year'];
        $month = $_POST['month'];
        $id_teacher = Yii::app()->user->getId();

        echo TeacherCalendarConsultation::getCalendarConsultation($id_teacher, $year, $month);
    }

    public function actionSaveTimeConsultation(){
        $data = $_POST;

        foreach($data as $item){
            for($i=0; $i<count($item); $i++){
                $timeConsultation = new TeacherCalendarConsultation();
                $timeConsultation->year = $item[$i]['year'];
                $timeConsultation->month = $item[$i]['month'];
                $timeConsultation->start_time = $item[$i]['start_time'];
                $timeConsultation->end_time = $item[$i]['end_time'];
                $timeConsultation->date = $item[$i]['date'];

                $timeConsultation->status = 2;    // for test
//                $timeConsultation->status = $item[$i]['status'];

//                $timeConsultation->teacher_id = 319;  // for test
                $timeConsultation->teacher_id = Yii::app()->user->getId();

//                $timeConsultation->user_id = 40;  // for test
//                $timeConsultation->lecture_id = 704;  // for test

                $timeConsultation->save();
            }
        };
    }

    public function actionApproveTimeConsultation(){
        $approve_times = $_POST;
        $params = array();
        foreach($approve_times as $item){
            $item_length = count($item);
            for($i=0; $i<$item_length; $i++){

                if( $i == $item_length-1 ) {
                    $array = $item[$i]['map'];
                    $keys = array_keys($array);

                    for($j=0; $j < count($keys); ++$j) {
                        $id_teacher = Yii::app()->user->getId();
                        $teacher = StudentReg::model()->findByPk($id_teacher);
                        $student = StudentReg::model()->findByPk($keys[$j]);
                        $params[0] = $array[$keys[$j]];
                        $params[1] = $teacher->fullName;
                        $student->notify('_confirmConsultation', array($params), 'Підтверджено консультацію');
                    }
                } else {
                    $id = $item[$i];
                    $approve_time = TeacherCalendarConsultation::model()->findByPk($id);
                    $approve_time->status = 3;
                    $approve_time->save();
                }
            }
        }
    }

    public function actionDeleteTimeConsultation(){

        $del_time_arr = $_POST;
        $params = array();
        foreach($del_time_arr as $item){
            for($i=0; $i<count($item[0]); $i++){

                if( $i == count($item[0])-1 ){
                    if( !empty($item[0]['map']) ){
                        $array = $item[0]['map'];
                        $keys = array_keys($array);
                        for($j=0; $j < count($keys); ++$j) {
                            $id_teacher = Yii::app()->user->getId();
                            $teacher = StudentReg::model()->findByPk($id_teacher);
                            $student = StudentReg::model()->findByPk($keys[$j]);
                            $params[0] = $array[$keys[$j]];
                            $params[1] = $teacher->fullName;
                            $student->notify('_denyConsultation', array($params), 'Скасовано консультацію');
                        }
                    } else {
                        $id = $item[0][$i];
                        $delete_time = TeacherCalendarConsultation::model()->findByPk($id);
                        $delete_time->delete();
                    }
                } else {
                    $id = $item[0][$i];
                    $delete_time = TeacherCalendarConsultation::model()->findByPk($id);
                    $delete_time->delete();
                }
            }
        }
    }
}