<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once("util/Conexao.php");

$con = Conexao::getCon();

$msgErro = "";
$msgSucesso = "";
$nome = "";
$genero = "";
$filiacao = "";
$recompensa = "";
$origem = "";
$akuma = "";
$imagem = "";

// Verifica se o formulário foi enviado 
if (isset($_POST["nome"])) {

    // Captura e limpa os dados enviados pelo formulário
    $nome = trim($_POST["nome"]);
    $genero = $_POST["genero"];
    $filiacao = trim($_POST["filiacao"]);
    $recompensa = $_POST["recompensa"];
    $origem = $_POST["origem"];
    $akuma = trim($_POST["akuma_no_mi"]);
    $imagem = trim($_POST["imagem_url"]);

    $erros = array();

    // Verifica se os campos obrigatórios foram preenchidos
    if (!$nome) array_push($erros, "Informe o nome!");
    if (!$genero) array_push($erros, "Informe o gênero!");
    if (!$filiacao) array_push($erros, "Informe a filiação!");
    if (!$recompensa) array_push($erros, "Informe a recompensa!");
    if (!$origem) array_push($erros, "Informe a origem!");
    if (!$akuma) array_push($erros, "Informe a Akuma no Mi!");

    // Valida se nome contém entre 2 e 50 caracteres
    if (strlen($nome) < 2 || strlen($nome) > 50) {
        array_push($erros, "O nome deve ter entre 2 e 50 caracteres.");
    }

    // Valida se a recompensa não é maior que 5.564.800.000
    if (!is_numeric($recompensa) || $recompensa < 0 || $recompensa > 5564800000) {
        array_push($erros, "A recompensa não pode ser maior que a do Rei dos Piratas!");
    }

    // Se a URL da imagem foi preenchida, verificar se é uma URL válida
    if ($imagem && !filter_var($imagem, FILTER_VALIDATE_URL)) {
        array_push($erros, "A URL da imagem é inválida.");
    }

    if (count($erros) == 0) {
        $sql = "INSERT INTO personagens (nome, genero, filiacao, recompensa, origem, akuma_no_mi, imagem_url)
                VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stm = $con->prepare($sql);
        $stm->execute([$nome, $genero, $filiacao, $recompensa, $origem, $akuma, $imagem]);

        // Redireciona para limpar o POST 
        header("Location: personagem_lista.php?sucesso=1");
        exit;

    } else {
        // Se houver erros, junta todos em uma string para exibir
        $msgErro = implode("<br>", $erros);
    }
}

// Exibe a mensagem de sucesso se veio pela URL
if (isset($_GET['sucesso'])) {
    $msgSucesso = "Personagem cadastrado com sucesso!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - One Piece</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/estilo.css" rel="stylesheet">

</head>
<body>

   <div class="container container-custom">
        <h1>Cadastrar Personagem - One Piece</h1>

        <!-- Exibe as mensagens de erro (validação) se houver -->
        <?php if ($msgErro): ?>
            <div class="alert alert-danger"><?= $msgErro ?></div>
        <?php elseif ($msgSucesso): ?>
            <div class="alert alert-success"><?= $msgSucesso ?></div>
        <?php endif; ?>

        <form method="POST" class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Nome </label>
                <input type="text" name="nome" class="form-control" value="<?= ($nome)?>" />
                
            </div>

            <div class="col-md-6">
                <label class="form-label">Gênero </label>
                <select name="genero" class="form-select">
                    <option value="">Selecione</option>
                    <option value="Masculino" <?= $genero == "Masculino" ? 'selected' : '' ?>>Masculino</option>
                    <option value="Feminino" <?= $genero == "Feminino" ? 'selected' : '' ?>>Feminino</option>
                    <option value="Outro" <?= $genero == "Outro" ? 'selected' : '' ?>>Outro</option>
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label">Filiação </label>
                <input type="text" name="filiacao" class="form-control" value="<?= ($filiacao)?>" />
            </div>

            <div class="col-md-6">
                <label class="form-label">Recompensa </label>
                <input type="number" name="recompensa" class="form-control" value="<?= ($recompensa)?>" />
            </div>

            <div class="col-md-6">
                <label class="form-label">Origem </label>
                <select name="origem" class="form-select">
                    <option value="">Selecione</option>
                    <option value="East Blue" <?= $genero == "East Blue" ? 'selected' : '' ?>>East Blue</option>
                    <option value="North Blue" <?= $genero == "North Blue" ? 'selected' : '' ?>>North Blue</option>
                    <option value="South Blue" <?= $genero == "South Blue" ? 'selected' : '' ?>>South Blue</option>
                    <option value="West Blue" <?= $genero == "West Blue" ? 'selected' : '' ?>>West Blue</option>
                    <option value="Grand Line" <?= $genero == "Grand Line" ? 'selected' : '' ?>>Grand Line</option>
                    <option value="Red Line" <?= $genero == "Red Line" ? 'selected' : '' ?>>Red Line</option>
                    <option value="Wano" <?= $genero == "Wano" ? 'selected' : '' ?>>Wano</option>
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label">Akuma no Mi </label>
                <input type="text" name="akuma_no_mi" class="form-control" value="<?= ($akuma)?>" />
            </div>

            <div class="col-md-12">
                <label class="form-label">URL da Imagem (opcional)</label>
                <input type="text" name="imagem_url" class="form-control" value="<?= ($imagem)?>" />
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-custom">Cadastrar</button>
                <a href="personagem_lista.php" class="btn btn-light">Ver Lista</a>
            </div>
        </form>
    </div>

</body>
</html>
