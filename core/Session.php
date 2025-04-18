<?php

namespace App\Core;

class Session {
    protected const FLASH_KEY = "flash_messages";

    public function __construct() {
        session_start();
        $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];
        foreach($flashMessages as $key => &$message){
            // mark to be removed
            $message['remove'] = true;
        }
        
        $_SESSION[self::FLASH_KEY] = $flashMessages;
    }

    public function setFlash($key, $message){
        $_SESSION[self::FLASH_KEY][$key] = [ 
            'removed' => false,
            'value' => $message
        ]; 
    }

    public function getFlash($key){
        return $_SESSION[self::FLASH_KEY][$key]['value'] ?? false;
    }

    public function __destruct(){
        // remove marked
        $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];
        foreach($flashMessages as $key => &$message){
            // mark to be removed
            if($message['remove']){
                unset($flashMessages[$key]);
            }
        }
        $_SESSION[self::FLASH_KEY] = $flashMessages;
    }
}