<?php

namespace App\Core\Exception;

class ForbiddenException extends \Exception {
    protected $message = "You do not have permission to access access this page";
    protected $code = 403;
}