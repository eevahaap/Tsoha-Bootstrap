<?php

class Arvosana extends BaseModel {
    public $id, $arvosana, $oppilas_id, $oppiaine_id;
    
    
    public function __construct($attributes) {
        parent::__construct($attributes);
    }
    
    public function tallennaArvosana()    {
    
    $query = DB::connection()->prepare('INSERT INTO Arvosana(arvosana) VALUES (:arvosana) RETURNING id');
    $query->execute(array('arvosana' => $this->arvosana));

    $row = $query->fetch();
    Kint::dump($row);
    $this->id = $row['id'];
} 

    
}

