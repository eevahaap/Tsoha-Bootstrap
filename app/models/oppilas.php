<?php

class Oppilas  extends BaseModel{
    private $id;
    private $etunimi;
    private $sukunimi;
    private $luokka;
    private $opiskelijanro; 
  //  private $oppiaine_id;
// public $id, $etunimi, $sukunimi, $luokka, $opiskelijanro;
 private $virheet = array();
   


public function __construct($id, $etunimi, $sukunimi, $luokka, $opiskelijanro) {
    $this->id = $id;
    $this->etunimi = $etunimi;
    $this->sukunimi = $sukunimi;
    $this->luokka = $luokka;
    $this->opiskelijanro = $opiskelijanro;
  //  $this->oppiaine_id = 
    $this->virheet = array();
    
   
}

public function getId() {
    return $this->id;
}

public function getEtunimi() {
    return $this->etunimi;
}

public function getSukunimi() {
    return $this->sukunimi;
}

public function getLuokka() {
    return $this->luokka;
}

public function getOpiskelijanro() {
    return $this->opiskelijanro;
}

public function getVirheet() {
        return $this->virheet;
    }
    
public function setId($id) {
        $this->id = $id;
    }    


public function setEtunimi($etunimi) {
        $this->etunimi = $etunimi;
        if (trim($this->etunimi) == '') {
            $this->virheet['etunimi'] = "Nimi ei saa olla tyhjä.";
        } elseif (strlen($this->etunimi) > 50) {
            $this->virheet['etunimi'] = "Nimen on oltava alle 50 merkkiä pitkä.";
        } else {
            unset($this->virheet['etunimi']);
        }
    }
    
public function setSukunimi($sukunimi) {
        $this->sukunimi = $sukunimi;
        if (trim($this->sukunimi) == '') {
            $this->virheet['sukunimi'] = "Nimi ei saa olla tyhjä.";
        } elseif (strlen($this->sukunimi) > 50) {
            $this->virheet['sukunimi'] = "Nimen on oltava alle 50 merkkiä pitkä.";
        } else {
            unset($this->virheet['etunimi']);
        }
    }
    
 public function setOpiskelijanro($opiskelijanro) {
        $this->opiskelijanro = $opiskelijanro;
        if (trim($this->opiskelijanro) == '') {
            $this->virheet['opiskelijanro'] = "Opiskelijanumero ei voi olla tyhjä.";
        } elseif (strlen($this->opiskelijanro) > 11) {
            $this->virheet['opiskelijanro'] = "Opiskelijanumero on 8 merkkiä pitkä.";
        } else {
            unset($this->virheet['opiskelijanro']);
        }
    }   
    
public function setLuokka($luokka) {
        $this->luokka = $luokka;
        if (trim($this->luokka) == '') {
            $this->virheet['luokka'] = "Luokka ei voi olla tyhjä.";
        } elseif (strlen($this->luokka) > 3) {
            $this->virheet['luokka'] = "";
        } else {
            unset($this->virheet['luokka']);
        }
    }     
    
    //haetaan oppilaat tietokannasta
    public static function getOppilaat() {
        $query = DB::connection()->prepare('SELECT * FROM Oppilas');
        $query->execute();
        $rows = $query->fetchAll();
        $oppilaat = array();
        
        foreach ($rows as $row) {
            $oppilaat[] = new Oppilas(array(
                'id' => $row['id'],
                'etunimi' => $row['etunimi'],
                'sukunimi' => $row['sukunimi'],
                'luokka' => $row['luokka'],
                'opiskelijanro' => $row['opiskelijanro']  
            ));
        }
        return $oppilaat;
    }
    
    
public static function haeOppilas($id, $etunimi, $sukunimi, $luokka, $opiskelijanro) {
        $query = DB::connection()->prepare('SELECT * FROM oppilas WHERE id = ? LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        if ($row == null) {
            return null;
        } else {
            $oppilas = new Oppilas($tulos->id, $tulos->etunimi, $tulos->sukunimi, $tulos->luokka, $tulos->opiskelijanro);
            return $oppilas;
        }
    }
    
public function poistaOppilas($id) {
        $query = DB::connection()->prepare('DELETE FROM oppilas WHERE id=:id');
        $query->execute(array('id'=>$id));
    }
    

public function muokkaaOppilasta($id) {
        $query = DB::connection()->prepare('UPDATE oppilas SET etunimi=?, sukunimi=?, luokka=?, opiskelijanro=? WHERE id=?');
        $muokkaus = $query->execute(array($this->nimi, $this->etunimi, $this->sukunimi, $this->luokka, $this->opiskelijanro, $id));
        if ($muokkaus) {
            $this->id = $query->fetchColumn();
        }
        return $muokkaus;
    } 
    
    
public function tallennaOppi()    {
    
    $query = DB::connection()->prepare('INSERT INTO Oppilas(id, etunimi, sukunimi, luokka, opiskelijanro VALUES (:id, :etunimi, :sukunimi, :luokka, :opiskelijanro) RETURNING id');
    $query->execute(array('id' => $this->id, 'etunimi' => $this->etunimi, 'sukunimi' => $this->sukunimi, 'luokka' => $this->luokka, 'opiskelijanro' => $this->opiskelijanro));

    $row = $query->fetch();
    Kint::dump($row);
    $this->id = $row['id'];
} 
    
    
    
    

}


