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
        $session = Services::session();
        /*echo $session->get('isLoggedIn');
        if(session()->get('isLoggedIn')) {
            echo "JESTE";
        } else {
            echo "NIJE";
        }*/
        $arr = explode("/",current_url());
        if($arr[count($arr) - 1] == "login" || $arr[count($arr) - 1] == "login_")
            return;
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('Home/login');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = NULL)
    {
    }

} 