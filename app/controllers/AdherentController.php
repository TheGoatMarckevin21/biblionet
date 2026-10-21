<?php
require_once '../app/models/Adherent.php';

class AdherentController extends Controller {
    private $adherentModel;

    public function __construct() {
        $this->adherentModel = new Adherent();
    }

    // Afficher la liste des adhérents
    public function index() {
        $adherents = $this->adherentModel->all();
        $this->render('adherents/index', ['adherents' => $adherents]);
    }

    // Afficher le formulaire de création
    public function create() {
        $this->render('adherents/form', ['title' => 'Ajouter un adhérent']);
    }

    // Enregistrer un nouvel adhérent
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nom'       => htmlspecialchars(trim($_POST['nom'])),
                'prenom'    => htmlspecialchars(trim($_POST['prenom'])),
                'classe'    => htmlspecialchars(trim($_POST['classe'])),
                'telephone' => htmlspecialchars(trim($_POST['telephone']))
            ];

            if ($this->adherentModel->create($data)) {
                header('Location: /adherents');
                exit();
            }
        }
    }

    // Afficher le formulaire de modification
    public function edit($id) {
        $adherent = $this->adherentModel->find($id);
        if (!$adherent) {
            header('Location: /adherents');
            exit();
        }
        $this->render('adherents/form', [
            'title'    => 'Modifier l\'adhérent',
            'adherent' => $adherent
        ]);
    }

    // Mettre à jour les données
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nom'       => htmlspecialchars(trim($_POST['nom'])),
                'prenom'    => htmlspecialchars(trim($_POST['prenom'])),
                'classe'    => htmlspecialchars(trim($_POST['classe'])),
                'telephone' => htmlspecialchars(trim($_POST['telephone']))
            ];

            if ($this->adherentModel->update($id, $data)) {
                header('Location: /adherents');
                exit();
            }
        }
    }

    // Supprimer un adhérent
    public function delete($id) {
        $this->adherentModel->delete($id);
        header('Location: /adherents');
        exit();
    }
}