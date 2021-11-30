<?php
require_once '_connec.php';

$pdo = new \PDO(DSN, USER, PASS);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = array_map('trim', $_POST);
    $query = "insert into argonaute(name) values(:name)";
    $statement = $pdo->prepare($query);
    $statement->bindValue("name", $name["name"], \PDO::PARAM_STR);
    $statement->execute();
}

$query = "select name from argonaute";
$statement = $pdo->prepare($query);
$statement->execute();
$names = $statement->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- Header section -->
    <header>
        <h1>
            <img src="https://www.wildcodeschool.com/assets/logo_main-e4f3f744c8e717f1b7df3858dce55a86c63d4766d5d9a7f454250145f097c2fe.png" alt="Wild Code School logo" />
            Les Argonautes
        </h1>
    </header>

    <!-- Main section -->
    <main>

        <!-- New member form -->
        <h2>Ajouter un(e) Argonaute</h2>
        <form class="new-member-form" method="POST">
            <label for="name">Nom de l&apos;Argonaute</label>
            <input id="name" name="name" type="text" placeholder="Charalampos" />
            <button type="submit">Envoyer</button>
        </form>

        <!-- Member list -->
        <h2>Membres de l'équipage</h2>
        <section class="member-list">
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