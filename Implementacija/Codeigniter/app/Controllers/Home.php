<?php

namespace App\Controllers;

class Home extends BaseController
{
    
    public function index()
    {
        return view('welcome_message');
    }

    public function tournaments() {
        return view('tournament/tournament');
    }

    public function addTournament() {
        return view('tournament/addTournament');
    }

}
