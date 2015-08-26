<?php

class Arvosana extends BaseModel {
    public $id, $arvosana, $oppilas_id, $oppiaine_id;
    
    
    public function __construct($attributes) {
        parent::__construct($attributes);
    }
    
    public function tallennaArvosana()    {
    
    $query = DB::connection()->prepare('INSERT INTO Arvosana(arvosana, oppilas_id, oppiaine_id) VALUES (:arvosana, :oppilas_id, :oppiaine_id) RETURNING id');
    $query->execute(array('arvosana' => $this->arvosana, 'oppilas_id' => $this->oppilas_id, 'oppiaine_id' => $this->oppiaine_id));

    $row = $query->fetch();
   // Kint::dump($row);
    $this->id = $row['id'];
} 

    
}

