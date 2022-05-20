<?php namespace App\Models;

use CodeIgniter\Model;

class Participation_model extends Model {

    protected $table = 'participation';

    protected $allowedFields = ['ID_tournament', 'ID_user'];

    public function joinTournament($id_tournament, $id_user) {
        $data = [
            'ID_tournament' => $id_tournament,
            'ID_user' => $id_user
        ];
        $this->insert($data);
    }

}