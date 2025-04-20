<?php
namespace App\Models;

use Ramez\PhpMvcCore\DatabaseModel;


abstract class UserModel extends DatabaseModel{
    abstract public function getDisplayName(): string;
}