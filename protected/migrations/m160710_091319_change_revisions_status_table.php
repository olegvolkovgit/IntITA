<?php

class m160710_091319_change_revisions_status_table extends CDbMigration {

    private function addTranslate($id, $category, $message, $translates) {
        $this->insert('sourcemessages', [
            'id' => $id,
            'category' => $category,
            'message' => $message
        ]);

        foreach ($translates as $lang => $translation) {
            $this->insert('translate',
                [
                    'id' => $id,
                    'language' => $lang,
                    'translation' => $translation
                ]);
        }

    }

    private function transform($idRevision, $stateId, $userId, $date) {
        return [
            'id_revision' => $idRevision,
            'id_state' => $stateId,
            'id_user' => $userId,
            'change_date' => $date
        ];
    }

    private function getRevisionsUnitData($fields, $table, $propertiesTable) {
        $query = 'SELECT ' .implode (',', $fields). ' FROM ' . $table . ' t
                    INNER JOIN ' . $propertiesTable . ' p ON p.id = t.id_properties';
        return $this->dbConnection->createCommand($query)->queryAll();
    }

    private function createNewFields($newHistoryTable, $oldPropertiesTable) {
        $this->createTable($newHistoryTable, [
            'id' => 'INT(10) AUTO_INCREMENT PRIMARY KEY',
            'id_revision' => 'INT(10) NOT NULL',
            'id_state' => 'INT(10) NOT NULL',
            'id_user' => 'INT NOT NULL',
            'change_date' => 'DATETIME DEFAULT CURRENT_TIMESTAMP'
        ]);

        $this->addColumn($oldPropertiesTable, 'id_state', 'INT(10) NOT NULL');
        $this->addColumn($oldPropertiesTable, 'id_user', 'INT NOT NULL');
        $this->addColumn($oldPropertiesTable, 'change_date', 'DATETIME DEFAULT CURRENT_TIMESTAMP');
    }

    private function transformAndSave($lecturesData, $historyTable, $propertyTable, $idRevisionKey, $checkReleaseDate) {
        foreach ($lecturesData as $lectureData) {
            $newFormatData = [];
            $idRevision = $lectureData[$idRevisionKey];
            $idProperties = $lectureData['id_properties'];

            if ($lectureData['id_user_created'] && $lectureData['start_date']) {
                array_push($newFormatData, $this->transform($idRevision, 1, $lectureData['id_user_created'], $lectureData['start_date']));
            }

            if ($lectureData['id_user_sended_approval'] && $lectureData['send_approval_date']) {
                array_push($newFormatData, $this->transform($idRevision, 3, $lectureData['id_user_sended_approval'], $lectureData['send_approval_date']));
            }

            if ($lectureData['id_user_rejected'] && $lectureData['reject_date']) {
                array_push($newFormatData, $this->transform($idRevision, 4, $lectureData['id_user_rejected'], $lectureData['reject_date']));
            }

            if ($lectureData['id_user_approved'] && $lectureData['approve_date']) {
                array_push($newFormatData, $this->transform($idRevision, 5, $lectureData['id_user_approved'], $lectureData['approve_date']));
            }

            if ($lectureData['id_user_cancelled'] && $lectureData['end_date']) {
                if ($checkReleaseDate  && !($lectureData['id_user_released'] && $lectureData['release_date'])) {
                    array_push($newFormatData, $this->transform($idRevision, 8, $lectureData['id_user_cancelled'], $lectureData['end_date']));

                } else if (!$checkReleaseDate) {
                    array_push($newFormatData, $this->transform($idRevision, 8, $lectureData['id_user_cancelled'], $lectureData['end_date']));

                }
            }

            if ($lectureData['id_user_released'] && $lectureData['release_date']) {
                array_push($newFormatData, $this->transform($idRevision, 7, $lectureData['id_user_released'], $lectureData['release_date']));
            }

            if ($lectureData['id_user_cancelled_edit'] && $lectureData['cancel_edit_date']) {
                array_push($newFormatData, $this->transform($idRevision, 2, $lectureData['id_user_cancelled_edit'], $lectureData['cancel_edit_date']));
            }

            if (array_key_exists('id_user_proposed_to_release', $lectureData) &&
                array_key_exists('proposed_to_release_date', $lectureData) &&
                $lectureData['id_user_proposed_to_release'] && $lectureData['proposed_to_release_date']) {
                array_push($newFormatData, $this->transform($idRevision, 6, $lectureData['id_user_proposed_to_release'], $lectureData['proposed_to_release_date']));
            }

            /*
             * Determine current state to record into properties
             * While searching max date we should consider the lectures which was copied into other module and
             * the have 'start_date' greater than 'release_date' or 'approve_date' ($state['id_state'] != 1)
             */

            $maxDateState = ['change_date' => null];
            foreach ($newFormatData as $state) {
                if (($maxDateState['change_date'] === null && $state['id_state'] != 1) ||
                    (date($state['change_date']) >= date($maxDateState['change_date']) && $state['id_state'] != 1)) {
                    $maxDateState['id_state'] = $state['id_state'];
                    $maxDateState['id_user'] = $state['id_user'];
                    $maxDateState['change_date'] = $state['change_date'];
                }
            }

            /*
             * If $maxDateState['change_date'] === null then we haven't find any state except editable ("1")
             */
            if ($maxDateState['change_date'] === null) {
                $maxDateState['id_state'] = $newFormatData[0]['id_state'];
                $maxDateState['id_user'] = $newFormatData[0]['id_user'];
                $maxDateState['change_date'] = $newFormatData[0]['change_date'];
            }


            /*
             * Save history in new format
             */
            $this->insertMultiple($historyTable, $newFormatData);
            $this->update($propertyTable, $maxDateState, 'id=:idProperties', ['idProperties' => $idProperties]);
        }
    }

    public function safeUp() {

        /*
         * Adding translations for lecture
         */
        $this->addTranslate(871, 'revision', 'RevisionLectureEditableState',
            [
                'ua' => 'Доступна для редагування',
                'ru' => 'Доступная для редактирования',
                'en' => 'Editable'
            ]);
        $this->addTranslate(872, 'revision', 'RevisionLectureCancelledAuthorState',
            [
                'ua' => 'Скасована автором',
                'ru' => 'Отменен автором',
                'en' => 'Canceled by the author'
            ]);
        $this->addTranslate(873, 'revision', 'RevisionLectureSendForApprovalState',
            [
                'ua' => 'Відправлена на затвердження',
                'ru' => 'Отправлена на утверждение',
                'en' => 'Send for approval'
            ]);
        $this->addTranslate(874, 'revision', 'RevisionLectureRejectedState',
            [
                'ua' => 'Відхилена',
                'ru' => 'Отклонена',
                'en' => 'Rejected'
            ]);
        $this->addTranslate(875, 'revision', 'RevisionLectureApprovedState',
            [
                'ua' => 'Затверджена',
                'ru' => 'Утверждена',
                'en' => 'Approved'
            ]);
        $this->addTranslate(876, 'revision', 'RevisionLectureReadyForReleaseState',
            [
                'ua' => 'Готова до релізу',
                'ru' => 'Готова к релизу',
                'en' => 'Ready for release'
            ]);
        $this->addTranslate(877, 'revision', 'RevisionLectureReleasedState',
            [
                'ua' => 'Реліз',
                'ru' => 'Релиз',
                'en' => 'Released'
            ]);
        $this->addTranslate(878, 'revision', 'RevisionLectureCancelledState',
            [
                'ua' => 'Скасована',
                'ru' => 'Отменена',
                'en' => 'Cancelled'
            ]);

        /*
         * Adding translations for module
         */
        $this->addTranslate(879, 'revision', 'RevisionModuleEditableState',
            [
                'ua' => 'Доступний для редагування',
                'ru' => 'Доступный для редактирования',
                'en' => 'Editable'
            ]);
        $this->addTranslate(880, 'revision', 'RevisionModuleCancelledAuthorState',
            [
                'ua' => 'Скасований автором',
                'ru' => 'Отменен автором',
                'en' => 'Canceled by the author'
            ]);
        $this->addTranslate(881, 'revision', 'RevisionModuleSendForApprovalState',
            [
                'ua' => 'Відправлен на затвердження',
                'ru' => 'Отправлен на утверждение',
                'en' => 'Send for approval'
            ]);
        $this->addTranslate(882, 'revision', 'RevisionModuleRejectedState',
            [
                'ua' => 'Відхилений',
                'ru' => 'Отклонен',
                'en' => 'Rejected'
            ]);
        $this->addTranslate(883, 'revision', 'RevisionModuleApprovedState',
            [
                'ua' => 'Затверджений',
                'ru' => 'Утвержден',
                'en' => 'Approved'
            ]);
        $this->addTranslate(884, 'revision', 'RevisionModuleReleasedState',
            [
                'ua' => 'Реліз',
                'ru' => 'Релиз',
                'en' => 'Released'
            ]);
        $this->addTranslate(885, 'revision', 'RevisionModuleCancelledState',
            [
                'ua' => 'Скасований',
                'ru' => 'Отменен',
                'en' => 'Cancelled'
            ]);

        /*
         * Adding translations for course
         */

        $this->addTranslate(886, 'revision', 'RevisionCourseEditableState',
            [
                'ua' => 'Доступний для редагування',
                'ru' => 'Доступный для редактирования',
                'en' => 'Editable'
            ]);
        $this->addTranslate(887, 'revision', 'RevisionCourseSendForApprovalState',
            [
                'ua' => 'Відправлен на затвердження',
                'ru' => 'Отправлен на утверждение',
                'en' => 'Send for approval'
            ]);
        $this->addTranslate(888, 'revision', 'RevisionCourseRejectedState',
            [
                'ua' => 'Відхилен',
                'ru' => 'Отклонен',
                'en' => 'Rejected'
            ]);
        $this->addTranslate(889, 'revision', 'RevisionCourseApprovedState',
            [
                'ua' => 'Затверджен',
                'ru' => 'Утвержден',
                'en' => 'Approved'
            ]);
        $this->addTranslate(890, 'revision', 'RevisionCourseReleasedState',
            [
                'ua' => 'Реліз',
                'ru' => 'Релиз',
                'en' => 'Released'
            ]);
        $this->addTranslate(891, 'revision', 'RevisionCourseCancelledState',
            [
                'ua' => 'Скасован',
                'ru' => 'Отменен',
                'en' => 'Cancelled'
            ]);

        /*
         * Translation for error state
         */
        $this->addTranslate(892, 'revision', 'RevisionErrorState',
            [
                'ua' => 'Помилка',
                'ru' => 'Ошибка',
                'en' => 'Error'
            ]);

        /*
         * Creating and filling table with states
         */
        $this->createTable('vc_revision_status', [
            'id_status' => 'INT(10) AUTO_INCREMENT PRIMARY KEY',
            'name' => 'VARCHAR(50) NOT NULL',
        ]);
        $this->insertMultiple('vc_revision_status', [
            [
                'id_status' => 1,
                'name' => 'editable',
            ],
            [
                'id_status' => 2,
                'name' => 'cancelledAuthor',
            ],
            [
                'id_status' => 3,
                'name' => 'sendForApproval',
            ],
            [
                'id_status' => 4,
                'name' => 'rejected',
            ],
            [
                'id_status' => 5,
                'name' => 'approved',
            ],
            [
                'id_status' => 6,
                'name' => 'readyForRelease',
            ],
            [
                'id_status' => 7,
                'name' => 'released',
            ],
            [
                'id_status' => 8,
                'name' => 'cancelled',
            ],
        ]);

        /*
         * Create lecture revision state history table and
         * adding current state column in properties table
         */
        $this->createNewFields('vc_lecture_state_history', 'vc_lecture_properties');

        /*
         * Select all current lectures states
         */
        $fields = [
            'id_properties',
            'id_revision',
            'start_date',
            'id_user_created',
            'send_approval_date',
            'id_user_sended_approval',
            'reject_date',
            'id_user_rejected',
            'approve_date',
            'id_user_approved',
            'end_date',
            'id_user_cancelled',
            'release_date',
            'id_user_released',
            'cancel_edit_date',
            'id_user_cancelled_edit',
            'proposed_to_release_date',
            'id_user_proposed_to_release',
        ];

        $lecturesData = $this->getRevisionsUnitData($fields, 'vc_lecture', 'vc_lecture_properties');

        /*
         * Transformation lectures states data to new format
         */
        $this->transformAndSave($lecturesData, 'vc_lecture_state_history', 'vc_lecture_properties', 'id_revision', true);

        /*
         * Module
         */
        $this->createNewFields('vc_module_state_history', 'vc_module_properties');
        $fields = [
            'id_properties',
            'id_module_revision',
            'start_date',
            'id_user_created',
            'send_approval_date',
            'id_user_sended_approval',
            'reject_date',
            'id_user_rejected',
            'approve_date',
            'id_user_approved',
            'end_date',
            'id_user_cancelled',
            'release_date',
            'id_user_released',
            'cancel_edit_date',
            'id_user_cancelled_edit'
        ];
        $modulesData = $this->getRevisionsUnitData($fields, 'vc_module', 'vc_module_properties');
        $this->transformAndSave($modulesData, 'vc_module_state_history', 'vc_module_properties', 'id_module_revision', false);

        /*
         * Course
         */

        $this->createNewFields('vc_course_state_history', 'vc_course_properties');
        $fields = [
            'id_properties',
            'id_course_revision',
            'start_date',
            'id_user_created',
            'send_approval_date',
            'id_user_sended_approval',
            'reject_date',
            'id_user_rejected',
            'approve_date',
            'id_user_approved',
            'end_date',
            'id_user_cancelled',
            'release_date',
            'id_user_released',
            'cancel_edit_date',
            'id_user_cancelled_edit'
        ];
        $modulesData = $this->getRevisionsUnitData($fields, 'vc_course', 'vc_course_properties');
        $this->transformAndSave($modulesData, 'vc_course_state_history', 'vc_course_properties', 'id_course_revision', false);

        $this->dropColumn('vc_lecture_properties', 'send_approval_date');
        $this->dropColumn('vc_lecture_properties', 'id_user_sended_approval');
        $this->dropColumn('vc_lecture_properties', 'reject_date');
        $this->dropColumn('vc_lecture_properties', 'id_user_rejected');
        $this->dropColumn('vc_lecture_properties', 'approve_date');
        $this->dropColumn('vc_lecture_properties', 'id_user_approved');
        $this->dropColumn('vc_lecture_properties', 'end_date');
        $this->dropColumn('vc_lecture_properties', 'id_user_cancelled');
        $this->dropColumn('vc_lecture_properties', 'release_date');
        $this->dropColumn('vc_lecture_properties', 'id_user_released');
        $this->dropColumn('vc_lecture_properties', 'cancel_edit_date');
        $this->dropColumn('vc_lecture_properties', 'id_user_cancelled_edit');
        $this->dropColumn('vc_lecture_properties', 'proposed_to_release_date');
        $this->dropColumn('vc_lecture_properties', 'id_user_proposed_to_release');

        $this->dropColumn('vc_module_properties', 'send_approval_date');
        $this->dropColumn('vc_module_properties', 'id_user_sended_approval');
        $this->dropColumn('vc_module_properties', 'reject_date');
        $this->dropColumn('vc_module_properties', 'id_user_rejected');
        $this->dropColumn('vc_module_properties', 'approve_date');
        $this->dropColumn('vc_module_properties', 'id_user_approved');
        $this->dropColumn('vc_module_properties', 'end_date');
        $this->dropColumn('vc_module_properties', 'id_user_cancelled');
        $this->dropColumn('vc_module_properties', 'release_date');
        $this->dropColumn('vc_module_properties', 'id_user_released');
        $this->dropColumn('vc_module_properties', 'cancel_edit_date');
        $this->dropColumn('vc_module_properties', 'id_user_cancelled_edit');

        $this->dropColumn('vc_course_properties', 'send_approval_date');
        $this->dropColumn('vc_course_properties', 'id_user_sended_approval');
        $this->dropColumn('vc_course_properties', 'reject_date');
        $this->dropColumn('vc_course_properties', 'id_user_rejected');
        $this->dropColumn('vc_course_properties', 'approve_date');
        $this->dropColumn('vc_course_properties', 'id_user_approved');
        $this->dropColumn('vc_course_properties', 'end_date');
        $this->dropColumn('vc_course_properties', 'id_user_cancelled');
        $this->dropColumn('vc_course_properties', 'release_date');
        $this->dropColumn('vc_course_properties', 'id_user_released');
        $this->dropColumn('vc_course_properties', 'cancel_edit_date');
        $this->dropColumn('vc_course_properties', 'id_user_cancelled_edit');

        return true;
    }

    public function safeDown() {
        return true;
    }
}