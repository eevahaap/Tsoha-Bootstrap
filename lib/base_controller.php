<?php

  class BaseController{

    public static function get_user_logged_in(){
      if(isset($_SESSION['opettaja'])) {
          $opettaja_id = $_SESSION['opettaja'];
          $opettaja = Opettaja::haeOpettaja($opettaja_id);
      }
      return null;
    }

    public static function check_logged_in(){
      if(!isset($_SESSION['user'])) {
          Redirect::to('/kirjautuminen', array('message'=>'kirjaudu sisään!'));
      }
    }

  }
