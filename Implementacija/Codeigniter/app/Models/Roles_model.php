<?php namespace App\Models;

use CodeIgniter\Model;

class Roles_model extends Model {

    protected $table = 'user';

    protected $allowedFields = ['role'];
    
    public function roles() {

        $user = $_POST['username'];
        $roles = $_POST['roles'];

        $exists = $this->table('user')->where('username', $user)->paginate(1);

        if (count($exists) == 0) {
            return 1;
        }
        
        if ($roles == "setAdmin") {
            $data = [
                'role' => 2
            ];
            $this->update($exists[0]['ID'], $data);
        }
        else if ($roles == "setModerator") {
            $data = [
                'role' => 1
            ];
            $this->update($exists[0]['ID'], $data);
        }
        else if ($roles == "removeAdmin") {
            $data = [
                'role' => 1
            ];
            $this->update($exists[0]['ID'], $data);
        }
        else {
            $data = [
                'role' => 0
            ];
            $this->update($exists[0]['ID'], $data);
        }

        return 2;
    }

}