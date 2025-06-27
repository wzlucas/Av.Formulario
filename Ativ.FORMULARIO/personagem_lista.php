<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once("util/Conexao.php");

$con = Conexao::getCon();

// Buscar os personagens cadastrados
$sql = "SELECT * FROM personagens ORDER BY id DESC";
$stm = $con->prepare($sql);
$stm->execute();
$personagens = $stm->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Personagens - One Piece</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/estilo.css" rel="stylesheet">
</head>
<body>
    <div class="container container-custom">
        <h1>Personagens Cadastrados</h1>

        <div class="mb-3 text-center">
            <a href="index.php" class="btn btn-custom">Cadastrar Novo Personagem</a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover table-custom">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Recompensa</th>
                        <th>Origem</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($personagens as $p): ?>
                        <tr>
                            <td><?= $p["id"] ?></td>
                            <td><?= $p["nome"] ?></td>
                            <td><?= number_format($p["recompensa"], 0, ",", ".") ?> Berries</td>
                            <td><?= $p["origem"] ?></td>
                            <td>
                                <a href="personagem_card.php?id=<?= $p['id'] ?>" class="btn btn-dark btn-sm">Ver Detalhes</a>
                                <a href="excluir.php?id=<?= $p['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir?');">Excluir</a>


                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
