<?php

class m160621_120111_fix_requests_approved_time extends CDbMigration
{
	public function safeUp()
	{
        // +02:00 - CET, (database on qa.intita.com, intita.com current timezone)
		$sqlTeacherConsultantRequest = 'update messages_teacher_consultant_request set date_approved = CONVERT_TZ(date_approved,\'+00:00\',\'+02:00\');';
        $sqlAuthorRequest = 'update messages_author_request set date_approved = CONVERT_TZ(date_approved,\'+00:00\',\'+02:00\');';
        $sqlCoworkerRequest = 'update messages_coworker_request set date_approved = CONVERT_TZ(date_approved,\'+00:00\',\'+02:00\');';
        $sqlRevisionRequest = 'update messages_revision_request set date_approved = CONVERT_TZ(date_approved,\'+00:00\',\'+02:00\');';

        $this->execute($sqlAuthorRequest);
        $this->execute($sqlCoworkerRequest);
        $this->execute($sqlRevisionRequest);
        $this->execute($sqlTeacherConsultantRequest);
    }

	public function down()
	{
		echo "m160621_120111_fix_requests_approved_time does not support migration down.\n";
		return false;
	}
}