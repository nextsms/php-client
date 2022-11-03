<?php

namespace Nextsms\Nextsms\Traits;

trait HasErrors
{
    protected $errors;

    public function getErrors()
    {
        return $this->errors;
    }

    public function setErrors($errors)
    {
        $this->errors = $errors;
    }
}
