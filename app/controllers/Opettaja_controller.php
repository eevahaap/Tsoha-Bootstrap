<?php

class Opettaja_controller extends BaseController {
    
    public function kirjaudu() {
        View::make('kirjautuminen.html');
       
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
    
    
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

