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

    public function joined($id_tournament, $id_user) {
        return count($this->table('participation')->select('*')
            ->where('ID_tournament', $id_tournament)
            ->where('ID_user', $id_user)
            ->paginate(1)) > 0;
    }

    public function getJoined() {
        $id_user = $_SESSION['ID'];
        return $this->table('participation')->select('ID_tournament')
            ->where('ID_user', $id_user)
            ->paginate();
    }

}