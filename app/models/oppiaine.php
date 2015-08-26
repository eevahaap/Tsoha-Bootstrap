<?php

class Oppiaine  extends BaseModel{
    
    public $id, $nimi, $opettaja_id;
    
public function __construct($attributes) {
    parent::__construct($attributes);
    
    
    /*
      $this->validators = array(
        'validate_etunimi',
        'validate_sukunimi',
        'validate_luokka'
    );
      
     
     */
}

public static function haeOppiaineet() {
        $query = DB::connection()->prepare('SELECT * FROM Oppiaine');
        $query->execute();
        $rows = $query->fetchAll();
        $oppiaineet = array();
        
        foreach ($rows as $row) {
            $oppiaineet[] = new Oppiaine(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'opettaja_id' => $row['opettaja_id']
                 
            ));
        }
        return $oppiaineet;
    }
    
    
    
public function tallennaOppiaine($user_id)    {
    
    $query = DB::connection()->prepare('INSERT INTO Oppiaine(nimi, opettaja_id) VALUES (:nimi, :opettaja_id) RETURNING id');
    $query->execute(array('nimi' => $this->nimi, 'opettaja_id' => $user_id));

    $row = $query->fetch();
    Kint::dump($row);
    $this->id = $row['id'];
}    

public static function haeOppiaine($nimi) {
        $query = DB::connection()->prepare('SELECT id FROM oppiaine WHERE nimi = :nimi LIMIT 1');
        $query->execute(array('nimi' => $nimi));
        $row = $query->fetch();
        if ($row == null) {
            return null;
        } else {
            $oppiaine = new Oppiaine(array('id'=>$row['id']));
            return $oppiaine;
        }
    }

}