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
    HelloWorldController::oppilaanluonti();
  });
  
  $routes->get('/uusiaine', function() {
    HelloWorldController::aineenluonti();
  });
  
  $routes->get('/arviointi', function() {
    HelloWorldController::numeronantaminen();
  });



