<?php

namespace App\Core\Exception;

class NotFoundException extends \Exception {
    protected $message = "Ops! You're lost";
    protected $code = 404;
}