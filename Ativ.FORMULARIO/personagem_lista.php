<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once("dao/PersonagemDAO.php");

$dao = new PersonagemDAO();

// Chama o método que retorna todos os personagens cadastrados
$personagens = $dao->listarPersonagens();
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

        <!-- Botão para ir à página de cadastro de um novo personagem -->
        <div class="mb-3 text-center">
            <a href="index.php" class="btn btn-custom">Cadastrar Novo Personagem</a>
        </div>

        <!-- Tabela que lista todos os personagens -->
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

                    <!-- Percorre a lista de personagens e exibe um por linha -->
                    <?php foreach ($personagens as $p): ?>
                        <tr>
                            <td><?= $p->getId() ?></td>
                            <td><?= $p->getNome() ?></td>
                            <td><?= number_format($p->getRecompensa(), 0, ",", ".") ?> Berries</td>
                            <td><?= $p->getOrigem() ?></td>
                            <td>
                                <!-- Botão que leva à página de detalhes do personagem -->
                                <a href="personagem_card.php?id=<?= $p->getId() ?>" class="btn btn-dark btn-sm">Ver Detalhes</a>

                                <!-- Botão que chama o script de exclusão. Inclui confirmação -->
                                <a href="excluir.php?id=<?= $p->getId() ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir?');">Excluir</a>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
