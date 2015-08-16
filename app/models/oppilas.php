<?php

class Oppilas  extends BaseModel{
    private $id;
    private $etunimi;
    private $sukunimi;
    private $luokka;
    private $opiskelijanro; 
 //   private $oppiaine_id;
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

public function getOpiskelija() {
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
    
public function setOppiluokka($luokka) {
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
        $sql = "SELECT id, etunimi, sukunimi, luokka, opiskelijanro from oppilas";
        $haku = getTietokantayhteys()->prepare($sql);
        $haku->execute();
        $tulos = array();
        foreach ($haku->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $oppilas = new Kayttaja($tulos->id, $tulos->nimi, $tulos->tunnus, $tulos->salasana);
            $tulos[] = $oppilas;
        }
        return $tulos;
    }
    
    
public static function haeOppilas($id, $etunimi, $sukunimi, $luokka, $opiskelijanro) {
        $sql = "SELECT * FROM oppilas WHERE id = ? and kayttaja_id = ? LIMIT 1";
        $haku = getTietokantayhteys()->prepare($sql);
        $haku->execute(array($id, $etunimi, $sukunimi, $luokka, $opiskelijanro));
        $tulos = $haku->fetchObject();
        if ($tulos == null) {
            return null;
        } else {
            $oppilas = new Tarkeysaste($tulos->id, $tulos->etunimi, $tulos->sukunimi, $tulos->luokka, $tulos->opiskelijanro);
            return $oppilas;
        }
    }
    
public function poistaOppilas($id, $etunimi, $sukunimi, $luokka, $opiskelijanro) {
        $sql = "DELETE FROM oppilas WHERE id=?";
        $haku = getTietokantayhteys()->prepare($sql);
        $haku->execute(array($id, $etunimi, $sukunimi, $luokka, $opiskelijanro));
    }
    

public function muokkaaOppilasta($id, $etunimi, $sukunimi, $luokka, $opiskelijanro) {
        $sql = "UPDATE tarkeysaste SET etunimi=?, sukunimi=?, luokka=?, opiskelijanro=? WHERE id=?";
        $haku = getTietokantayhteys()->prepare($sql);
        $muokkaus = $haku->execute(array($this->nimi, $this->etunimi, $this->sukunimi, $this->luokka, $this->opiskelijanro, $id));
        if ($muokkaus) {
            $this->id = $haku->fetchColumn();
        }
        return $muokkaus;
    }    
    
    
    
    

}


