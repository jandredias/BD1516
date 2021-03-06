<?php
defined('_BD1516') or die;

$connection = NULL;
class App{
  private $server;
  private $username;
  private $password;
  private $database;
  private $user = NULL;
  private $messages = NULL;
  public function __construct(){

    global $connection;
    $this->server = Configuration::$server;
    $this->username = Configuration::$username;
    $this->password = Configuration::$password;
    $this->database = Configuration::$database;
    try{
      $connection = new PDO("mysql:host=".$this->server.
                            ";dbname=".$this->database,
                            $this->username, $this->password);
      $connection->setAttribute(PDO::ATTR_ERRMODE,
                                PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
      header('location: index.php?page=exception&message='.
             $e->getMessage());
    }
    session_start();
    if(isset($_SESSION['username'])){
      $this->login($_SESSION['username']);
    }
    $this->messages = array("warning" => array(),
                            "success" => array(),
                            "error" => array());
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
    include("controller/".$_GET['page'].".php");
    include("model/".$_GET['page'].".php");
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


  public function addWarningMessage($message){
    $this->messages["warning"][] = $message;
  }
  public function addSuccessMessage($message){
    $this->messages["success"][] = $message;
  }
  public function addErrorMessage($message){
    $this->messages["error"][] = $message;
  }
  public function getWarningMessage(){
    return $this->messages["warning"];
  }
  public function getSuccessMessage(){
    return $this->messages["success"];
  }
  public function getErrorMessage(){
    return $this->messages["error"];
  }
}
