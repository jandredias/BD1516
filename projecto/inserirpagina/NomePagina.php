<html>
    <body>
        <h3>Change balance for user <?=$_REQUEST['userid']?> and email <?=$_REQUEST['email']?> </h3>
        <form action="updatePagina.php?userid=<?=$_REQUEST['userid']?>&email=<?=$_REQUEST['email']?>" method="post">
            <p></p>
            <p>Nome para a nova pagina: <input type="text" name="nome"/></p>
            <p><input type="submit" value="Submit"/></p>
        </form>
    </body>
</html>
