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

        /*$session = session();
        $metod = explode("/", $request->uri->getPath())[1];
        echo "METOD: ".$metod."   ";
        if($session->has('ID')) {
            echo "   IMA ID!!!   ";
        }  else echo "NEMA ID";
        //$_SESSION['x'] = 1;
        print_r($_SESSION);*/ // za debagovanje!!!

        if(!isset($_SESSION['role'])) $_SESSION['role'] = -1;

        $metod = explode("/", $request->uri->getPath())[1];
        $arr = explode("/",current_url());
        if($arr[count($arr) - 1] == "login" || $arr[count($arr) - 1] == "login_"|| $arr[count($arr) - 1] == "register") {
            return;
        }

        $guest = ["game", "home"];
        $user = ["Tournament", "settings", "history", "topPlayers"];
        $moderator = ["addTournament", "addLevel_default", "addLevel"];
        $admin = ["allow", "roles"];

        $session = Services::session();
        
        if($_SESSION['role'] == -1 && !in_array($metod, $guest)) {
            return redirect()->to('Home/login');
        }

        /*$role = -1;
        if(isset($_SESSION['role'])) {
            $role = $session->get('role');
        }
        $metod = explode("/", $request->uri->getPath())[1];
        if($role == -1) {
            //echo "GUEST";
            if(!in_array($metod, $guest)) {
                return redirect()->to('Home/login');
            }
        } else if($role == 0) {
            //echo "USER";
            if(!in_array($metod, $user)) {
                return redirect()->to('Home/index');
            }
        } else if($role == 1) {
            //echo "MODERATOR";
            if(!in_array($metod, $moderator)) {
                return redirect()->to('Home/index');
            }
        } else if($role == 2) {
            //echo "ADMINITRATOR";
            if(!in_array($metod, $admin)) {
                return redirect()->to('Home/index');
            }
        }*/

        /*if (!session()->get('isLoggedIn')) {
            return redirect()->to('Home/login');
        }*/
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = NULL)
    {
    }

} 