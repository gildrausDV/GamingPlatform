<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

class Auth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = NULL)
    {
        /*$session = Services::session();
        if ($session->has('auth'))
        { 
            if ($request->uri->getPath() == 'Home/login')
            {
                return redirect()->to('Home/index');
            }
            if ($request->uri->getSegment(1) == 'admin')
            {
                 return redirect()->back();
            }
        } 
        else
        {
            echo "asd";
            echo $session->get('isLoggedIn');
            if ($request->uri->getPath() != 'Home/login')
            {
                return redirect()->to('Home/login');
            }
            echo "abc";
        }*/

// Gost: Play/*
// Obican korisnik: Gost +  Tournament, Acc settings, History/*, Top Players/*
// Moderator: Obican korisnik + addTournament, addLevel/*
// Administrator: Moderator + Allow/Block, Roles
        $metod = explode("/", $request->uri->getPath())[1];
        echo "METOD: ".$metod;
        echo "ID: ".session()->get('ID');

        $arr = explode("/",current_url());
        if($arr[count($arr) - 1] == "login" || $arr[count($arr) - 1] == "login_") {
            return;
        }

        $guest = ["game"];
        $user = ["Tournament", "settings", "history", "topPlayers"];
        $moderator = ["addTournament", "addLevel_default", "addLevel"];
        $admin = ["allow", "roles"];

        $session = Services::session();
        
        $role = 0; // $role = $session->get('role');
        $metod = explode("/", $request->uri->getPath())[1];
        if($role == NULL) {
            echo "GUEST";
            /*if(!in_array($metod, $guest)) {
                return redirect()->to('Home/login');
            }*/
        } else if($role == 0) {
            echo "USER";
            /*if(!in_array($metod, $user)) {
                return;
            }*/
        } else if($role == 1) {
            echo "MODERATOR";
            /*if(!in_array($metod, $moderator)) {
                return;
            }*/
        } else if($role == 2) {
            echo "ADMINITRATOR";
            /*if(!in_array($metod, $admin)) {
                return;
            }*/
        }

        if (!session()->get('isLoggedIn')) {
            return redirect()->to('Home/login');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = NULL)
    {
    }

} 