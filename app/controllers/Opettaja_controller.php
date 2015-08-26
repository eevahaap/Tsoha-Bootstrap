<?php
require 'app/models/opettaja.php';

class Opettaja_controller extends BaseController {
    
    public function kirjaudu() {
        View::make('kirjautuminen/kirjautuminen.html');  
    }
    
    public function tarkistaKirjautuja() {
        $params = $_POST;
        
        $opettaja = Opettaja::kirjautuminen($params['tunnus'], $params['salasana']);
        
        if(!$opettaja) {
            View::make('kirjautuminen.html', array('virhe' => 'Väärä tunnus ja/tai salasana', 'tunnus'=>$params['tunnus']));
            
        } else {
            $_SESSION['user'] = $opettaja->id;
            
           Redirect::to('/', array('viesti' => 'Tervetuloa!' ));
        }
    }
    
    public function logout() {
        $_SESSION['user'] = null;
        Redirect::to('/kirjautuminen', array('viesti' =>'olet kirjautunut ulos.'));
        
    }
    
    public static function rekisterointisivu() {
        View::make('uusiopettaja.html');
    }
    
    public static function rekistetoidy() {
        
        $params = $_POST;
     $atribuutit = array(
         'nimi' => $params['nimi'], 
         'tunnus' => $params['tunnus'], 
         'salasana' => $params['salasana']
         );
     
     $uusiopettaja = new Opettaja($atribuutit);
    
     
     if (true) {
         $uusiopettaja->tallennaOpettaja();
         
        Redirect::to('/kirjautuminen',array('viesti' => 'Rekisteröinti onnistui, voit kirjautua sisään!' ));
     } else {
         View::make("uusiopettaja.html");
     }
     
    }
    
    
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

