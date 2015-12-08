<?php
function __autoload($class_name) {
    include $class_name . '.php';
}

class App{
  private Connection $_connection;

  public function __construct(){
   $_connection = new Connection(Configuration::$server,
                                 Configuration::$username,
                                 Configuration::$password,
                                 Configuration::$database);
 
  }
  
}
