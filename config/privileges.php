<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Privilege Array
    |--------------------------------------------------------------------------
    |
    | Maps levels of each privilege to a number. Higher levels contain 
    | privileges of all levels below.
    |
    */
    'privilege_map' => array(
        'ADMIN' => 5,
        'TEACHER' => 4,
        'CONTRIBUTOR' => 3,
        'STUDENT' => 2,
        'UNCATIGORIZED' => 1
    ),


];