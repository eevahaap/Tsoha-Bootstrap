<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });
  
  function check_logged_in() {
      BaseController::check_logged_in();
  }

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
  
  $routes->get('/kirjautuminen', function() {
      Opettaja_controller::kirjaudu();
  });
  
  $routes->post('/kirjautuminen', function(){
  // tarkista kirjautuja
  Opettaja_controller::tarkistaKirjautuja();
});
  
  $routes->get('/uusioppilas', 'check_logged_in', function() {
      OppilasController::oppilaanluontisivu();
  });
  
  $routes->post('/uusioppilas', 'check_logged_in', function() {
    OppilasController::oppilaanluonti();
  });
  
  $routes->get('/aineenluonti', 'check_logged_in', function() {
    HelloWorldController::aineenluonti();
  });
  
  $routes->get('/arviointi', function() {
    HelloWorldController::numeronantaminen();
  });
  
  $routes->get('/oppilaat', 'check_logged_in', function() {
    OppilasController::listaaOppilaat();
  });
  
  
  $routes->get('/oppilas/:id/muokkaa', 'check_logged_in', function($id){
      OppilasController::muokkaaOppilas($id);
  });
  
  $routes->post('/oppilas/:id/muokkaa', 'check_logged_in', function($id){
      OppilasController::tallennaMuokkaus($id);
  });
  

  $routes->post('/oppilas/:id/poistaOppilas', 'check_logged_in', function($id) {
  OppilasController::poistaOppilas($id);
  });
  
  $routes->post('/logout', function() {
          Opettaja_controller::logout();
  });


