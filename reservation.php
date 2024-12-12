<?php
include 'db.php';
ob_start();
$title = "Gestion des reservations";
?>

<div id="modal" class="hidden fixed inset-0 flex items-center justify-center z-20">
    <div class="bg-blue-50 w-72 m-auto p-5 rounded-lg">
                <form id="form" class="flex flex-col gap-1"  action="" method="post">
                    <div class="flex flex-col gap-1">
                        <label for="name">Date de la reservation:</label>
                        <input type="date" id="date_reservation" name="date_reservation" class="bg-gray-50 border border-blue-300 text-gray-900 text-sm rounded-lg p-2.5 focus:outline-none focus:ring focus:ring-blue-400">
                    </div>

                    <div class="flex flex-col gap-1">
                        <label for="statut">Statut:</label>
                        <select id="statut" class="bg-gray-50 border border-blue-300 text-gray-900 text-sm rounded-lg p-2.5 focus:outline-none focus:ring focus:ring-blue-400">
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

                </form>

                <button type="submit" name="ajouter_reservation" id="ajouter_reservation" class="mt-4 bg-blue-200 w-full text-white hover:bg-blue-400 py-2 rounded-md">Ajouter la réservation</button>
                <button id="annuler_reservation" class="mt-4 bg-red-200 w-full text-white hover:bg-red-400 py-2 rounded-md">Annuler</button>
    </div>
</div>


<?php

// Start Ajouter une réservation 

if (isset($_POST['ajouter_reservation'])) {

    $date_reservation = date("Y-m-d H:i:s");
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
    echo "<div><table><thead><tr><th>id reservation</th><th>client</th><th>activite</th><th>statut</th><th>date reservation</th><th>prix</th></tr></thead><tbody>";
    while ($row = mysqli_fetch_assoc($resultat)) {
        echo "<tr>
        <td>{$row["id_reservation"]}</td>
        <td>{$row["nom"]} {$row["prenom"]}</td>
        <td>{$row["titre"]}</td>
        <td>{$row["statut"]}</td>
        <td>{$row["date_reservation"]}</td>
        <td>{$row["prix"]}</td>
        <td><
        </tr>";
    }
    echo "</tbody></table></div>";
}

// End Afficher les réservations




// Fermeture de la connexion
mysqli_close($conn);
?>
<?php
$content = ob_get_clean();
include 'layout.php';
?>
