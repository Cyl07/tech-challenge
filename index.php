<?php
require_once '_connec.php';

$pdo = new \PDO(DSN, USER, PASS);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = array_map('trim', $_POST);
    $query = "insert into argonaute(name) values(:name)";
    $statement = $pdo->prepare($query);
    $statement->bindValue("name", $name["name"], \PDO::PARAM_STR);
    $statement->execute();
    header("Location:");
}

$query = "select name from argonaute";
$statement = $pdo->prepare($query);
$statement->execute();
$names = $statement->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- Header section -->
    <header class="header">
        <h1>
            Les Argonautes
        </h1>
        <svg viewBox="0 0 960 200">
            <polygon class="secondary-clr" points="50 160, 480 20, 910 160" />
            <polygon class="primary-clr" points="110 150, 480 30, 850 150" />
            <polygon class="primary-clr" points="50 160, 480 20, 910 160, 915 140, 480 0, 45, 140" />
            <polygon class="primary-clr" points="70 160, 890 160, 890 180, 70 180" />
            <line class="ceiling" x1="50" y1="160" x2="480" y2="20" />
            <line class="ceiling" x1="480" y1="20" x2="910" y2="160" />
            <line class="inner left" x1="110" y1="150" x2="480" y2="30" />
            <line class="inner right" x1="480" y1="30" x2="850" y2="150" />
            <line class="inner bottom" x1="110" y1="150" x2="850" y2="150" />
        </svg>
    </header>

    <!-- Main section -->
    <main class="inside">
        <!-- New member form -->
        <form class="new-member-form" method="POST">
            <h2>Ajouter un(e) Argonaute</h2>
            <label for="name">Nom de l&apos;Argonaute</label>
            <input id="name" name="name" type="text" placeholder="Charalampos" />
            <button type="submit">Envoyer</button>
        </form>

        <!-- Member list -->
        <section class="member-list">
            <h2>Membres de l'équipage</h2>
            <?php foreach ($names as $name) : ?>
                <div class="member-item"><?= $name["name"] ?></div>
            <?php endforeach; ?>
        </section>
    </main>

    <footer>
        <p>Réalisé par Jason en Anthestérion de l'an 515 avant JC</p>
    </footer>
</body>

</html>