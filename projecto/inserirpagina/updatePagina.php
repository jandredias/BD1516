<html>
    <body>
<?php
    $userid = $_REQUEST['userid'];
    $email = $_REQUEST['email'];
    $nome = $_POST['nome'];
    try
    {
        $host = "db.ist.utl.pt";
        $user ="ist177034";
        $password = "sjxdqmu";
        $dbname = $user;
        $db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $db->begintransaction();
		echo($userid);
		echo($email);
		echo($nome);
		
        $sql = "INSERT INTO sequencia(userid,moment) VALUES ($userid,'6969-69-69 69:69:69') ;";
		$db->query($sql);
		$sql2 = "select contador_sequencia from sequencia where contador_sequencia >= ALL(select contador_sequencia from sequencia);";
        $contador_seq = $db->query($sql2);
		foreach($contador_seq as $row){
			$seqid = $row['contador_sequencia'];
			$sql2 = "SELECT pagecounter + 1 as pg FROM(SELECT userid, pagecounter, nome, idseq, ativa FROM pagina WHERE pagecounter >= ALL(SELECT pagecounter FROM pagina)) a;";
			$page_counter= $db->query($sql2);
			foreach($page_counter as $row){
				$pg_count = $row['pg'];
				$sql3 = "INSERT INTO pagina(userid,pagecounter,nome,idseq,ativa) VALUES ($userid, $pg_count , '$nome', $seqid,1);";
				echo($sql3);
				$db->query($sql3);
			}
			
		}
		//
        echo("<p>$sql</p>");

        //$db->query($sql);

        $db->commit();

        $db = null;
    }
    catch (PDOException $e)
    {
        $db->query("rollback;");
        echo("<p>ERROR: {$e->getMessage()}</p>");
    }
?>
    </body>
</html>
