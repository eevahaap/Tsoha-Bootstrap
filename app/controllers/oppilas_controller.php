<?php

require 'app/models/oppilas.php';

class OppilasController extends BaseController {
    
    public static function oppilaanluontisivu() {
        View::make('oppilaanluonti.html');
    }
    
    public static function oppilaanluonti() {
        $params = $_POST;
     $atribuutit = array(
         'etunimi' => $params['etunimi'], 
         'sukunimi' => $params['sukunimi'], 
         'luokka' => $params['luokka']
         );
     
     $testiopp = new Oppilas($atribuutit);
    // $virheet = $testiopp->virheet();
     
     if (true) {
         $testiopp->tallennaOppilas();
         
        Redirect::to('/',array('viesti' => 'ok!' ));
     } else {
         View::make("oppilaanluonti.html");
     }
     
    }
    
    public function listaaOppilaat() {
       $oppilaat = Oppilas::haeOppilaat(); 
        View::make('oppilaslista.html', array('oppilaat' => $oppilaat));  
    }
    
    
    public function muokkaaOppilas($id) {
        
        //Kint::dump($id);
        $oppilas = Oppilas::haeOppilas($id);
        
       View::make('muokkaaOppilas.html', array('attribuutit' => $oppilas));
    }
    
    public function tallennaMuokkaus($id) {
        $params = $_POST;
        
        $attribuutit = array(
            'id' => $id,
            'etunimi' => $params['etunimi'],
            'sukunimi' => $params['sukunimi'],
            'luokka' => $params['luokka']
        );
        
        $oppilas = new Oppilas($attribuutit);
        $virheet = $oppilas->virheet();
        
        if(count($virheet) > 0) {
            View::make('muokkaaOppilas.html', array('virheet' => $virheet, 'attribuutit' => $attribuutit));
        } else {
            $oppilas->tallennaMuokkaus();
            
            Redirect::to('/oppilaat', array('message' => 'Tiedot muokattu.'));
        }
        
    }
    
    
    public function poistaOppilas($id) {
        $oppilas = new Oppilas(array('id' => $id));
        
        $oppilas->poistaOppilas($id);
        
        Redirect::to('/oppilaat', array('viesti' => 'Oppilas poistettu.'));
    }
    
}

