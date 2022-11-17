<?php

use Nextsms\Nextsms\Nextsms;

it('wont instantiate if reqiored options are missing',function (){
    $n = new Nextsms([]);
})->throws(InvalidArgumentException::class);
