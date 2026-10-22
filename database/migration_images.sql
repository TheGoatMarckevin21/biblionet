-- À exécuter UNE FOIS sur une base biblionet existante (local et en ligne)
ALTER TABLE livres ADD COLUMN image VARCHAR(255) DEFAULT NULL AFTER nb_exemplaires;
