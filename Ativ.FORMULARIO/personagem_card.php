<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once("util/Conexao.php");
require_once("model/Personagem.php");       
require_once("dao/PersonagemDAO.php");      

$id = $_GET["id"] ?? null;
$personagem = null;

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
        <?php if ($personagem): ?>
            <h1>Detalhes de <?= $personagem->getNome() ?></h1>

            <div class="card card-custom mb-3">
                <img src="<?=  $personagem->getImagemUrl() ?: 'https://via.placeholder.com/500x300?text=Sem+Imagem' ?>" class="card-img-top" alt="Imagem do personagem">
                <div class="card-body">
                    <h5 class="card-title"><?=  $personagem->getNome() ?></h5>
                    <p><strong>Gênero:</strong> <?= $personagem->getGenero() ?></p>
                    <p><strong>Filiação:</strong> <?= $personagem->getFiliacao() ?></p>
                    <p><strong>Recompensa:</strong> <?= number_format($personagem->getRecompensa(), 0, ",", ".") ?> Berries</p>
                    <p><strong>Origem:</strong> <?= $personagem->getOrigem() ?></p>
                    <p><strong>Akuma no Mi:</strong> <?= $personagem->getAkumaNoMi() ?></p>
                    <a href="personagem_lista.php" class="btn btn-custom">Voltar à Lista</a>
                </div>
            </div>

        <?php else: ?>
            <div class="alert alert-danger">Personagem não encontrado.</div>
            <a href="personagem_lista.php" class="btn btn-light">Voltar</a>
        <?php endif; ?>
    </div>
</body>
</html>
