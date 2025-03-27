<?php 

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;

class ExampleController extends Controller{
    public function view(){
        return $this->render('contact');
    }

    public function handleData(Request $request){
        $body = $request->getBody();
        var_dump($body);
        exit;
        return "Handling Data";
    }
}