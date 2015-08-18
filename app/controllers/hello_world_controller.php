<?php

require 'app/models/oppilas.php';

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  View::make('etusivu.html');
    }

    public static function sandbox(){
      // Testaa koodiasi täällä
      $testiopp = Oppilas::haeOppilas(1);
      $oppilaat = Oppilas::getOppilaat();
      
      Kint::dump($oppilaat);
      Kint::dump($testiopp);
    }
    
    public static function oppiaineenluonti() {
        $params = $_POST;
     $atribuutit = array(
         'nimi' => $params['nimi'], 
         );
     
   /*  $testiopp = new Oppilas($atribuutit);
    // $virheet = $testiopp->virheet();
     
     if (true) {
         $testiopp->tallennaOppilas();
         
        Redirect::to('/',array('viesti' => 'ok!' ));
     } else {
         View::make("oppilaanluonti.html");
     }
     */
    } 
    
   public static function aineenluonti() {
        View::make('aineenluonti.html');
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
         'luokka' => $params['5A'],
         'opiskelijanro' => $params['12345678']
         ));
    }
    
  }
