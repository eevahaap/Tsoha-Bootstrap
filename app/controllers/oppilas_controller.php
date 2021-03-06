<?php

require 'app/models/oppilas.php';

class OppilasController extends BaseController {
    
    public static function oppilaanluontisivu() {
        View::make('oppilaanluonti.html');
    }
    
    public static function oppilaanluonti() {
        self::check_logged_in();
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
         
        Redirect::to('/oppilaat',array('viesti' => 'ok!' ));
     } else {
         View::make("oppilaanluonti.html");
     }
     
    }
    
    public function listaaOppilaat() {
        self::check_logged_in();
       $oppilaat = Oppilas::haeOppilaat(); 
        View::make('oppilaslista.html', array('oppilaat' => $oppilaat));  
    }
    
    
    public function muokkaaOppilas($id) {
       self::check_logged_in();
        //Kint::dump($id);
        $oppilas = Oppilas::haeOppilas($id);
        
       View::make('muokkaaOppilas.html', array('oppilas' => $oppilas));
    }
    
    public function tallennaMuokkaus($id) {
        self::check_logged_in();
        $params = $_POST;
        
        $oppilas = new Oppilas(array(
            'id' => $id,
            'etunimi' => $params['etunimi'],
            'sukunimi' => $params['sukunimi'],
            'luokka' => $params['luokka']
        ));
        
        $virheet = $oppilas->errors();
        
        if(count($virheet) == 0) {
            
           $oppilas->muokkaaOppilasta($id);
            Redirect::to('/oppilaat', array('message' => 'Tiedot muokattu.'));
            
        } else { 
             View::make('muokkaaOppilas.html', array('virheet' => $virheet, 'attribuutit' => $attribuutit));
        }
        
    }
    
    
    public function poistaOppilas($id) {
        self::check_logged_in();
        $oppilas = new Oppilas(array('id' => $id));
        
        $oppilas->poistaOppilas($id);
        
        Redirect::to('/oppilaat', array('viesti' => 'Oppilas poistettu.'));
    }
    
  /*  public function arviointi($id) {
        self::check_logged_in();
        
        
    } */
    
  public function naytaOppilas($id) {
      self:check_logged_in();
      
      $oppilas = Oppilas::haeOppilas($id);
      self::render_view('oppilas_show.html', array('oppilas'=>$oppilas));
  }
    
}

