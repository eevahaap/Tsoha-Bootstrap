<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

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
  
  $routes->get('/uusioppilas', function() {
      OppilasController::oppilaanluontisivu();
  });
  
  $routes->post('/uusioppilas', function() {
    OppilasController::oppilaanluonti();
  });
  
  $routes->get('/aineenluonti', function() {
    HelloWorldController::aineenluonti();
  });
  
  $routes->get('/arviointi', function() {
    HelloWorldController::numeronantaminen();
  });
  
  $routes->get('/oppilaat', function() {
    OppilasController::listaaOppilaat();
  });
  
  
  $routes->get('/oppilas/:id/muokkaa', function($id){
      OppilasController::muokkaaOppilas($id);
  });
  
  $routes->post('/oppilas/:id/muokkaa', function($id){
      OppilasController::tallennaMuokkaus($id);
  });
  

  $routes->post('/oppilas/:id/poistaOppilas', function($id) {
  OppilasController::poistaOppilas($id);
  });


