<?php

namespace App\Models;
use App\Libs\Database;

class Users
{
    public function getUserByName($name)
    {
        var_dump($name);
    }

    public function addNewUser($parameters)
    {
        var_dump($parameters);
    }
}