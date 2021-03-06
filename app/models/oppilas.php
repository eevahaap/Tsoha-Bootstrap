<?php

class Oppilas  extends BaseModel{

 public $id, $etunimi, $sukunimi, $luokka;
 public $virheet = array();
   


public function __construct($attributes) {
    parent::__construct($attributes);
    
    $this->validators = array(
        'validate_etunimi',
        'validate_sukunimi',
        'validate_luokka'
    );
    
   
} 
    
    //haetaan oppilaat tietokannasta
    public static function haeOppilaat() {
        $query = DB::connection()->prepare('SELECT * FROM Oppilas');
        $query->execute();
        $rows = $query->fetchAll();
        $oppilaat = array();
        
        foreach ($rows as $row) {
            $oppilaat[] = new Oppilas(array(
                'id' => $row['id'],
                'etunimi' => $row['etunimi'],
                'sukunimi' => $row['sukunimi'],
                'luokka' => $row['luokka']
                 
            ));
        }
        return $oppilaat;
    }
    
    
public static function haeOppilas($id) {
        $query = DB::connection()->prepare('SELECT * FROM oppilas WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        if ($row == null) {
            return null;
        } else {
            $oppilas = new Oppilas(array('id'=>$row['id'], 'etunimi'=>$row['etunimi'], 'sukunimi'=>$row['sukunimi'], 'luokka'=>$row['luokka']));
            return $oppilas;
        }
    }
    
public function poistaOppilas($id) {
        $query = DB::connection()->prepare('DELETE FROM oppilas WHERE id=:id');
        $query->execute(array('id'=>$id));
    }
    

public function muokkaaOppilasta($id) {
        $query = DB::connection()->prepare('UPDATE oppilas SET etunimi=?, sukunimi=?, luokka=? WHERE id=?');
        $muokkaus = $query->execute(array($this->etunimi, $this->sukunimi, $this->luokka, $id));
        if ($muokkaus) {
            $this->id = $query->fetchColumn($id);
        }
        return $muokkaus;
    } 
    
    
public function tallennaOppilas()    {
    
    $query = DB::connection()->prepare('INSERT INTO Oppilas(etunimi, sukunimi, luokka) VALUES (:etunimi, :sukunimi, :luokka) RETURNING id');
    $query->execute(array('etunimi' => $this->etunimi, 'sukunimi' => $this->sukunimi, 'luokka' => $this->luokka));

    $row = $query->fetch();
    //Kint::dump($row);
    $this->id = $row['id'];
} 
    
public function validate_etunimi($errors) {
    if($this->etunimi == '' || $this->etunimi == null) {
        $errors[] = 'etunimi ei saa olla tyhjä';
        
    } 
    if (strlen($this->name) < 2) {
        $errors[] = 'etunimen tulee olla vähintään kaksi merkkiä.';
    } else if (strlen($this->name) > 20) {
        $errors[] = 'etunimen pituus voi olla enintään 20 merkkiä';
    }
        
}    
    
public function validate_sukunimi($errors) {
    
    if($this->sukunimi == '' || $this->sukunimi == null) {
        $errors[] = 'sukunimi ei saa olla tyhjä';
        
    } 
    if (strlen($this->sukunimi) < 2) {
        $errors[] = 'sukunimen tulee olla vähintään kaksi merkkiä.';
    } else if (strlen($this->sukunimi) > 30) {
        $errors[] = 'sukunimen pituus voi olla enintään 30 merkkiä';
    }
}    

public function validate_luokka($errors) {
    if($this->luokka == '' || $this->luokka == null) {
        $errors[] = 'luokka ei saa olla tyhjä!';
    } else if (strlen($this->luokka) > 4) {
        $errors[] = 'luokka voi olla enintään 4 merkkiä.';
    }
}


public static function haeLuokat() {
        $query = DB::connection()->prepare('SELECT distinct luokka FROM Oppilas');
        $query->execute();
        $rows = $query->fetchAll();
        $luokat = array();
        
        foreach ($rows as $row) {
            $luokat[] = new Oppilas(array(
                'luokka' => $row['luokka']
                 
            ));
        }
        return $luokat;
    }
    
    
    public static function haeLuokanOppilaat($luokka) {
        $query = DB::connection()->prepare('SELECT * FROM Oppilas WHERE luokka=:luokka');
        $query->execute(array('luokka'=>$luokka));
        $rows = $query->fetchAll();
        $oppilaat = array();
        
        foreach ($rows as $row) {
            $oppilaat[] = new Oppilas(array(
                'id' => $row['id'],
                'etunimi' => $row['etunimi'],
                'sukunimi' => $row['sukunimi'],
                'luokka' => $row['luokka']
                 
            ));
        }
        return $oppilaat;
    }

}


