
-- -- ===== Creation d'une database =====
CREATE DATABASE test3;
use test3;

-- ===== Creation des Tables =====
CREATE TABLE activite (
  id_activite INT AUTO_INCREMENT PRIMARY KEY,
  titre varchar(150),
  description text,
  destination varchar(100),
  prix decimal(10,0),
  date_debut date,
  date_fin date,
  places_disponibles int
);

CREATE TABLE client (
  id_client INT AUTO_INCREMENT PRIMARY KEY,
  nom varchar(100),
  prenom varchar(100),
  email varchar(150),
  telephone varchar(150),
  adresse text,
  date_naissance date
);

CREATE TABLE reservation (
  id_reservation INT AUTO_INCREMENT PRIMARY KEY,
  id_client INT NOT NULL,
  id_activite INT NOT NULL,
  date_reservation TIMESTAMP,
  statut ENUM('En attente', 'Confirmée', 'Annulée'),
  FOREIGN KEY (id_client) REFERENCES client(id_client),
  FOREIGN KEY (id_activite) REFERENCES activite(id_activite)
);

 

-- ===== Insertion dans les tableaux =====

INSERT INTO activite ( titre, description, destination, prix, date_debut, date_fin, places_disponibles) VALUES
('Safari Désert', 'voyage à travers les dunes du désert', 'Merzouga', 1000.00, '2024-12-20', '2024-12-25', 12),
('Excursion Cascade', 'Randonnée vers les cascades pittoresques d Ouzoud', 'Ouzoud', 400.00, '2024-12-18', '2024-12-24', 2),
('Trekking  Montagnes', 'Expédition à travers les montagnes du Haut Atlas', 'Haut Atlas', 600.00, '2024-12-11', '2024-12-13', 10);

INSERT INTO client (nom, prenom, email, telephone, adresse, date_naissance) VALUES
('Hajar', 'Walfi', 'wh@gmail.com', '0606121314', 'Al Madina Villas Route TAKABROUTE', '2002-07-24'),
('Meriem', 'Walfi', 'wm@gmail.com', '0606070405', '12 Residence 5299', '2000-07-21'),
('Abdo', 'Walfi', 'AW@gmail.com', '0645787945', 'BD SAADA 192', '1987-01-11'),
('Rachida', 'Walfi', 'RW@gmail.com', '0675787945', 'BD SAADA 492', '1988-01-22'),
('Zakaria', 'Anis', 'zW@gmail.com', '06457887945', 'BD SAADA 500', '1940-05-22'),
('Sanna', 'Mouwahid', 'SM@gmail.com', '0645783945', 'BD Anfa 192', '2017-07-01'),
('Morjana', 'Soundouss', 'MS@gmail.com', '0648787945', 'BD ALmoharib 192', '1995-07-02');


INSERT INTO reservation (date_reservation, statut, id_client, id_activite) VALUES
(2024-10-19, 'Confirmée', 1, 1),
(2024-05-24,'Annulée',3,2),
(2024-06-11,'En attente',4,3);

-- ===== la suppression d'une reservation =====

DELETE FROM reservation WHERE statut='Annulée';

-- ===== la mise à jour d'une activité =====

UPDATE activite
SET prix=400, places_disponibles=2
WHERE id_activite=2;

-- ===== la requette de jointure =====
SELECT a.*  
FROM activite AS a  
INNER JOIN reservation AS r  ON a.id_activite = r.id_activite 
INNER JOIN  client AS c  ON c.id_client = r.id_client
WHERE nom="Hajar";
