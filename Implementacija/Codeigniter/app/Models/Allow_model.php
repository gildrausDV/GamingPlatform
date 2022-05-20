<?php namespace App\Models;

use CodeIgniter\Model;

class Allow_model extends Model {

    protected $table = 'user';

    protected $allowedFields = ['blocked'];
    
    public function allow() {

        $user = $_POST['username'];
        $allow = $_POST['allow/block'];

        $exists = $this->table('user')->where('username', $user)->paginate(1);

        if (count($exists) == 0) {
            return 1;
        }
        
        if ($allow == "allow") {
            $data = [
                'blocked' => 0
            ];
            $this->update($exists[0]['ID'], $data);
        }
        else {
            $data = [
                'blocked' => 1
            ];
            $this->update($exists[0]['ID'], $data);
        }

        return 2;
    }

}