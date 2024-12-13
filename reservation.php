<?php
include 'database.php';
ob_start();
$title = "Gestion des réservations";
?>

<div id="modal" class="hidden fixed inset-0 flex items-center justify-center z-20">
    <div class="bg-blue-50 w-72 m-auto p-5 rounded-lg">
        <form id="form" class="flex flex-col gap-1"  action="" method="post">
            <div class="flex flex-col gap-1">
                <label for="date_reservation">Date de la reservation:</label>
                <input type="date" id="date_reservation" name="date_reservation" class="bg-gray-50 border border-blue-300 text-gray-900 text-sm rounded-lg p-2.5 focus:outline-none focus:ring focus:ring-blue-400">
            </div>

            <div class="flex flex-col gap-1">
                <label for="statut">Statut:</label>
                <select id="statut" name="statut" class="bg-gray-50 border border-blue-300 text-gray-900 text-sm rounded-lg p-2.5 focus:outline-none focus:ring focus:ring-blue-400">
                    <option value="Confirmée">Confirmée</option>
                    <option value="Annulée">Annulée</option>
                    <option value="En-attente">En attente</option>
                </select>
            </div>

            <div class="flex flex-col gap-1">
                <label for="id_client">ID client:</label>
                <input type="number" id="id_client" name="id_client" class="bg-gray-50 border border-blue-300 text-gray-900 text-sm rounded-lg p-2.5 focus:outline-none focus:ring focus:ring-blue-400">
            </div>

            <div class="flex flex-col gap-1">
                <label for="id_activite">ID Activité:</label>
                <input type="number" id="id_activite" name="id_activite" class="bg-gray-50 border border-blue-300 text-gray-900 text-sm rounded-lg p-2.5 focus:outline-none focus:ring focus:ring-blue-400">
            </div>
             
            <div>
                <button type="submit" name="ajouter_reservation" id="ajouter_reservation" class="mt-4 bg-blue-200 w-full text-white hover:bg-blue-400 py-2 rounded-md">Ajouter la réservation</button>
                <button id="annuler_reservation" class="mt-4 bg-red-200 w-full text-white hover:bg-red-400 py-2 rounded-md">Annuler</button>
            </div>
        </form>
    </div>
</div>


<?php

    // Start Ajouter une réservation 

    if (isset($_POST['ajouter_reservation'])) {

        $date_reservation = mysqli_real_escape_string($conn, $_POST['date_reservation']);
        $statut = mysqli_real_escape_string($conn, $_POST['statut']);
        $id_client = mysqli_real_escape_string($conn, $_POST['id_client']);
        $id_activite = mysqli_real_escape_string($conn, $_POST['id_activite']);
        
    
        $sql = "INSERT INTO reservation (date_reservation, statut, id_client, id_activite) 
                VALUES ('$date_reservation','$statut','$id_client','$id_activite')";
            
        if (mysqli_query($conn, $sql)) {
            echo "Réservation ajoutée avec succès";
        } else {
            echo "Erreur : " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    

    // End Ajouter une réservation

   // Start Afficher les réservations

    $query_select = "select r.id_reservation ,a.titre ,  c.nom  , c.prenom , r.statut ,r.date_reservation ,a.prix
    from reservation as r  
    inner join activite as a  on a.id_activite = r.id_activite 
    inner join  client as c  on c.id_client = r.id_client";


    $resultat = mysqli_query($conn, $query_select);


    if ($resultat) {
        echo '<div class="overflow-x-auto relative mt-4">';
        echo '<table class="table-auto w-full text-sm text-left text-gray-500 border border-gray-200">';
        echo '<thead class="text-xs text-gray-700 uppercase bg-gray-100 border-b border-gray-200">';
        echo '<tr>
                <th scope="col" class="px-6 py-3">ID Reservation</th>
                <th scope="col" class="px-6 py-3">Client</th>
                <th scope="col" class="px-6 py-3">Titre</th>
                <th scope="col" class="px-6 py-3">Statut</th>
                <th scope="col" class="px-6 py-3">Date de Réservation</th>
                <th scope="col" class="px-6 py-3">Prix (DH)</th>
                </tr>';
        echo '</thead>';
        echo '<tbody>';
    
        while ($row = mysqli_fetch_assoc($resultat)) {
            echo '<tr class="bg-white border-b hover:bg-gray-50">';
            echo "<td class='px-6 py-4'>{$row['id_reservation']}</td>";
            echo "<td class='px-6 py-4'>{$row['nom']} {$row['prenom']}</td>";
            echo "<td class='px-6 py-4'>{$row['titre']}</td>";
            echo "<td class='px-6 py-4'>{$row['statut']}</td>";
            echo "<td class='px-6 py-4'>{$row['date_reservation']}</td>";
            echo "<td class='px-6 py-4'>{$row['prix']}</td>";
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
        echo '</div>';
    }

    // End Afficher les réservations

    // Fermeture de la connexion
    mysqli_close($conn);
    ?>
    <?php
    $content = ob_get_clean();
    include 'design.php';
?>

