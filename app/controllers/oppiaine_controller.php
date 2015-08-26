<?php

require 'app/models/oppiaine.php';

class Oppiaine_controller extends BaseController {
    
    
    public function listaaAineet() {
        self::check_logged_in();
       $oppiaineet = Oppiaine::haeOppiaineet(); 
        View::make('oppiaineet.html', array('oppiaineet' => $oppiaineet));  
    }
    
    public static function uusiAine() {
        View::make('aineenluonti.html');
    }
    
    public static function aineenLuonti() {
        self::check_logged_in();
        $params = $_POST;
     $atribuutit = array(
         'nimi' => $params['nimi']   
         );
     
     $uusiaine = new Oppiaine($atribuutit);
    // $virheet = $testiopp->virheet();
     
     if (true) {
         $uusiaine->tallennaOppiaine();
         
        Redirect::to('/oppiaineet',array('viesti' => 'ok!' ));
     } else {
         View::make("aineenluonti.html");
     }
     
    }
    
    
}

