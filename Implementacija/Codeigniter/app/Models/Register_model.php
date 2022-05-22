<?php namespace App\Models;

use CodeIgniter\Model;

class Register_model extends Model {

    protected $table = 'user';

    protected $allowedFields = ['username', 'password', 'role', 'blocked', 'NP', 'name', 'surname', 'email', 'picture', 'date'];
    
    public function register() {

        $forename = $_POST['forename'];
        $surname = $_POST['surname'];
        $email = $_POST['email'];
        $user = $_POST['username'];
        $pass = $_POST['password'];
        $date = $_POST['date'];
        $confirmPass = $_POST['confirmPassword'];
        if ($forename == "" || $surname == "" || $email == "" || $user == "" || $pass == "" ||
        $confirmPass == "" || $date == "") {
            return 1;
        }

        $exists = $this->table('user')->select()->where('username', $user)->paginate(1);
        if(count($exists) == 1) {
            return 2;
        }

        if (strlen($pass) < 5) {
            return 3;
        }    

        if ($pass != $confirmPass) {
            return 4;
        }

        $data = [
            'username' => $user,
            'password'  => $pass,
            'date' => $date,
            'role'  => 0,
            'blocked' => 0,
            'NP' => 0,
            'name' => $forename,
            'surname' => $surname,
            'email' => $email,
            'picture' => file_get_contents(base_url("/images/superMario.jpg"))
            //'picture' => NULL
            /*'picture' => file_get_contents("C:\\xampp\htdocs\GamingPlatform\Implementacija\Codeigniter\public\images\kirby.jpg")*/
        ];

        $this->insert($data);
        //$this->table('user')->insert($data);

        return 5;
    }

}