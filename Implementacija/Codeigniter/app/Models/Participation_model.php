<?php namespace App\Models;

use CodeIgniter\Model;

/**
 * Participation_model - model za prijavljivanje korisnika na takmičenje
 * 
 * @version 1.0
 */
class Participation_model extends Model {

    /**
     * @var String $table   // naziv tabele kojoj se pristupa
     */
    protected $table = 'participation';

    /**
     * @var arr[String] $allowedFields  // Polja koja se ažuriraju u ovoj klasi
     */
    protected $allowedFields = ['ID_tournament', 'ID_user'];
    
    /**
     * Funkcija koja dohvata 5 najboljih učesnika takmičenja $id_tournament
     * 
     * @param Integer $id_tournament
     * 
     * @return arr[]   // niz koji sadrzi strukturu {ID, points, time}
     */
    public function getTop5($id_tournament) {
        $top5 = $this->table('participation')
            //->distinct()
            ->select('playedgame.ID_user as ID, sum(playedgame.points) as points, sum(playedgame.timePlayed) as time')
            ->where('ID_tournament', $id_tournament)
            ->join('playedgame', 'playedgame.ID_user = participation.ID_user', 'left')
            ->where('playedgame.on_tournament', $id_tournament)
            ->orderBy('points', 'desc')
            ->orderBy('time', 'asc')
            ->groupBy('playedgame.ID_user')
            ->paginate(5);
        return $top5;
    }

    /**
     * Funkcija koja beleži u bazi učešće korisnika $id_user na takmičenje $id_tournament
     * 
     * @param $id_tournament
     * @param $id_user
     */
    public function joinTournament($id_tournament, $id_user) {
        $data = [
            'ID_tournament' => $id_tournament,
            'ID_user' => $id_user
        ];
        $this->insert($data);
    }

    /**
     * Funkcija koja proverava u bazi učešće korisnika $id_user na takmičenju $id_tournament
     * 
     * @param $id_tournament
     * @param $id_user
     * 
     * @return Boolean
     */
    public function joined($id_tournament, $id_user) {
        return count($this->table('participation')->select('*')
            ->where('ID_tournament', $id_tournament)
            ->where('ID_user', $id_user)
            ->paginate(1)) > 0;
    }

    /**
     * Funkcija koja dohvata iz baze takmičenja za koja se prijavio ulogovani korisnik
     * 
     * @param $id_tournament
     * @param $id_user
     * 
     * @return arr[]    // niz koji sadrzi ID_tournament vrednosti 
     */
    public function getJoined() {
        $id_user = $_SESSION['ID'];
        return $this->table('participation')->select('ID_tournament')
            ->where('ID_user', $id_user)
            ->paginate();
    }

}