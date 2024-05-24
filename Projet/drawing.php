<?php 
    include ("config.php");
    EstConnecte();

    if (isset($_SESSION['create']))
    {
        echo '<p>' . $_SESSION['create'] . '</p>';
        unset($_SESSION['create']); // Efface le message d'erreur de la session après affichage
    }
    
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grille de Dessin</title>
    <link rel="stylesheet" href="drawing.css">
</head>
<body>
    <div class="container">
        <div class="grid"></div>
        <div class="palette">
            <div class="color" style="background-color: red;"></div>
            <div class="color" style="background-color: blue;"></div>
            <div class="color" style="background-color: green;"></div>
            <div class="color" style="background-color: yellow;"></div>
            <div class="color" style="background-color: black;"></div>
            <div class="color" style="background-color: white;"></div>
        </div>
    </div>
    <div class="button-container">
            <input type="button" value="Enregistrer" onClick="location.href='grid_home.php'">
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function()
        {
            const grid = document.querySelector('.grid');
            const colors = document.querySelectorAll('.color');
            let selectedColor = 'white'; // Couleur par défaut

            // Création des pixels de la grille
            for (let i = 0; i < 900; i++)
            {
                const pixel = document.createElement('div');
                pixel.classList.add('pixel');
                pixel.dataset.index = i; // Stocker un index pour chaque pixel
                grid.appendChild(pixel);

                // Ajouter un événement click pour colorier le pixel
                pixel.addEventListener('click', function()
                {
                    const lastModifiedTime = localStorage.getItem(`pixel_${this.dataset.index}`);
                    const currentTime = Date.now();
                    const protectionPeriod = 30000; // 30 secondes en millisecondes

                    if (lastModifiedTime && currentTime - parseInt(lastModifiedTime) < protectionPeriod)
                    {
                        alert('Ce pixel est protégé pour encore ' + ((protectionPeriod - (currentTime - parseInt(lastModifiedTime))) / 1000).toFixed(1) + ' secondes.');
                    }
                    else
                    {
                        localStorage.setItem(`pixel_${this.dataset.index}`, currentTime.toString());
                        this.style.backgroundColor = selectedColor;
                    }
                });
            }


            // Configuration de la sélection de couleur
            colors.forEach(color => {
                color.addEventListener('click', function()
                {
             
                    colors.forEach(c => c.classList.remove('active'));

                    // Ajouter la classe 'active' à l'élément cliqué
                    this.classList.add('active');
                    // Retirer la classe active de tous les éléments de couleur
                    colors.forEach(c => c.classList.remove('active'));

                    // Ajouter la classe 'active' à l'élément cliqué
                    this.classList.add('active');

                    // Mettre à jour la couleur sélectionnée
                    selectedColor = this.style.backgroundColor;
                });
            });
        });

</script>

</body>
</html>
