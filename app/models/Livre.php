<?php

class Livre {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function all(?string $search = null): array {
        $sql = "SELECT l.*,
                       l.nb_exemplaires - COUNT(
                           CASE WHEN e.date_retour IS NULL AND e.id IS NOT NULL THEN 1 END
                       ) AS disponibles
                FROM livres l
                LEFT JOIN emprunts e ON l.id = e.livre_id";
        $params = [];

        if ($search !== null && $search !== '') {
            $sql .= " WHERE l.titre LIKE ? OR l.auteur LIKE ?";
            $params = ["%$search%", "%$search%"];
        }

        $sql .= " GROUP BY l.id ORDER BY l.id DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll();
    }

    public function find(int $id): ?array {
        $stmt = $this->db->prepare("SELECT * FROM livres WHERE id = ?");
        $stmt->execute([$id]);

        return $stmt->fetch() ?: null;
    }

    public function create(
        string $titre,
        string $auteur,
        string $categorie,
        int $annee,
        int $nb_exemplaires
    ): bool {
        $stmt = $this->db->prepare(
            "INSERT INTO livres (titre, auteur, categorie, annee, nb_exemplaires)
             VALUES (?, ?, ?, ?, ?)"
        );

        return $stmt->execute([$titre, $auteur, $categorie, $annee, $nb_exemplaires]);
    }

    public function update(
        int $id,
        string $titre,
        string $auteur,
        string $categorie,
        int $annee,
        int $nb_exemplaires
    ): bool {
        $stmt = $this->db->prepare(
            "UPDATE livres
             SET titre = ?, auteur = ?, categorie = ?, annee = ?, nb_exemplaires = ?
             WHERE id = ?"
        );

        return $stmt->execute([$titre, $auteur, $categorie, $annee, $nb_exemplaires, $id]);
    }

    public function delete(int $id): bool {
        $stmt = $this->db->prepare("DELETE FROM livres WHERE id = ?");

        return $stmt->execute([$id]);
    }
}
