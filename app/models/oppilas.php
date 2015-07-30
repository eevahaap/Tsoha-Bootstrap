<?php

class Oppilas {
    private $id;
    private $etunimi;
    private $sukunimi;
    private $luokka;
    private $opiskelijanro;
    private $virheet = array();


public function __construct($id, $etunimi, $sukunimi, $luokka) {
    $this->id = $id;
    $this->etunimi = $etunimi;
    $this->sukunimi = $sukunimi;
    $this->luokka = $luokka;
    $this->opiskelijanro = $opiskelijanro;
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
        if (trim($this->etunimi) == '') {
            $this->virheet['etunimi'] = "Nimi ei saa olla tyhjä.";
        } elseif (strlen($this->etunimi) > 50) {
            $this->virheet['etunimi'] = "Nimen on oltava alle 50 merkkiä pitkä.";
        } else {
            unset($this->virheet['etunimi']);
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
    

}

