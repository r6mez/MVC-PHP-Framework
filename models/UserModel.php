<?php
namespace App\Models;

use App\Core\DatabaseModel;


abstract class UserModel extends DatabaseModel{
    abstract public function getDisplayName(): string;
}