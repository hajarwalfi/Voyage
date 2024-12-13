<?php
include 'database.php';
ob_start();
$title = "Gestion des activités";
?>

<section class="Formulaire_client bg-[#f9f3fe] h-[40%] w-full rounded-md grid grid-cols-[80%_20%] px-8 py-1">
    <form id="form" class="grid md:grid-cols-5 gap-1 text-center items-center self-center justify-center" action="" method="post">

        <div class="flex flex-col gap-1">
            <label class="font-bold" for="titre">Titre</label>
            <input type="text" id="titre" name="titre" class="bg-gray-50 border border-[#a153c9] text-gray-900 text-sm rounded-lg p-2.5 focus:outline-none focus:ring focus:ring-[#922fc5]">
        </div>

        <div class="flex flex-col gap-1">
            <label class="font-bold" for="description">Description</label>
            <input type="text" id="description" name="description" class="bg-gray-50 border border-[#a153c9] text-gray-900 text-sm rounded-lg p-2.5 focus:outline-none focus:ring focus:ring-[#922fc5]">
        </div>

        <div class="flex flex-col gap-1">
            <label class="font-bold" for="destination">Destination</label>
            <input type="text" id="destination" name="destination" class="bg-gray-50 border border-[#a153c9] text-gray-900 text-sm rounded-lg p-2.5 focus:outline-none focus:ring focus:ring-[#922fc5]">
        </div>

        <div class="flex flex-col gap-1">
            <label class="font-bold" for="prix">Prix</label>
            <input type="number" id="prix" name="prix" class="bg-gray-50 border border-[#a153c9] text-gray-900 text-sm rounded-lg p-2.5 focus:outline-none focus:ring focus:ring-[#922fc5]">
        </div>
            
        <div class="flex flex-col gap-1">
            <label class="font-bold" for="date_debut">Date de Début</label>
            <input type="date" id="date_debut" name="date_debut" class="bg-gray-50 border border-[#a153c9] text-gray-900 text-sm rounded-lg p-2.5 focus:outline-none focus:ring focus:ring-[#922fc5]">
        </div>

        <div class="flex flex-col gap-1">
            <label class="font-bold" for="date_fin">Date de Fin</label>
            <input type="date" id="date_fin" name="date_fin" class="bg-gray-50 border border-[#a153c9] text-gray-900 text-sm rounded-lg p-2.5 focus:outline-none focus:ring focus:ring-[#922fc5]">
        </div>

        <div class="flex flex-col gap-1">
            <label class="font-bold" for="places_disponibles">Places disponibles</label>
            <input type="number" id="places_disponibles" name="places_disponibles" class="bg-gray-50 border border-[#a153c9] text-gray-900 text-sm rounded-lg p-2.5 focus:outline-none focus:ring focus:ring-[#922fc5]">
        </div>
        
        <div>
            <button name="ajouter_activite" id="ajouter_activite" class="mt-4 items-center self-center align-middle  bg-[#d5a6f6] w-fit p-4 text-black hover:bg-[#a658d1] py-2 rounded-md">Ajouter l'activité</button>
        </div>
        <div></div>

    </form>

    <div class="flex justify-center items-center">
        <img src="./assets/activite.png" class="w-[90%]">
    </div>
   
</section>

<?php

    // Start Ajouter une Activité 

    if (isset($_POST['ajouter_activite'])) {

        $titre = mysqli_real_escape_string($conn, $_POST['titre']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);
        $destination = mysqli_real_escape_string($conn, $_POST['destination']);
        $prix = mysqli_real_escape_string($conn, $_POST['prix']);
        $date_debut = mysqli_real_escape_string($conn, $_POST['date_debut']);
        $date_fin = mysqli_real_escape_string($conn, $_POST['date_fin']);
        $places_disponibles = mysqli_real_escape_string($conn, $_POST['places_disponibles']);
        
    
        $sql = "INSERT INTO activite (titre, description, destination, prix, date_debut, date_fin, places_disponibles) 
                VALUES ('$titre','$description','$destination','$prix','$date_debut','$date_fin','$places_disponibles')";

        mysqli_query($conn, $sql); 
    }
    

    // End Ajouter une Activité

   // Start Afficher les activités

    $query_select = "SELECT * FROM activite";
    $resultat = mysqli_query($conn, $query_select);


    if ($resultat) {
        echo '<div class="Table mt-8 h-[65%] overflow-auto">';
        echo '<table class="w-full  overflow-auto text-sm text-center text-gray-500 bg-gray-100 rounded-md border border-purple-500 ">';
        echo '<thead class="text-s text-gray-700  bg-[#f9f3fe]">';
        echo '<tr>
                <th scope="col" class="px-6 py-3">ID Activité</th>
                <th scope="col" class="px-6 py-3">Titre</th>
                <th scope="col" class="px-6 py-3">Description</th>
                <th scope="col" class="px-6 py-3">Destination</th>
                <th scope="col" class="px-6 py-3">Prix</th>
                <th scope="col" class="px-6 py-3">Date de Début</th>
                <th scope="col" class="px-6 py-3">Date de Fin</th>
                <th scope="col" class="px-6 py-3">Places Disponibles</th>
                </tr>';
        echo '</thead>';
        echo '<tbody>';
    
        while ($row = mysqli_fetch_assoc($resultat)) {
            echo '<tr class="bg-white border-b hover:bg-gray-50">';
            echo "<td class='px-6 py-4'>{$row['id_activite']}</td>";
            echo "<td class='px-6 py-4'>{$row['titre']}</td>";
            echo "<td class='px-6 py-4'>{$row['description']}</td>";
            echo "<td class='px-6 py-4'>{$row['destination']}</td>";
            echo "<td class='px-6 py-4'>{$row['prix']}</td>";
            echo "<td class='px-6 py-4'>{$row['date_debut']}</td>";
            echo "<td class='px-6 py-4'>{$row['date_fin']}</td>";
            echo "<td class='px-6 py-4'>{$row['places_disponibles']}</td>";
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
        echo '</div>';
    }

    // End Afficher les activités

    // Fermeture de la connexion
    mysqli_close($conn);
    ?>
    <?php
    $content = ob_get_clean();
    include 'design.php';
?>

