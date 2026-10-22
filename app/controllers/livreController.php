<?php
require_once dirname(__DIR__) . '/models/Livre.php';

class LivreController extends Controller {
    private Livre $livreModel;

    public function __construct() {
        $this->requireAuth();
        $this->livreModel = new Livre();
    }

    public function index(): void {
        $this->render('livres/index', ['livres' => $this->livreModel->all()]);
    }

    public function create(): void {
        $this->render('livres/form', ['title' => 'Ajouter un livre']);
    }

    public function store(): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('livres');
        }

        $data = $this->collect();
        if ($data['titre'] === '' || $data['auteur'] === '') {
            $this->flash('danger', 'Le titre et l\'auteur sont obligatoires.');
            $this->redirect('livres/create');
        }

        try {
            $data['image'] = Upload::image($_FILES['image'] ?? []);
        } catch (RuntimeException $e) {
            $this->flash('danger', $e->getMessage());
            $this->redirect('livres/create');
        }

        $this->livreModel->create($data);
        $this->flash('success', 'Livre ajouté.');
        $this->redirect('livres');
    }

    public function edit($id): void {
        $livre = $this->livreModel->find((int)$id);
        if (!$livre) {
            $this->redirect('livres');
        }
        $this->render('livres/form', ['title' => 'Modifier le livre', 'livre' => $livre]);
    }

    public function update($id): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('livres');
        }

        $livre = $this->livreModel->find((int)$id);
        if (!$livre) {
            $this->redirect('livres');
        }

        $data = $this->collect();
        if ($data['titre'] === '' || $data['auteur'] === '') {
            $this->flash('danger', 'Le titre et l\'auteur sont obligatoires.');
            $this->redirect('livres/edit/' . (int)$id);
        }

        $image = $livre['image'];
        try {
            $new = Upload::image($_FILES['image'] ?? []);
        } catch (RuntimeException $e) {
            $this->flash('danger', $e->getMessage());
            $this->redirect('livres/edit/' . (int)$id);
        }

        if ($new) {
            Upload::remove($image);
            $image = $new;
        } elseif (!empty($_POST['remove_image'])) {
            Upload::remove($image);
            $image = null;
        }

        $data['image'] = $image;
        $this->livreModel->update((int)$id, $data);
        $this->flash('success', 'Livre modifié.');
        $this->redirect('livres');
    }

    public function delete($id): void {
        $livre = $this->livreModel->find((int)$id);
        try {
            $this->livreModel->delete((int)$id);
            if ($livre) {
                Upload::remove($livre['image']);
            }
            $this->flash('success', 'Livre supprimé.');
        } catch (PDOException $e) {
            $this->flash('danger', 'Suppression impossible : ce livre a des emprunts enregistrés.');
        }
        $this->redirect('livres');
    }

    private function collect(): array {
        return [
            'titre'          => trim($_POST['titre'] ?? ''),
            'auteur'         => trim($_POST['auteur'] ?? ''),
            'categorie'      => trim($_POST['categorie'] ?? ''),
            'annee'          => (int)($_POST['annee'] ?? date('Y')),
            'nb_exemplaires' => max(0, (int)($_POST['nb_exemplaires'] ?? 1)),
        ];
    }
}
