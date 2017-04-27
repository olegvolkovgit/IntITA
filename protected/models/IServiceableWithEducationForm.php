<?php

interface IServiceableWithEducationForm {
    /**
     * @param EducationForm $educationForm
     * @return Service
     */
    public function getService(EducationForm $educationForm);
}