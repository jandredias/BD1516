<?php defined('_BD1516') or die;

class User {
  private $userid;
  private $email;
  private $nome;
  private $questao1;
  private $resposta1;
  private $questao2;
  private $resposta2;
  private $pais;
  private $categoria;

  public function __construct($email){

    //
//
  global $connection;
    $query = $connection->prepare(
      "SELECT userid, email, nome, password, questao1, resposta1,
              questao2, resposta2, pais, categoria
       FROM utilizador
       WHERE email=:email");

    $query->bindParam(":email", $email);

    $query->execute();

    if($query->rowCount() != 1){
      throw new Exception("Dados inválidos");
    }
    $array = $query->fetch();

    $this->userid = $array["userid"];
    $this->email = $array["email"];
    $this->nome = $array["nome"];
    $this->questao1 = $array["questao1"];
    $this->resposta1 = $array["resposta1"];
    $this->questao2 = $array["questao2"];
    $this->resposta2 = $array["resposta2"];
    $this->pais = $array["pais"];
    $this->categoria = $array["categoria"];
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
