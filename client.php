<?php
include 'database.php';
ob_start();
$title = "Gestion des clients";
?>

<div id="modal" class="hidden fixed inset-0 flex items-center justify-center z-20">
    <div class="bg-blue-50 w-72 m-auto p-5 rounded-lg">
                <form id="form" class="flex flex-col gap-1" action="" method="post">
                    <div class="flex flex-col gap-1">
                        <label for="nom">Nom:</label>
                        <input type="text" id="nom" name="nom" class="bg-gray-50 border border-blue-300 text-gray-900 text-sm rounded-lg p-2.5 focus:outline-none focus:ring focus:ring-blue-400">
                    </div>

                    <div class="flex flex-col gap-1">
                        <label for="prenom">Prénom:</label>
                        <input type="text" id="prenom" name="prenom" class="bg-gray-50 border border-blue-300 text-gray-900 text-sm rounded-lg p-2.5 focus:outline-none focus:ring focus:ring-blue-400">
                    </div>
                 
                    <div class="flex flex-col gap-1">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" class="bg-gray-50 border border-blue-300 text-gray-900 text-sm rounded-lg p-2.5 focus:outline-none focus:ring focus:ring-blue-400">
                    </div>

                    <div class="flex flex-col gap-1">
                        <label for="telephone">Télèphone:</label>
                        <input type="tel" id="telephone" name="telephone" class="bg-gray-50 border border-blue-300 text-gray-900 text-sm rounded-lg p-2.5 focus:outline-none focus:ring focus:ring-blue-400">
                    </div>

                    <div class="flex flex-col gap-1">
                        <label for="adresse">Adresse:</label>
                        <input type="text" id="adresse" name="adresse" class="bg-gray-50 border border-blue-300 text-gray-900 text-sm rounded-lg p-2.5 focus:outline-none focus:ring focus:ring-blue-400">
                    </div>
                

                    <div class="flex flex-col gap-1">
                        <label for="date_naissance">Date de naissance:</label>
                        <input type="date" id="date_naissance" name="date_naissance" class="bg-gray-50 border border-blue-300 text-gray-900 text-sm rounded-lg p-2.5 focus:outline-none focus:ring focus:ring-blue-400">
                    </div>

                    <div>
                        <button type="submit" name="ajouter_client" id="ajouter_client" class="mt-4 bg-blue-200 w-full text-white hover:bg-blue-400 py-2 rounded-md">Ajouter le client</button>
                        <button id="annuler_client" class="mt-4 bg-red-200 w-full text-white hover:bg-red-400 py-2 rounded-md">Annuler</button>
                    </div>


                </form>

                
    </div>
</div>



<?php

    // Start Ajouter une réservation 

    if (isset($_POST['ajouter_client'])) {

        $nom = mysqli_real_escape_string($conn, $_POST['nom']);
        $prenom = mysqli_real_escape_string($conn, $_POST['prenom']);
        $telephone = mysqli_real_escape_string($conn, $_POST['telephone']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $adresse = mysqli_real_escape_string($conn, $_POST['adresse']);
        $date_naissance = mysqli_real_escape_string($conn, $_POST['date_naissance']);

        $sql = "INSERT INTO client (nom, prenom, telephone, email ,adresse ,date_naissance) 
                VALUES ('$nom','$prenom','$telephone', '$email' ,'$adresse','$date_naissance')";
            
        if (mysqli_query($conn, $sql)) {
            echo "Réservation ajoutée avec succès";
        } else {
            echo "Erreur : " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    // End Ajouter une réservation

    // Start Afficher les réservations

    $query_select = "SELECT * FROM client" ;

    $resultat = mysqli_query($conn, $query_select);

    if ($resultat) {
        echo '<div class="overflow-x-auto relative mt-4">';
        echo '<table class="table-auto w-full text-sm text-left text-gray-500 border border-gray-200">';
        echo '<thead class="text-xs text-gray-700 uppercase bg-gray-100 border-b border-gray-200">';
        echo '<tr>
                <th scope="col" class="px-6 py-3">ID Client</th>
                <th scope="col" class="px-6 py-3">Client</th>
                <th scope="col" class="px-6 py-3">Telephone</th>
                <th scope="col" class="px-6 py-3">Email</th>
                <th scope="col" class="px-6 py-3">Adresse</th>
                <th scope="col" class="px-6 py-3">Date de naissance</th>
                </tr>';
        echo '</thead>';
        echo '<tbody>';
    
        while ($row = mysqli_fetch_assoc($resultat)) {
            echo '<tr class="bg-white border-b hover:bg-gray-50">';
            echo "<td class='px-6 py-4'>{$row['id_client']}</td>";
            echo "<td class='px-6 py-4'>{$row['nom']} {$row['prenom']}</td>";
            echo "<td class='px-6 py-4'>{$row['telephone']}</td>";
            echo "<td class='px-6 py-4'>{$row['email']}</td>";
            echo "<td class='px-6 py-4'>{$row['adresse']}</td>";
            echo "<td class='px-6 py-4'>{$row['date_naissance']}</td>";
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

