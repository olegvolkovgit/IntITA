<?php
/**
 * Created by PhpStorm.
 * User: Quicks
 * Date: 04.11.2015
 * Time: 15:39
 */

namespace application\components\Exceptions;


class ValidationException extends IntItaException {

    private $model;
    private $errors;

    public function __construct($model, $code = 400) {
        $this->model = $model;
        parent::__construct($code, $this->generateMessage());
    }

    private function generateMessage() {
        $errors = [];
        foreach ($this->model->getErrors() as $attribute => $error) {
            $errors[] = $attribute . ' => ' . implode(',', $error);
        }
        return 'Validation error. ' . implode('.', $errors);
    }

    public function getAsJson() {
        return $this->model->getErrors();
    }
}