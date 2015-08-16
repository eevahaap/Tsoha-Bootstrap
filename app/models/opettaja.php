<?php

class Opettaja extends BaseModel {
    public $id, $nimi, $tunnus, $salasana;
    
    public function __construct($attributes = null) {
        parent::__construct($attributes);
    }
  
    public function kirjautuminen($tunnus, $salasana) {
        
        $query = DB::connection()->prepare('SELECT * FROM Opettaja WHERE tunnus = :tunnus AND salasana = :salasana LIMIT 1');
        $query->execute(array('tunnus'=>$tunnus, 'salasana'=>$salasana));
        $row = $query->fetch();
        
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
    
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

