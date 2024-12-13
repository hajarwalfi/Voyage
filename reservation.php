<?php
include 'database.php';
ob_start();
$title = "Gestion des réservations";
?>

<section class="Formulaire_client bg-[#f9f3fe] h-[50%] w-full rounded-md grid grid-cols-[80%_20%] px-8 py-1">
    <form id="form" class="grid grid-cols-2 md:grid-cols-4 gap-1 text-center items-center justify-center" action="" method="post">

        <div class="flex flex-col gap-1">
            <label for="date_reservation">Date de la reservation:</label>
            <input type="date" id="date_reservation" name="date_reservation" class="bg-gray-50 border border-[#a153c9] text-gray-900 text-sm rounded-lg p-2.5 focus:outline-none focus:ring focus:ring-[#922fc5]">
        </div>

        <div class="flex flex-col gap-1">
            <label for="statut">Statut:</label>
            <select id="statut" name="statut" class="bg-gray-50 border border-[#a153c9] text-gray-900 text-sm rounded-lg p-2.5 focus:outline-none focus:ring focus:ring-[#922fc5]">
                <option value="Confirmée">Confirmée</option>
                <option value="Annulée">Annulée</option>
                <option value="En-attente">En attente</option>
            </select>
        </div>
        
        <div class="flex flex-col gap-1">
            <label for="id_client">ID client:</label>
            <input type="number" id="id_client" name="id_client" class="bg-gray-50 border border-[#a153c9] text-gray-900 text-sm rounded-lg p-2.5 focus:outline-none focus:ring focus:ring-[#922fc5]">
        </div>

        <div class="flex flex-col gap-1">
            <label for="id_activite">ID Activité:</label>
            <input type="number" id="id_activite" name="id_activite" class="bg-gray-50 border border-[#a153c9] text-gray-900 text-sm rounded-lg p-2.5 focus:outline-none focus:ring focus:ring-[#922fc5]">
        </div>

       
        <div class="col-span-4">
            <button type="submit" name="ajouter_reservation" id="ajouter_reservation" class="mt-4 items-center self-center align-middle  bg-[#d5a6f6] w-fit p-4 text-black hover:bg-[#a658d1] py-2 rounded-md">Ajouter la réservation</button>
        </div>
        
    </form>

    <div class="flex justify-center items-center">
        <img src="./assets/reservations.png" class="w-[90%]">
    </div>
   
</section>



<?php

    // Start Ajouter une réservation 

    if (isset($_POST['ajouter_reservation'])) {

        $date_reservation = mysqli_real_escape_string($conn, $_POST['date_reservation']);
        $statut = mysqli_real_escape_string($conn, $_POST['statut']);
        $id_client = mysqli_real_escape_string($conn, $_POST['id_client']);
        $id_activite = mysqli_real_escape_string($conn, $_POST['id_activite']);
        
    
        $sql = "INSERT INTO reservation (date_reservation, statut, id_client, id_activite) 
                VALUES ('$date_reservation','$statut','$id_client','$id_activite')";
            
        mysqli_query($conn, $sql);
    }
    

    // End Ajouter une réservation

   // Start Afficher les réservations

    $query_select = "select r.id_reservation ,a.titre ,  c.nom  , c.prenom , r.statut ,r.date_reservation ,a.prix
    from reservation as r  
    inner join activite as a  on a.id_activite = r.id_activite 
    inner join  client as c  on c.id_client = r.id_client";


    $resultat = mysqli_query($conn, $query_select);


    if ($resultat) {
        echo '<div class="Table mt-8 h-[65%] overflow-auto">';
        echo '<table class="w-full  overflow-auto text-sm text-center text-gray-500 bg-gray-100 rounded-md border border-purple-500 ">';
        echo '<thead class="text-s text-gray-700  bg-[#f9f3fe]">';
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

