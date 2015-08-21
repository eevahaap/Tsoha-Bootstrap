<?php

class Opettaja_controller extends BaseController {
    
    public function kirjaudu() {
        View::make('kirjautuminen/kirjautuminen.html');
       
    }
    
    public function tarkistaKirjautuja() {
        $params = $_POST;
        
        $opettaja = Opettaja::kirjautuminen($params['tunnus'], $params['salasana']);
        
        if(!$opettaja) {
            View::make('kirjautuminen/kirjautuminen.html', array('virhe' => 'Väärä tunnus ja/tai salasana', 'tunnus'=>$params['tunnus']));
            
        } else {
            $_SESSION['opettaja'] = $opettaja->id;
            
            Redirect::to('/', array('viesti' => 'Tervetuloa!' ));
        }
    }
    
    public function logout() {
        $_SESSION['opettaja'] = null;
        Redirect::to('/kirjautuminen', array('message' =>'olet kirjautunut ulos.'));
        
    }
    
    
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

