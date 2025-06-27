<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once("util/Conexao.php");

$con = Conexao::getCon();

// Listagem dos personagens
$sql = "SELECT * FROM personagens";
$stm = $con->prepare($sql);
$stm->execute();
$personagens = $stm->fetchAll();

$msgErro = "";
$msgSucesso = "";


if (isset($_POST["nome"])) {
    $nome = trim($_POST["nome"]);
    $genero = $_POST["genero"];
    $filiacao = trim($_POST["filiacao"]);
    $recompensa = $_POST["recompensa"];
    $origem = $_POST["origem"];
    $akuma = trim($_POST["akuma_no_mi"]);
    $imagem = trim($_POST["imagem_url"]);

    $erros = array();

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

    // Validação da imagem 
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
        $msgErro = implode("<br>", $erros);
    }
}

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
        <h1>Cadastrar Personagem</h1>

        <?php if ($msgErro): ?>
            <div class="alert alert-danger"><?= $msgErro ?></div>
        <?php elseif ($msgSucesso): ?>
            <div class="alert alert-success"><?= $msgSucesso ?></div>
        <?php endif; ?>

        <form method="POST" class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Nome </label>
                <input type="text" name="nome" class="form-control" />
            </div>

            <div class="col-md-6">
                <label class="form-label">Gênero </label>
                <select name="genero" class="form-select">
                    <option value="">Selecione</option>
                    <option value="Masculino">Masculino</option>
                    <option value="Feminino">Feminino</option>
                    <option value="Outro">Outro</option>
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label">Filiação </label>
                <input type="text" name="filiacao" class="form-control" />
            </div>

            <div class="col-md-6">
                <label class="form-label">Recompensa </label>
                <input type="number" name="recompensa" class="form-control" />
            </div>

            <div class="col-md-6">
                <label class="form-label">Origem </label>
                <select name="origem" class="form-select">
                    <option value="">Selecione</option>
                    <option value="East Blue">East Blue</option>
                    <option value="North Blue">North Blue</option>
                    <option value="South Blue">South Blue</option>
                    <option value="West Blue">West Blue</option>
                    <option value="Grand Line">Grand Line</option>
                    <option value="Red Line">Red Line</option>
                    <option value="Wano">Wano</option>
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label">Akuma no Mi </label>
                <input type="text" name="akuma_no_mi" class="form-control" />
            </div>

            <div class="col-md-12">
                <label class="form-label">URL da Imagem (opcional)</label>
                <input type="text" name="imagem_url" class="form-control" />
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-custom">Cadastrar</button>
                <a href="personagem_lista.php" class="btn btn-light">Ver Lista</a>
            </div>
        </form>
    </div>

</body>
</html>
