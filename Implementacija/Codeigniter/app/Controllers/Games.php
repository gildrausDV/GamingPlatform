<?php

namespace App\Controllers;

class Games extends BaseController
{
    public function index()
    {
        return view('welcome_message'); // ovde treba da vodi na default stranicu za biranje igrica
    }

    public function game($game) {
        if($game == "Rayman") {
            return view('Rayman/rayman');
        } else if($game == "FlappyBird") {
            return view('flappyBird/flappyBird');
        }
    }
}
