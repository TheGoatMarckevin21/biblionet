<?php
require_once dirname(__DIR__) . '/models/Livre.php';

class CatalogueController extends Controller {
    public function index(): void {
        $livreModel = new Livre();
        $search = trim($_GET['q'] ?? '');
        $livres = $livreModel->all($search !== '' ? $search : null);

        $this->render('catalogue/index', [
            'livres' => $livres,
            'search' => $search
        ]);
    }
}