<?php
require_once dirname(__DIR__) . '/models/Livre.php';
class LivreController extends Controller {
public function index(): void {
$this->requireAuth();
$this->render('livres/index', ['livres' => (new Livre())->all()]);
}
public function create(): void {
$this->requireAuth();
$this->render('livres/form', ['livre' => null]);
}
public function store(): void {
$this->requireAuth();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
(new Livre())->create(trim($_POST['titre']), trim($_POST['auteur']), trim($_POST['categorie']), (int)$_POST['annee'], (int)$_POST['nb_exemplaires']);
header('Location: ' . APP_URL . '/livres');
exit;
}
}
public function edit(int $id): void {
$this->requireAuth();
$this->render('livres/form', ['livre' => (new Livre())->find($id)]);
}
public function update(int $id): void {
$this->requireAuth();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
(new Livre())->update($id, trim($_POST['titre']), trim($_POST['auteur']), trim($_POST['categorie']), (int)$_POST['annee'], (int)$_POST['nb_exemplaires']);
header('Location: ' . APP_URL . '/livres');
exit;
}
}
public function delete(int $id): void {
$this->requireAuth();
(new Livre())->delete($id);
header('Location: ' . APP_URL . '/livres');
exit;
}
}