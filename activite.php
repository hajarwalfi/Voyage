<?php
include 'database.php';
ob_start();
$title = "Gestion des activités";
?>

<div id="modal" class="hidden fixed inset-0 flex items-center justify-center z-20">
    <div class="bg-blue-50 w-72 m-auto p-5 rounded-lg">
        <form id="form" class="flex flex-col gap-1"  action="" method="post">
            <div class="flex flex-col gap-1">
                <label for="titre">Titre:</label>
                <input type="text" id="titre" name="titre" class="bg-gray-50 border border-blue-300 text-gray-900 text-sm rounded-lg p-2.5 focus:outline-none focus:ring focus:ring-blue-400">
            </div>

            <div class="flex flex-col gap-1">
                <label for="description">Description:</label>
                <input type="text" id="description" name="description" class="bg-gray-50 border border-blue-300 text-gray-900 text-sm rounded-lg p-2.5 focus:outline-none focus:ring focus:ring-blue-400">
            </div>

            <div class="flex flex-col gap-1">
                <label for="destination">Destination</label>
                <input type="text" id="destination" name="destination" class="bg-gray-50 border border-blue-300 text-gray-900 text-sm rounded-lg p-2.5 focus:outline-none focus:ring focus:ring-blue-400">
            </div>

            <div class="flex flex-col gap-1">
                <label for="prix">Prix:</label>
                <input type="number" id="prix" name="prix" class="bg-gray-50 border border-blue-300 text-gray-900 text-sm rounded-lg p-2.5 focus:outline-none focus:ring focus:ring-blue-400">
            </div>
             
            <div class="flex flex-col gap-1">
                <label for="date_debut">Date de Début:</label>
                <input type="date" id="date_debut" name="date_debut" class="bg-gray-50 border border-blue-300 text-gray-900 text-sm rounded-lg p-2.5 focus:outline-none focus:ring focus:ring-blue-400">
            </div>

            <div class="flex flex-col gap-1">
                <label for="date_fin">Date de Fin:</label>
                <input type="date" id="date_fin" name="date_fin" class="bg-gray-50 border border-blue-300 text-gray-900 text-sm rounded-lg p-2.5 focus:outline-none focus:ring focus:ring-blue-400">
            </div>

            <div class="flex flex-col gap-1">
                <label for="places_disponibles">Places disponibles:</label>
                <input type="number" id="places_disponibles" name="places_disponibles" class="bg-gray-50 border border-blue-300 text-gray-900 text-sm rounded-lg p-2.5 focus:outline-none focus:ring focus:ring-blue-400">
            </div>

            <div>
                <button type="submit" name="ajouter_reservation" id="ajouter_reservation" class="mt-4 bg-blue-200 w-full text-white hover:bg-blue-400 py-2 rounded-md">Ajouter la réservation</button>
                <button id="annuler_reservation" class="mt-4 bg-red-200 w-full text-white hover:bg-red-400 py-2 rounded-md">Annuler</button>
            </div>
        </form>
    </div>
</div>


<?php

    // Start Ajouter une Activité 

    if (isset($_POST['ajouter_reservation'])) {

        $titre = mysqli_real_escape_string($conn, $_POST['titre']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);
        $destination = mysqli_real_escape_string($conn, $_POST['destination']);
        $prix = mysqli_real_escape_string($conn, $_POST['prix']);
        $date_debut = mysqli_real_escape_string($conn, $_POST['date_debut']);
        $date_fin = mysqli_real_escape_string($conn, $_POST['date_fin']);
        $places_disponibles = mysqli_real_escape_string($conn, $_POST['places_disponibles']);
        
    
        $sql = "INSERT INTO reservation (id_activite, titre, description, destination, prix, date_debut, date_fin, places_disponibles) 
                VALUES ('$titre','$description','$destination','$prix','$date_debut','$date_fin','$places_disponibles')";
            
        if (mysqli_query($conn, $sql)) {
            echo "L'activité est ajoutée avec succès";
        } else {
            echo "Erreur : " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    

    // End Ajouter une Activité

   // Start Afficher les activités

    $query_select = "SELECT * FROM activite";
    $resultat = mysqli_query($conn, $query_select);


    if ($resultat) {
        echo '<div class="overflow-x-auto relative mt-4">';
        echo '<table class="table-auto w-full text-sm text-left text-gray-500 border border-gray-200">';
        echo '<thead class="text-xs text-gray-700 uppercase bg-gray-100 border-b border-gray-200">';
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

