<?php
require 'init.php';

$data = [
    'date' => $_GET['date'] ?? date('Y-m-d'),
    'start' => date('H:i'),
    'end' => date('H:i')
];
$validator = new \App\Validator($data);

if (!$validator->validate('date', 'date')) {
    $data['date'] = date('Y-m-d');
    
}
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST;
    $validator = new Calendar\EventValidator();
    $errors = $validator->validates($_POST);
    if (empty($errors)) {
        $events = new Calendar\Events(get_PDO());
        $event = $events->hydrate(new Calendar\Event(), $data);
        $events->create($event);
        header('Location: index.php?success=1');
        exit();
    }
}

render('header', ['title' => 'Ajouter un événement']);

?>


<div class="container">
    <?php if (!empty($errors)):?>
        <div class="alert alert-danger">
            Merce de corriger vos erreurs!
        </div>
    <?php endif; ?>

    <h1>Ajouter un événement</h1>

    <form action="" method="post" class="form">
    
       <?php render('form', ['data' => $data, 'errors' => $errors]); ?>
        
        <div class="form-group">
            <button class="btn btn-primary" type="submit">Ajouter l'événement</button>
        </div>

    </form>
</div>
<?php render('footer'); ?>