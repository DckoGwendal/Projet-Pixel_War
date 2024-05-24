<?php 
    include ("config.php");
    $bMauvaisMotDePasse=$bMauvaisCompte=$_SESSION['isConnected'] = false;

    // si je POSTE le champ, c'est que j'essaie de me connecter
    if (isset($_POST["login"]))
    {
        
        $stmt = $link->prepare("SELECT id, Pseudo, Password FROM users WHERE Mail = ?");
        $stmt->bind_param("s", $_POST["login"]);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
                
        

        if (($row))
        {   
            $hash = $row['Password'];
            $userId = $row['id'];
            $pseudo = $row['Pseudo'];
            $hash_poste=hash('sha256', $_POST["mdp"]); // Je hash le mdp écrit par l'utilisateur

            // Si le hash que je poste est égale à celui qui est dans la bdd, c'est que le couple Login/password est correct
            if($hash==$hash_poste)
                {
                    $_SESSION['isConnected']=true;
                    $_SESSION['userId'] = $userId;
                    $_SESSION['Pseudo'] = $pseudo;
                    $_SESSION['login']=$_POST["login"];
                    
                    // Je vais à la page grid_home.php
                    header("location: grid_home.php"); 
                }
            else
                {
                    $bMauvaisMotDePasse=true;
                }
        }
        else
            { 
                $bMauvaisCompte=true;
            }
    }


?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POLYTECH DIJON</title>
    <link href="index.css" rel="stylesheet">
</head>

<body >
    <main >

        <?php if ($bMauvaisMotDePasse) { ?>
            <div >
                <strong>Attention!</strong> Vous avez saisi un mauvais mot de passe.
            </div>
        <?php } ?>

        <?php if ($bMauvaisCompte) { ?>
            <div >
                <strong>Attention!</strong> Le compte n'existe pas.
            </div>
        <?php }  ?>

        <img src="img/logo-polytech-dijon.png">

        <form method="POST">
            <h1> </h1>

            <div >
            <label for="floatingInput">Login:</label>
            <input type="login" name= 'login'  id="floatingInput" placeholder="login interne" value="Mail" required>

            </div>
            <div >
            <label for="floatingPassword">Password:</label>
            <input type="password" name = "mdp"  id="floatingPassword" value='paul' placeholder="Mot de passe" required>
            
            </div>

            <input type="submit" value="Se connecter">
            <input type="button" value="S'inscrire" onClick="location.href='registration.php'">
            <p >&copy; 2024 – Cyber PolyTech</p>
        </form>
</main>

</body>
</html>