<?php
include 'database.php';
ob_start();
$title = "Gestion des clients";
?>

<section class="Formulaire_client bg-[#f9f3fe] h-[30%] w-full rounded-md grid grid-cols-[80%_20%] px-8 py-1">
    <form id="form" class="grid grid-cols-2 md:grid-cols-3 md:grid-rows-3 gap-1 text-center items-center self-center justify-center" action="" method="post">

        <div class="flex flex-col gap-1">
            <label class="font-bold" for="nom">Nom</label>
            <input type="text" id="nom" name="nom" class="bg-gray-50 border border-[#a153c9] text-gray-900 text-sm rounded-lg p-2.5 focus:outline-none focus:ring focus:ring-[#922fc5]">
        </div>

        <div class="flex flex-col gap-1">
            <label class="font-bold" for="prenom">Prénom</label>
            <input type="text" id="prenom" name="prenom" class="bg-gray-50 border border-[#a153c9] text-gray-900 text-sm rounded-lg p-2.5 focus:outline-none focus:ring focus:ring-[#922fc5]">
        </div>
        
        <div class="flex flex-col gap-1">
            <label class="font-bold" for="email">Email</label>
            <input type="email" id="email" name="email" class="bg-gray-50 border border-[#a153c9] text-gray-900 text-sm rounded-lg p-2.5 focus:outline-none focus:ring focus:ring-[#922fc5]">
        </div>

        <div class="flex flex-col gap-1">
            <label class="font-bold"  for="telephone">Télèphone</label>
            <input type="tel" id="telephone" name="telephone" class="bg-gray-50 border border-[#a153c9] text-gray-900 text-sm rounded-lg p-2.5 focus:outline-none focus:ring focus:ring-[#922fc5]">
        </div>

        <div class="flex flex-col gap-1">
            <label class="font-bold" for="adresse">Adresse</label>
            <input type="text" id="adresse" name="adresse" class="bg-gray-50 border border-[#a153c9] text-gray-900 text-sm rounded-lg p-2.5 focus:outline-none focus:ring focus:ring-[#922fc5]">
        </div>


        <div class="flex flex-col gap-1">
            <label class="font-bold" for="date_naissance">Date de naissance</label>
            <input type="date" id="date_naissance" name="date_naissance" class="bg-gray-50 border border-[#a153c9] text-gray-900 text-sm rounded-lg p-2.5 focus:outline-none focus:ring focus:ring-[#922fc5]">
        </div>
        <div></div>
        <div>
            <button type="submit" name="ajouter_client" id="ajouter_client" class="mt-4 items-center bg-[#d5a6f6] w-[50%] text-black hover:bg-[#a658d1] py-2 rounded-md">Ajouter le client</button>
        </div>
        <div></div>
    </form>

    <div class="flex justify-center items-center">
        <img src="./assets/Client.png" class="w-[90%]">
    </div>
   
</section>



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
    }

    // End Ajouter une réservation

    // Start Afficher les réservations

    $query_select = "SELECT * FROM client" ;

    $resultat = mysqli_query($conn, $query_select);

    if ($resultat) {
        echo '<section class="Table mt-8 h-[65%] overflow-auto">';
        echo '<table class="w-full  overflow-auto text-sm text-center text-gray-500 bg-gray-100 rounded-md border border-purple-500 overflow-hidden">';
        echo '<thead class="text-s text-gray-700  bg-[#f9f3fe]">';
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
            echo "<td class='px-6 py-3'>{$row['id_client']}</td>";
            echo "<td class='px-6 py-3'>{$row['nom']} {$row['prenom']}</td>";
            echo "<td class='px-6 py-3'>{$row['telephone']}</td>";
            echo "<td class='px-6 py-3'>{$row['email']}</td>";
            echo "<td class='px-6 py-3'>{$row['adresse']}</td>";
            echo "<td class='px-6 py-3'>{$row['date_naissance']}</td>";
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
        echo '</section>';
    }

    // End Afficher les réservations

    // Fermeture de la connexion
    mysqli_close($conn);
    ?>
    <?php
    $content = ob_get_clean();
    include 'design.php';
?>

