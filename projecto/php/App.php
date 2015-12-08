<?php
defined('_BD1516') or die;

$connection = NULL;
class App{
  private $server;
  private $username;
  private $password;
  private $database;
  private $user = NULL;
  public function __construct(){

    global $connection;
    $this->server = Configuration::$server;
    $this->username = Configuration::$username;
    $this->password = Configuration::$password;
    $this->database = Configuration::$database;
    try{
      $connection = new PDO("mysql:host=".$this->server.";dbname=".$this->database, $this->username, $this->password);
      $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
      header('location: index.php?page=exception&message='.$e->getMessage());
    }
    session_start();
    if(isset($_SESSION['username'])){
      $this->login($_SESSION['username']);
    }

  }
  public function close(){
    $db = null;
  }
  public function destroySession(){
    session_start();
    $_SESSION = array();
    session_destroy();
  }
  public function execute(){
    //if(!isset($_SESSION['active'])) $_GET['page'] = "login";
    if(isset($_GET['page']) && $_GET['page'] == "logout"){
      echo "DESTROY 1"; fflush();
      $this->destroySession();
      header('location: index.php?page=login');
    }
    if(isset($_GET['page']) && $_GET['page'] == "logging"){
      $this->login($_POST['username'], $_POST['password']);
    }
    /*
    if(!isset($_SESSION['username']) && !isset($_GET['page']) && !(isset($_POST['username']) && isset($_POST['username']))){
      echo "DESTROY 2"; fflush();
      $this->destroySession();
      header('location: index.php?page=login');
      return;
    }*/
    if(!isset($_GET['page']) && isset($_POST['username']) && isset($_POST['username'])){

    }
    include("views/index.php");
  }
  public function login($username, $password = ""){

  //  $_SESSION['active'] = 1;
    $user = new User($username);
    if(func_num_args() == 2){
      $password = $_POST['password'];
    }
      $this->user = $user;
      $_SESSION['username'] = $this->user->email;
  }
  public function __get($property) {
    if (property_exists($this, $property)) {
      return $this->$property;
    }
  }
  public function __set($property, $value) {
    if (property_exists($this, $property)) {
      $this->$property = $value;
    }
  }
}
