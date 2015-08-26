<?php

class Opettaja extends BaseModel {
    public $id, $nimi, $tunnus, $salasana;
    
    public function __construct($attributes) {
        parent::__construct($attributes);
    }
  
    public function kirjautuminen($tunnus, $salasana) {
        
        $query = DB::connection()->prepare('SELECT * FROM Opettaja WHERE tunnus = :tunnus AND salasana = :salasana LIMIT 1');
        $query->execute(array('tunnus'=>$tunnus, 'salasana'=>$salasana));
        $row = $query->fetch();
       // Kint::dump($row);
        if($row) {
            return new Opettaja(array('id'=>$row['id'], 'nimi'=>$row['nimi'], 'tunnus'=>$row['tunnus'], 'salasana'=>$row['salasana']));
        } else {
            return null;
        }
        
    }
    
    public function haeOpettaja($id) {
        $query = DB::connection()->prepare('SELECT * FROM Opettaja WHERE id = :id LIMIT 1');
        $query->execute(array('id'=>$id));
        $row = $query->fetch();
        return new Opettaja(array('id'=>$id, 'nimi'=>$nimi, 'tunnus'=>$tunnus, 'salasana'=>$salasana));
    }
    
    public function tallennaOpettaja()    {
    
    $query = DB::connection()->prepare('INSERT INTO Opettaja(nimi, tunnus, salasana) VALUES (:nimi, :tunnus, :salasana) RETURNING id');
    $query->execute(array('nimi' => $this->nimi, 'tunnus' => $this->tunnus, 'salasana' => $this->salasana));

    $row = $query->fetch();
    //Kint::dump($row);
    $this->id = $row['id'];
} 
    
}


