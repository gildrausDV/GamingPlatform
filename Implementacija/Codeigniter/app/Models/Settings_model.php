<?php namespace App\Models;

use CodeIgniter\Model;

class Settings_model extends Model {

    protected $table = 'user';

    protected $allowedFields = ['password', 'picture', 'date'];
    
    public function settingsStoreData() {

        $pass = $_POST['password'];
        $date = $_POST['date'];
        $picture = $_POST['files[]'];

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
            
        ];

        $this->insert($data);
        //$this->table('user')->insert($data);

        return 5;
    }

    public function settingsLoadData1($id) {
        $data = $this->table('user')->select()->where('ID', $id)->paginate(1);
        /*if (count($data) == 0) {
            return -1;
        }*/
        $res['password'] = $data[0]['password'];
        $res['date'] = $data[0]['date'];
        return $res;
    }

    public function settingsLoadData2($id) {
        $data = $this->table('user')->select()->where('ID', $id)->paginate(1);
        return $data[0]['picture'];
    }

}