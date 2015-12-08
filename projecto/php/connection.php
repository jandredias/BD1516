<?php
class Connection{
  private $_server;
  private $_username;
  private $_password;
  private $_database;
  private $_connection;
  
  public function __construct($server, $username, $password, $database){
    $_server = $server;
    $_username = $username;
    $_password = $password;
    $_database = $database;
    $_connection = new mysqli($_server, $_username, $_password, $_database);
    if ($_connection->connect_errno){
      throw new Exception("Error connecting to MySQL: " .
        $_connection->connect_errno . ") " . $connection->connect_error);
    }
  }
  
  public function close(){
    $_connection->close();
  }

  public function prepareStatement($statement){
    if (!($stmt = $mysqli->prepare("INSERT INTO test(id) VALUES (?)"))) {
      throw new Exception("Prepare failed: (" . $mysqli->errno . ") " .
        $mysqli->error);
    }
    return $stmt;
  }
  
  /*public function bindStatement($statement, $parameters){
    if (!$statement->bind_param("i", $id))
      throw new Exception("Binding parameters failed: (" .
        $statement->errno . ") " . $statement->error);
  }*/

  public function executeStatement($statement){
    if(!$statement->execute())
      throw new Exception("Executed failed: (" . $statement->errno . ") ".
        $statement->error);
  }
}
