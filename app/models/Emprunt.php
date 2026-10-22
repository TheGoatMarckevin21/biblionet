<?php
class Emprunt {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    // Récupérer tous les emprunts avec les infos des adhérents et des livres
    public function all() {
        $sql = "SELECT emprunts.*, adherents.nom, adherents.prenom, livres.titre 
                FROM emprunts 
                JOIN adherents ON emprunts.adherent_id = adherents.id 
                JOIN livres ON emprunts.livre_id = livres.id 
                ORDER BY emprunts.id DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Enregistre un emprunt seulement s'il reste un exemplaire. Retourne null si OK, sinon le message d'erreur.
    public function create($data): ?string {
        $this->db->beginTransaction();
        try {
            $stmt = $this->db->prepare("SELECT nb_exemplaires FROM livres WHERE id = ? FOR UPDATE");
            $stmt->execute([$data['livre_id']]);
            $nb = $stmt->fetchColumn();
            if ($nb === false) {
                $this->db->rollBack();
                return "Livre introuvable.";
            }

            $stmt = $this->db->prepare("SELECT COUNT(*) FROM emprunts WHERE livre_id = ? AND date_retour IS NULL");
            $stmt->execute([$data['livre_id']]);
            if ((int)$nb - (int)$stmt->fetchColumn() <= 0) {
                $this->db->rollBack();
                return "Ce livre n'a plus d'exemplaire disponible.";
            }

            $stmt = $this->db->prepare("INSERT INTO emprunts (adherent_id, livre_id, date_emprunt, date_retour) VALUES (?, ?, ?, NULL)");
            $stmt->execute([$data['adherent_id'], $data['livre_id'], $data['date_emprunt']]);
            $this->db->commit();
            return null;
        } catch (PDOException $ex) {
            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }
            return "Adhérent ou livre invalide.";
        }
    }

    // Enregistrer le retour d'un livre
    public function retourner($id) {
        $sql = "UPDATE emprunts SET date_retour = CURDATE() WHERE id = ? AND date_retour IS NULL";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id]);
    }
}

