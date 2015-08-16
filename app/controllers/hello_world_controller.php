<?php

require 'app/models/oppilas.php';

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  View::make('helloworld.html');
    }

    public static function sandbox(){
      // Testaa koodiasi täällä
      $testiopp = Oppilas::haeOppilas(1);
      $oppilaat = Oppilas::getOppilaat();
      
      Kint::dump($oppilaat);
      Kint::dump($testiopp);
    }
    
    public static function kirjautuminen() {
        View::make('kirjautuminen.html');
    }
    
    public static function aineenluonti() {
        View::make('aineenluonti.html');
    }
    
    public static function oppilaanluonti() {
        View::make('oppilaanluonti.html');
    }
    
    public static function  numeronantaminen() {
        View::make('numeronantaminen.html');
    }
    
    
    public static function store() {
        $params = $_POST;
     $testiopp = new Oppilas(array(
         'id' => $params[1], 
         'etunimi' => $params['Pasi'], 
         'sukunimi' => $params['Oppilas'], 
         'luokka' => $params['5A']
         ));
    }
    
  }
