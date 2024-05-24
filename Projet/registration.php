<?php

session_start();

if ($_POST)
{   
    // Nettoyage des entrées pour éviter les injections SQL et XSS
    $name = $link->real_escape_string($_POST['name']);
    $password = $link->real_escape_string($_POST['password']);
    $email = $link->real_escape_string($_POST['email']);
    $pseudo = $link->real_escape_string($_POST['pseudo']);

}


// Affichage du pseudo deja utilisé 
if (isset($_SESSION['pseudo_error']))
{
    echo '<p>' . htmlspecialchars($_SESSION['pseudo_error'], ENT_QUOTES, 'UTF-8') . '</p>';
    unset($_SESSION['pseudo_error']); // Efface le message d'erreur de la session après affichage
}


// Affichage du mail deja utilisé 
if (isset($_SESSION['mail_error']))
{
    echo '<p>' . htmlspecialchars($_SESSION['pseudo_error'], ENT_QUOTES, 'UTF-8') . '</p>';
    unset($_SESSION['mail_error']); // Efface le message d'erreur de la session après affichage
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="registration.css">
</head>
<body>
    <form action="data_transfer.php" method="POST" class="inscription-form">

            <div class = "form">
                <label for="name">Nom:</label>
                <input type="text" id="name" name="name" placeholder="Votre nom" required>
            </div>

            <div class = "form">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Votre email" required>
            </div>

            <input type="hidden" name="formType" value="register">
            
            <div class = "form">
                <label for="password">Mot de passe:</label>
                <input type="password" id="password" name="password" placeholder="Mot de passe" required>
            </div>

            <div class = "form">
                <label for="pseudo">Pseudo:</label>
                <input type="text" id="pseudo" name="pseudo" placeholder="Pseudo désiré" required>
            </div>

            <button type="submit" >S'inscrire</button>
            
    </form>
</body>
</html>








