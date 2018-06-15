<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="css/calendar.css">
    <title><?= isset($title) ? security($title) : 'PHP Calendar'; ?></title>
</head>
<body>
    <nav class="navbar navbar-dark bg-success mb-3">
        <a href="index.php" class="navbar-brand">Mon Calendrier</a>
    </nav>