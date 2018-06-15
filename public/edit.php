<?php 
    require 'init.php';

    $pdo = get_PDO();

    $events = new Calendar\Events($pdo);
    $errors = [];

    if (!isset($_GET['id'])) {
        header('location: 404.php');
    }
    try{
        $event = $events->find($_GET['id']);
    }
    catch(\Exception $e) {
        error();
    } 

    $data = [
        'name' => $event->getName(),
        'data' => $event->getStart()->format('Y-m-d'),
        'start' =>$event->getStart()->format('H:i'),
        'end' => $event->getEnd()->format('H:i'),
        'description' => $event->getDescription()
    ];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = $_POST;
        $validator = new Calendar\EventValidator();
        $errors = $validator->validates($data);
        if (empty($errors)) {
            $events->hydrate($event, $data);
            $events->update($event);
            header('Location: index.php?success=1');
            exit();
        }
    }
    
    render('header', ['title' => $event->getName()]);
?>

<div class="container">
    <h1>Editer l'évènement <small><?= $event->getName(); ?></small></h1>  

    <form action="" method="post" class="form">

        <?php render('form', ['data' => $data, 'errors' => $errors]); ?>
        
        <div class="form-group">
            <button class="btn btn-success" type="submit">Modifier l'événement</button>
        </div>

    </form>
</div>

<?php include 'views/footer.php'; ?>
