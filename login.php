<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de connetion</title>
</head>
<body>
    <h1>Connexion</h1>
    <?php
        session_start();

        if (empty($_POST['name']))
        {echo"champ vide";}
        else {$_SESSION['name']= $_POST['name'] ;
            header("Location: read.php");
        } 
    

        ?>

        <form method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
            <input name="name" type="text">
            <input type="submit" value="Submit">
        </form>
</body>
</html>