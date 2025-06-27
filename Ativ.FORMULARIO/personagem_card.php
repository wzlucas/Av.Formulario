<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once("util/Conexao.php");
require_once("model/Personagem.php");       
require_once("dao/PersonagemDAO.php"); 

// Captura o ID enviado pela URL com método GET. Se não tiver, o valor será null
$id = $_GET["id"] ?? null;

$personagem = null;

// Se um ID válido foi enviado na URL, faz a busca no banco de dados
if ($id) {
    $personagemDAO = new PersonagemDAO();   
    $personagem = $personagemDAO->buscarPorId($id); 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Personagem</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/estilo.css" rel="stylesheet">
    <style> 

    .container-custom {
    padding: 20px;
    max-width: 600px; 
    }

    .card-custom {
    max-width: 500px; 
    margin: 0 auto; 
    border: 3px solid #f8c24d; 
    }

    </style>
</head>
<body>

    <div class="container container-custom">

        <!-- Verifica se o personagem foi encontrado -->
        <?php if ($personagem): ?>

            <!-- Título com o nome do personagem -->
            <h1>Detalhes de <?= $personagem->getNome() ?></h1>

            <div class="card card-custom mb-3">

                <!-- Imagem do personagem, ou imagem genérica se estiver vazia -->
                <img src="<?=  $personagem->getImagemUrl() ?: 'https://ih1.redbubble.net/image.4356215318.1614/st,small,507x507-pad,600x600,f8f8f8.jpg' ?>" 
                class="card-img-top" alt="Imagem do personagem">

                <div class="card-body">

                    <h5 class="card-title"><?=  $personagem->getNome() ?></h5>

                    <p><strong>Gênero:</strong> <?= $personagem->getGenero() ?></p>
                    <p><strong>Filiação:</strong> <?= $personagem->getFiliacao() ?></p>
                    <p><strong>Recompensa:</strong> <?= number_format($personagem->getRecompensa(), 0, ",", ".") ?> Berries</p>
                    <p><strong>Origem:</strong> <?= $personagem->getOrigem() ?></p>
                    <p><strong>Akuma no Mi:</strong> <?= $personagem->getAkumaNoMi() ?></p>

                    <!-- Botão para voltar à listagem de personagens -->
                    <a href="personagem_lista.php" class="btn btn-custom">Voltar à Lista</a>
                </div>
            </div>

        <!-- Caso o personagem não seja encontrado (ID inválido ou inexistente) -->    
        <?php else: ?>
            <div class="alert alert-danger">Personagem não encontrado.</div>
            <a href="personagem_lista.php" class="btn btn-light">Voltar</a>
        <?php endif; ?>
    </div>
</body>
</html>
