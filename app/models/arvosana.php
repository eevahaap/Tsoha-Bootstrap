<?php

class Arvosana extends BaseModel {
    public $arvosana, $oppilas_id, $opiaine_id;
    
    
    public function __construct($attributes = null) {
        parent::__construct($attributes);
    }
    
    
    
}

