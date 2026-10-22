

SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS emprunts;
DROP TABLE IF EXISTS adherents;
DROP TABLE IF EXISTS livres;
DROP TABLE IF EXISTS users;
SET FOREIGN_KEY_CHECKS = 1;


CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nom VARCHAR(100) NOT NULL,
  email VARCHAR(150) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE livres (
  id INT AUTO_INCREMENT PRIMARY KEY,
  titre VARCHAR(255) NOT NULL,
  auteur VARCHAR(150) NOT NULL,
  categorie VARCHAR(100) NOT NULL,
  annee INT NOT NULL,
  nb_exemplaires INT NOT NULL DEFAULT 1,
  image VARCHAR(255) DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE adherents (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nom VARCHAR(100) NOT NULL,
  prenom VARCHAR(100) NOT NULL,
  classe VARCHAR(50) NOT NULL,
  telephone VARCHAR(20) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE emprunts (
  id INT AUTO_INCREMENT PRIMARY KEY,
  livre_id INT NOT NULL,
  adherent_id INT NOT NULL,
  date_emprunt DATE NOT NULL,
  date_retour DATE DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (livre_id) REFERENCES livres(id) ON DELETE RESTRICT,
  FOREIGN KEY (adherent_id) REFERENCES adherents(id) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO users (nom, email, password) VALUES
('Marc ELLA', 'agent.biblio@biblionet.com', '$2y$10$w8T3fA.kR.jI/3Pz1O7vve0Qh.e7E5rQ5fK1eY3E8jU4g9hZ2L6KO');

-- Jeu de donnees : 15 Livres
INSERT INTO livres (titre, auteur, categorie, annee, nb_exemplaires) VALUES
('L\'Enfant noir', 'Camara Laye', 'Roman', 1953, 3),
('Une vie de boy', 'Ferdinand Oyono', 'Roman', 1956, 2),
('Apprendre PHP 8 et MySQL', 'Olivier Heurtel', 'Informatique', 2021, 2),
('1984', 'George Orwell', 'Science-Fiction', 1949, 1),
('Le Petit Prince', 'Antoine de Saint-Exupéry', 'Conte', 1943, 4),
('Sous l\'orage', 'Seydou Badian', 'Roman', 1957, 3),
('Les Misérables', 'Victor Hugo', 'Roman', 1862, 2),
('Alcools', 'Guillaume Apollinaire', 'Poésie', 1913, 2),
('L\'Étranger', 'Albert Camus', 'Roman', 1942, 3),
('HTML5 et CSS3', 'Christophe Aubry', 'Informatique', 2020, 2),
('L\'Aventure ambiguë', 'Cheikh Hamidou Kane', 'Roman', 1961, 2),
('Le Cid', 'Pierre Corneille', 'Théâtre', 1637, 3),
('Vol de nuit', 'Antoine de Saint-Exupéry', 'Roman', 1931, 1),
('JavaScript Modern', 'Chris Minnick', 'Informatique', 2019, 2),
('Germinal', 'Émile Zola', 'Roman', 1885, 2);

-- Jeu de donnees : 10 Adherents
INSERT INTO adherents (nom, prenom, classe, telephone) VALUES
('Mba', 'Junior', 'L3 Info', '07010203'),
('Ndong', 'Patricia', 'L2 SR', '06020304'),
('Obiang', 'Marc', 'M1 IS', '07030405'),
('Bignoumba', 'Grâce', 'L3 Info', '06040506'),
('Kombila', 'Arnaud', 'L1 Info', '07050607'),
('Mengue', 'Aline', 'M2 MIAGE', '06060708'),
('Nguema', 'Kévin', 'L2 SR', '07070809'),
('Ondo', 'Sarah', 'L3 Info', '06080910'),
('Nzué', 'Christ', 'L1 Info', '07091011'),
('Moussavou', 'Daphné', 'M1 IS', '06101112');

-- Jeu de donnees : Emprunts (en cours et retournes)
INSERT INTO emprunts (livre_id, adherent_id, date_emprunt, date_retour) VALUES
(1, 1, '2026-09-10', '2026-09-20'),
(2, 2, '2026-10-01', NULL),
(4, 3, '2026-10-05', NULL),
(3, 4, '2026-09-15', '2026-09-28'),
(6, 5, '2026-10-10', NULL),
(13, 6, '2026-10-12', NULL);