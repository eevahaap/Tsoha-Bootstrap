<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  View::make('helloworld.html');
    }

    public static function sandbox(){
      // Testaa koodiasi täällä
      View::make('numeronantaminen.html');
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
  }
