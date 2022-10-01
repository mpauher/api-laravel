<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Crud extends Controller
{
    public function index(){
        $data = array(
            'name' => "Pau",
            'lname' => "Hernandez",
            'age' => "24"
        );

        // echo $data['name'];

        return view('hola', $data);
    }

}
