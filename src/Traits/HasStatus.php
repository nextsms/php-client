<?php

namespace Nextsms\Nextsms\Traits;

trait HasStatus
{
    protected $status;

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }
}
