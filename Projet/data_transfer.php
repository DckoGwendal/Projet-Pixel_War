<?php

include("config.php");



// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $Query = $link->prepare("SELECT id, Nom FROM grids WHERE Idusers = ?");
    $Query->bind_param("i", $_SESSION['userId']);
    $Query->execute();
    $Result = $Query->get_result();
    $formType = $_POST['formType'] ?? '';

    
    if ($formType === 'createGrid')
    {
        $gridName = $link->real_escape_string($_POST['gridName'] ?? '');


        // Vérifier si l'on traite l'enregistrement d'une grille ou d'un utilisateur
        if(empty($gridName))
        {
            $_SESSION['vide'] = "Veuillez entrer un nom pour la grille !";
            header("Location: grid_home.php");
            exit;

        }

        // Vérifiez l'existence du nom de la grille dans la base de données
        elseif ((!empty($gridName)))
        {
            
            $query = $link->prepare("SELECT * FROM grids WHERE Nom = ?");
            $query->bind_param("s", $gridName);
            $query->execute();
            $result = $query->get_result();
            $query->close();

            if ($result->num_rows > 0)
            { // Cette propriété de l'objet de résultat indique le nombre de lignes retournées par la requête SQL.
                $_SESSION['error'] = "Ce nom de grille est déjà utilisé. Veuillez en choisir un autre.";
                header("Location: grid_home.php");
                exit; // Stop l'éxecution du script PHP du fichier courant
            } 
    
            else
            {
                $insertGridStmt = $link->prepare("INSERT INTO grids (Nom, Idusers) VALUES (?,?)");
                $insertGridStmt->bind_param("si", $gridName,$_SESSION['userId']);
                if ($insertGridStmt->execute())
                {
                    $_SESSION['create'] = "Grille créée avec succès!";
                    header("Location: drawing.php");
                } else
                {
                    echo "Erreur lors de la création de la grille : " . $insertGridStmt->error;
                }
                $insertGridStmt->close();
            }
         }

    }

    elseif ($formType === 'register')
    {
        // Initialisation des variables avec une vérification pour éviter les erreurs
        $name = $link->real_escape_string($_POST['name'] ?? '');
        $email = $link->real_escape_string($_POST['email'] ?? '');
        $password = $link->real_escape_string($_POST['password'] ?? '');
        $pseudo = $link->real_escape_string($_POST['pseudo'] ?? '');

        // Code pour traiter l'enregistrement d'un nouvel utilisateur
        if (!empty($pseudo) && !empty($name) && !empty($email) && !empty($password))
        {
            
    
            
            $query = $link->prepare("SELECT * FROM users WHERE Pseudo = ?"); // "?" est un paramètre qui sera remplacé par une valeur spécifique
            $query->bind_param("s", $pseudo); // "s" indique le type de données que la variable est supposée être. 
            $query->execute();
            $result = $query->get_result();

            $Query = $link->prepare("SELECT * FROM users WHERE Mail = ?");
            $Query->bind_param("s", $email);
            $Query->execute();
            $Result = $Query->get_result();

            // Vérifier si le pseudo est déjà pris
            if ($result->num_rows > 0)
            {   
                $_SESSION['pseudo_error'] = "Ce pseudo est déjà pris. Veuillez choisir un autre pseudo.";
                header("Location: registration.php");
                exit; 
            }
            $Query->close();

            if ($Result->num_rows > 0)
            {   
                $_SESSION['mail_error'] = "Cet email est déjà pris. Veuillez choisir un autre mail.";
                header("Location: registration.php");
                exit; 
            }
            $query->close();

            // Hacher le mot de passe avant de l'insérer (très important pour la sécurité)
            $hashed_password = hash('sha256',$_POST["password"]);

            // Préparer la requête SQL pour éviter les injections SQL
            $stmt = $link->prepare("INSERT INTO users (Nom, Mail, Password, Pseudo) VALUES (?, ?, ?, ?)");
            if ($stmt)
            {
                $stmt->bind_param("ssss", $name, $email, $hashed_password, $pseudo);

                // Exécuter la requête
                if ($stmt->execute())
                {
                    echo "Nouvel utilisateur enregistré avec succès!";
                    header("Location: index.php");
                    
                } else
                {
                    echo "Erreur: " . $stmt->error;
                }
            
            // Fermer la connexion
                
            $stmt->close();

            }
        }

    }
/*
 Code pour transfert dans la bdd les positions des pixels

    elseif ($formType === 'saveGrid')
    {
       
        header("Location: grid_home.php");

    }
*/

}


$link->close();
?>






