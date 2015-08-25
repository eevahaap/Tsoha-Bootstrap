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
    
    
    
public function tallennaOppiaine()    {
    
    $query = DB::connection()->prepare('INSERT INTO Oppiaine(nimi) VALUES (:nimi) RETURNING id');
    $query->execute(array('nimi' => $this->nimi));

    $row = $query->fetch();
    Kint::dump($row);
    $this->id = $row['id'];
}     

}