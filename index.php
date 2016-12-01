<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = new Silex\Application();

/* CONEXAO COM O BANCO */
function getConn() {
    $dsn = 'mysql:host=localhost;dbname=myestoque';
    try {
        return $dbh = new PDO($dsn, 'root', '');
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
}

//PEGA PRODUTOS NO ESTOQUE
function getEstoque() {
    $stmt = getConn()->query("SELECT * FROM estoque");
    $estoque = $stmt->fetchAll(PDO::FETCH_OBJ);
    echo json_encode(array('estoque' => $estoque));
}

#ROTA PARA ESTOQUE
$app->get('/estoque','getEstoque');

$app->run();

