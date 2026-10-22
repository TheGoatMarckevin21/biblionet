<?php
class Adherent {
    private $db;

    public function __construct() {
      $this->db = Database::getConnection();
    }

    // Récupérer tous les adhérents
    public function all() {
        $stmt = $this->db->query("SELECT * FROM adherents ORDER BY nom, prenom ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer un adhérent par son ID
    public function find($id) {
        $stmt = $this->db->prepare("SELECT * FROM adherents WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Ajouter un nouvel adhérent
    public function create($data) {
        $sql = "INSERT INTO adherents (nom, prenom, classe, telephone) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            $data['nom'],
            $data['prenom'],
            $data['classe'],
            $data['telephone']
        ]);
    }

    // Mettre à jour un adhérent existant
    public function update($id, $data) {
        $sql = "UPDATE adherents SET nom = ?, prenom = ?, classe = ?, telephone = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            $data['nom'],
            $data['prenom'],
            $data['classe'],
            $data['telephone'],
            $id
        ]);
    }

    // Supprimer un adhérent
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM adherents WHERE id = ?");
        return $stmt->execute([$id]);
    }
}