<?php

class PaymentSchemaWidget extends CWidget
{
    public $billableObject;
    public $schema;
    public $educForm;
    public $discount;
    public $view;

    public function init(){

    }

    public function run()
    {
        parent::run();

        $view = "PaymentSchema/".$this->view;
        $this->render($view,array(
            'model'=>$this->billableObject,
            'schema' => $this->schema,
            'educForm' => $this->educForm,
            'discount' => $this->discount
        ));
    }
}