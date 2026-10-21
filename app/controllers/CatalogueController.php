<?php
class CatalogueController extends Controller {
    public function index(): void {
    
        $pdo = Database::getConnection();
        $nbLivres = $pdo->query("SELECT COUNT(*) FROM livres")->fetchColumn();

        $this->render('catalogue/index', [
            'nbLivres' => $nbLivres
        ]);
    }
}