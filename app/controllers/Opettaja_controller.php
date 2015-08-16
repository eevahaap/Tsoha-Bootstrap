<?php

class Opettaja_controller extends BaseController {
    
    public function kirjaudu() {
        View::make('base.html');
       
    }
    
    public function tarkistaKirjautuja() {
        $params = $_POST;
        
        $opettaja = Opettaja::kirjaudu($params['tunnus'], $params['salasana']);
        
        if(!$opettaja) {
            View::make('base.html', array('virhe' => 'Väärä tunnus ja/tai salasana', 'tunnus'=>$params['tunnus']));
            
        } else {
            $_SESSION['user'] = $opettaja->id;
            
            Redirect::to('/', array('viesti' => 'Tervetuloa' . $opettaja->nimi . '!'));
        }
    }
    
    
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

