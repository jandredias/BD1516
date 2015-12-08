<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
define("_BD1516",'');
function __autoload($class_name) {
  include $class_name . '.php';
}
try{
  $application = new App();
  $application->execute();
}catch(Exception $e){
  header('location: index.php?page=exception&message=' . $e->getMessage());
}catch(PDOException $e){
  header('location: index.php?page=exception&message=' . $e->getMessage());

}
