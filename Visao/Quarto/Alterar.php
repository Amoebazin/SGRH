<?php
require_once '../../Modelo/ClassQuarto.php';
require_once '../../Modelo/DAO/ClassQuartoDAO.php';

if (isset($_GET['idQuarto'])) {
    $id = $_GET['idQuarto'];
    $dao = new ClassQuartoDAO();
    $quarto = $dao->buscarQuarto($id); // Deve retornar objeto ClassQuarto

    $numero = $quarto->getNumero();
    $tipo = $quarto->getTipo();
    $preco = $quarto->getPreco();
    $status = $quarto->getStatus();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Alterar Quarto</title>
</head>
<body>

<h2>Alterar Quarto</h2>

<form action="../../Controle/ControleQuarto.php?ACAO=alterarQuarto" method="POST">
    <input type="hidden" name="idQuarto" value="<?= $quarto->getIdQuarto() ?>">

    <label for="numero">Número do Quarto:</label>
    <input type="text" name="numero" id="numero" value="<?= $numero ?>" readonly>

    <label for="tipo">Tipo:</label>
    <input type="text" name="tipo" id="tipo" value="<?= $tipo ?>" readonly>

    <label for="preco">Preço (R$):</label>
    <input type="number" name="preco" id="preco" step="0.01" value="<?= $preco ?>" readonly>

    <label for="status">Status:</label>
    <select name="status" id="status" required>
        <option value="Disponível" <?= $status == 'Disponível' ? 'selected' : '' ?>>Disponível</option>
        <option value="Indisponível" <?= $status == 'Indisponível' ? 'selected' : '' ?>>Indisponível</option>
        <option value="Manutenção" <?= $status == 'Manutenção' ? 'selected' : '' ?>>Manutenção</option>
    </select>

    <button type="submit">Salvar Alterações</button>
</form>

</body>
</html>
