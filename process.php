<?php

$host = 'localhost';
$dbname = 'music';
$usernamess = 'root';
$passwords = '';

if (isset($_POST['insert'])) {

    try {
        // se connecter à mysql
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", "$usernamess", "$passwords");
    } catch (PDOException $exc) {
        echo $exc->getMessage();
        exit();
    }

    // récupérer les valeurs 
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $age = $_POST['age'];

    // Requête mysql pour insérer des données
    $sql = "INSERT INTO `signup`(`username`, `email`, `password`, `age`) VALUES (:username,:email,:password,:age;)";
    $res = $pdo->prepare($sql);
    $exec = $res->execute(array(":username" => $username, ":email" => $email, ":password" => $password, ":age" => $age));

    // vérifier si la requête d'insertion a réussi
    if ($exec) {
        echo 'Données insérées';
    } else {
        echo "Échec de l'opération d'insertion";
    }
}
