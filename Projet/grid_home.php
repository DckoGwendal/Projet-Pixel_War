<?php 
    include ("config.php");

    // fonction qui me permet de vérifier que l'utilisateur est connecté avec un compte
    EstConnecte();
  
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil des grilles</title>
    <link rel="stylesheet" href="grid_home.css">
</head>
<body>
    <div class="welcome-container">
        <h1 class="welcome-title"><b>Bienvenue sur Pixel War, <?php echo htmlspecialchars($_SESSION['login']); ?> !</b></h1> <!-- htmlspecialchars() : Utile pour prévenir les attaques XSS -->

        <?php if (isset($_SESSION['error'])): ?>
                <p class='error-message'><?php echo $_SESSION['error']; ?></p>
                <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['vide'])): ?>
                <p class='error-message'><?php echo $_SESSION['vide']; ?></p>
                <?php unset($_SESSION['vide']); ?>
        <?php endif; ?>


        <h3>Grilles déjà existantes :</h3>

        <div id="gridList" style="margin-top: 20px;"></div>
        
        <!-- Formulaire pour nommer une nouvelle grille -->
        <form id="newForm" style="" action="data_transfer.php" method="POST"> 
            <input type="text" id="gridName" name="gridName" placeholder="Nom de la nouvelle grille">
            
            <input type="hidden" name="formType" value="createGrid">
            
            <button id="newBtn">Créer une nouvelle grille</button>
        </form>

    </div>
    <!-- Formulaire pour les noms des grilles dans la base de données -->
    <script>
        /* Ce code est exécuté une fois que le contenu complet de la page HTML a été complètement chargé */
        document.addEventListener('DOMContentLoaded', function()
        {
            fetch('fetch_grids.php') /* La fonction fetch est utilisée pour faire une requête HTTP GET vers le fichier fetch_grids.php */
            .then(response => response.json()) // Response.json() convertit la réponse du serveur, qui est présumée être au format JSON, en un objet JavaScript */
            .then(grids => {
                const listContainer = document.getElementById('gridList'); /* Sélectionne un élément HTML dans la page ayant l'identifiant (id) gridList.  */
                listContainer.innerHTML = '';
                grids.forEach(grid => {
                    const button = document.createElement('button');
                    button.textContent = grid.Nom; 
                    button.onclick = function()
                    {
                        window.location.href = `drawing.php?gridId=${grid.id}`;
                    };
                    listContainer.appendChild(button);
                });
            })
            .catch(error => console.error('Error loading the grid list:', error));
        });

    </script>

</body>
</html>
