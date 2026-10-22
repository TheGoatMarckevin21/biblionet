<?php
class Emprunt {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    // Récupérer tous les emprunts avec les infos des adhérents et des livres
    public function all() {
        $sql = "SELECT emprunts.*, adherents.nom, adherents.prenom, livres.titre 
                FROM emprunts 
                JOIN adherents ON emprunts.id_adherent = adherents.id 
                JOIN livres ON emprunts.id_livre = livres.id 
                ORDER BY emprunts.date_emprunt DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Enregistrer un nouvel emprunt
    public function create($data) {
        $sql = "INSERT INTO emprunts (id_adherent, id_livre, date_emprunt, date_retour_prevue, statut) VALUES (?, ?, ?, ?, 'en cours')";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            $data['id_adherent'],
            $data['id_livre'],
            $data['date_emprunt'],
            $data['date_retour_prevue']
        ]);
    }

    // Enregistrer le retour d'un livre
    public function retourner($id) {
        $sql = "UPDATE emprunts SET date_retour_effective = NOW(), statut = 'retourné' WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id]);
    }
}