<?php namespace App\Models;

use CodeIgniter\Model;

class Settings_model extends Model {

    protected $table = 'user';

    protected $allowedFields = ['password', 'picture', 'date'];
    
    public function settingsStoreData($id, $file) {

        $pass = $_POST['pass'];
        $date = $_POST['date'];
        //$picture = $_POST['file'];

        $exists = $this->table('user')->select()->where('ID', $id)->paginate(1);
        
        if (strlen($pass) < 5) {
            return 1;
        }    

        $data = [
            'password' => $pass,
            'date' => $date
        ];
        if ($file != "") {
            $data['picture'] = $file;
        }
        /*if (!isset($_POST['save'])) return;
        if (is_array($_FILES)) {
            if (is_uploaded_file($_FILES['file']['tmp_name'])) {
                if (move_uploaded_file($_FILES['file']['tmp_name'], "$targerDir/".$_FILES['file']['name'])) {
                    $data['picture'] = "$targerDir/".$FILES['file']['name'];
                }
            }
        }*/
        $this->update($exists[0]['ID'], $data);

        return 2;
    }

    public function settingsLoadData($id) {
        $data = $this->table('user')->select()->where('ID', $id)->paginate(1);
        /*if (count($data) == 0) {
            return -1;
        }*/
        $res['password'] = $data[0]['password'];
        $res['date'] = $data[0]['date'];
        $res['profilePicture'] = $data[0]['picture'];
        return $res;
    }

    public function settingsLoadPicture($id) {
        $data = $this->table('user')->select()->where('ID', $id)->paginate(1);
        $res['profilePicture'] = $data[0]['picture'];
        //return $res;
        return $data[0]['picture'];
    }

}