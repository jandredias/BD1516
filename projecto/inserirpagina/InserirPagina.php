<html>
    <body>		
    <h3>Accounts</h3>
<?php
    try
    {
        $host = "db.ist.utl.pt";
        $user ="ist177034";
        $password = "sjxdqmu";
        $dbname = $user;

        $db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
        $db>setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT userid, email, nome FROM utilizador;";

        $result = $db>query($sql);

        echo("<table border=\"0\" cellspacing=\"5\">\n");
        foreach($result as $row)
        {
            echo("<tr>\n");
            echo("<td>{$row['userid']}</td>\n");
            echo("<td>{$row['email']}</td>\n");
            echo("<td>{$row['nome']}</td>\n");
            echo("<td><a href=\"NomePagina.php?userid={$row['userid']}&email={$row['email']}\">Insert Page</a></td>\n");
            echo("</tr>\n");
        }
        echo("</table>\n");

        $db = null;
    }
    catch (PDOException $e)
    {
        echo("<p>ERROR: {$e>getMessage()}</p>");
    }
?>
    </body>
</html>
