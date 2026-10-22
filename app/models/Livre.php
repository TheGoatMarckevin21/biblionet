<?php
class Livre {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    // Récupère tous les livres + calcule les exemplaires disponibles
    public function all(?string $search = null): array {
        $sql = "SELECT l.*, 
                (l.nb_exemplaires - COUNT(CASE WHEN e.date_retour IS NULL AND e.id IS NOT NULL THEN 1 END)) AS disponibles
                FROM livres l
                LEFT JOIN emprunts e ON l.id = e.livre_id";
        
        $params = [];
        if (!empty($search)) {
            $sql .= " WHERE l.titre LIKE ? OR l.auteur LIKE ?";
            $params[] = "%$search%";
            $params[] = "%$search%";
        }

        $sql .= " GROUP BY l.id ORDER BY l.id DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function find(int $id): ?array {
        $stmt = $this->db->prepare("SELECT * FROM livres WHERE id = ?");
        $stmt->execute([$id]);
        $livre = $stmt->fetch();
        return $livre ?: null;
    }

    public function create(array $data): bool {
        $stmt = $this->db->prepare(
            "INSERT INTO livres (titre, auteur, categorie, annee, nb_exemplaires, image) VALUES (?, ?, ?, ?, ?, ?)"
        );
        return $stmt->execute([
            $data['titre'],
            $data['auteur'],
            $data['categorie'],
            (int)$data['annee'],
            (int)$data['nb_exemplaires'],
            $data['image'] ?? null
        ]);
    }

    public function update(int $id, array $data): bool {
        $stmt = $this->db->prepare(
            "UPDATE livres SET titre = ?, auteur = ?, categorie = ?, annee = ?, nb_exemplaires = ?, image = ? WHERE id = ?"
        );
        return $stmt->execute([
            $data['titre'],
            $data['auteur'],
            $data['categorie'],
            (int)$data['annee'],
            (int)$data['nb_exemplaires'],
            $data['image'] ?? null,
            $id
        ]);
    }

    public function delete(int $id): bool {
        $stmt = $this->db->prepare("DELETE FROM livres WHERE id = ?");
        return $stmt->execute([$id]);
    }
}