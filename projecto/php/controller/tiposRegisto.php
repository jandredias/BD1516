<?php
if($_GET['page'] == "tiposRegisto" && isset($_GET['accao'])){
  switch($_GET['accao']){
    case "inserir":
      if(isset($_POST['nomeTipo'])){
        $user = $this->user;
        var_dump($user);
        $user->adicionaTipoRegisto($_POST['nomeTipo']);
      }
      break;
    case "remove":
      if(isset($_GET['tid'])){
        //FIXME
         
		$userid = $this->user->userid;
		$tid=$_GET['tid'];
		$date=(date('Y-m-d H:i:s'));
		/* BEGIN TRANSACTION */
		$connection->begintransaction();
		/*$query = $connection->prepare(
		  "INSERT INTO sequencia(userid,moment)
		   VALUES (:userid,:date);");
		$query->execute(array(':userid' => $userid, ':date' => $date));
		*/
		$query = $connection->prepare(
		  "UPDATE tipo_registo 
		   SET ativo=0 
		   WHERE userid=:userid 
		   AND typecnt=:typecnt;");
		$query->execute(array(':userid' => $userid,':pagecounter' => $tid));

		$connection->commit();
		/* END TRANSACTION */
			
      }
      break;
    default:
      break;
  }
}
 ?>
