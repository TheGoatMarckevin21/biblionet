<?php
require_once dirname(__DIR__) . '/models/Livre.php';

class LivreController extends Controller {
    private Livre $livreModel;

    public function __construct() {
        $this->requireAuth(); // Protège toutes les actions par la session
        $this->livreModel = new Livre();
    }

    public function index(): void {
        $livres = $this->livreModel->all();
        $this->render('livres/index', ['livres' => $livres]);
    }

    public function create(): void {
        $this->render('livres/form', ['title' => 'Ajouter un livre']);
    }

    public function store(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'titre' => trim($_POST['titre'] ?? ''),
                'auteur' => trim($_POST['auteur'] ?? ''),
                'categorie' => trim($_POST['categorie'] ?? ''),
                'annee' => (int)($_POST['annee'] ?? date('Y')),
                'nb_exemplaires' => max(0, (int)($_POST['nb_exemplaires'] ?? 1))
            ];
            $this->livreModel->create($data);
            $this->redirect('livres');
        }
    }

    public function edit($id): void {
        $livre = $this->livreModel->find((int)$id);
        if (!$livre) {
            $this->redirect('livres');
        }
        $this->render('livres/form', [
            'title' => 'Modifier le livre',
            'livre' => $livre
        ]);
    }

    public function update($id): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'titre' => trim($_POST['titre'] ?? ''),
                'auteur' => trim($_POST['auteur'] ?? ''),
                'categorie' => trim($_POST['categorie'] ?? ''),
                'annee' => (int)($_POST['annee'] ?? date('Y')),
                'nb_exemplaires' => max(0, (int)($_POST['nb_exemplaires'] ?? 1))
            ];
            $this->livreModel->update((int)$id, $data);
            $this->redirect('livres');
        }
    }

    public function delete($id): void {
        try {
            $this->livreModel->delete((int)$id);
        } catch (PDOException $e) {
            // Empêche le crash si le livre est lié à un emprunt (ON DELETE RESTRICT)
        }
        $this->redirect('livres');
    }
}