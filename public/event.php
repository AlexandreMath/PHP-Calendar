<?php 
    require 'init.php';

    $pdo = get_PDO();

    $events = new Calendar\Events($pdo);
    if (!isset($_GET['id'])) {
        header('location: 404.php');
    }
    try{
        $event = $events->find($_GET['id']);
    }
    catch(\Exception $e) {
        error();
    } 
    render('header', ['title' => $event->getName()]);
?>
<div class="container">
    <h1><?= $event->getName(); ?></h1>  

    <ul>
        <li>Date: <?= $event->getStart()->format('d/m/Y'); ?></li>
        <li>Début : <?= $event->getStart()->format('H:i'); ?></li>
        <li>Fin : <?= $event->getEnd()->format('H:i'); ?></li>
        <li>
            Description :<br>
            <?= $event->getDescription(); ?>
        </li>
    </ul>

    <a href="edit.php?id=<?= $_GET['id']; ?>" class="btn btn-success">Modifier l'évènement</a>
    <a href="edit.php?id=<?= $_GET['id']; ?>" class="btn btn-danger">Supprimer l'évènement</a>
</div>
<?php include 'views/footer.php'; ?>
