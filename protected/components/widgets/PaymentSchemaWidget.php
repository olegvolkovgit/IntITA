<?php

class PaymentSchemaWidget extends CWidget
{
    public $billableObject;
    public $schema;
    public $educForm;
    public $discount;
    public $view;
    public $price;

    public function init(){

    }

    public function run()
    {
        parent::run();

        $view = "PaymentSchema/".$this->view;
        $price = $this->schema->getSumma($this->billableObject);
//        if($this->educForm == "offline"){
//            $price = $price * Config::getCoeffModuleOffline();
//        }
        $this->render($view,array(
            'model'=>$this->billableObject,
            'schema' => $this->schema,
            'educForm' => $this->educForm,
            'discount' => $this->discount,
            'price' => $price
        ));
    }
}