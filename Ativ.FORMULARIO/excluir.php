<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once("util/Conexao.php");

$con = Conexao::getCon();

$id = $_GET["id"] ?? null;

if ($id) {
    $sql = "DELETE FROM personagens WHERE id = ?";
    $stm = $con->prepare($sql);
    $stm->execute([$id]);
}

header("Location: personagem_lista.php");
exit;

