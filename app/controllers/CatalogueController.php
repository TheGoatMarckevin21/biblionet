<?php
<<<<<<< HEAD
require_once dirname(__DIR__) . '/models/Livre.php';

class CatalogueController extends Controller {
    public function index(): void {
        $livreModel = new Livre();
        $search = trim($_GET['q'] ?? '');
        $livres = $livreModel->all($search !== '' ? $search : null);

        $this->render('catalogue/index', [
            'livres' => $livres,
            'search' => $search
=======
class CatalogueController extends Controller {
    public function index(): void {
    
        $pdo = Database::getConnection();
        $nbLivres = $pdo->query("SELECT COUNT(*) FROM livres")->fetchColumn();

        $this->render('catalogue/index', [
            'nbLivres' => $nbLivres
>>>>>>> e077a350f33c36a7ed5e99e172b68f9a5c5c62db
        ]);
    }
}