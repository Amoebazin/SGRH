<?php
require_once '../../Modelo/DAO/ClassQuartoDAO.php';

$classQuartoDAO = new ClassQuartoDAO();
$quartos = $classQuartoDAO->listarTodosQuartos();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Quartos</title>
</head>
<body>

<h2>Quartos Cadastrados</h2>

<?php if (isset($_GET['MSG'])): ?>
    <p><?= htmlspecialchars($_GET['MSG']) ?></p>
<?php endif; ?>

<table border="1">
    <tr>
        <th>ID Quarto</th>
        <th>Quarto</th>
        <th>Tipo</th>
        <th>Preço Total</th>
        <th>Ações</th>
    </tr>
    <?php foreach ($quartos as $quarto): ?>
    <tr>
        <td><?= $quarto['idQuarto'] ?></td>
        <td><?= $quarto['numero'] ?></td>
        <td><?= $quarto['tipo'] ?></td>
        <td>R$ <?= number_format($quarto['preco'], 2, ',', '.') ?></td>
        <td>
            <a href="Alterar.php?ACAO=alterarQuarto&idQuarto=<?= $quarto['idQuarto'] ?>">Alterar</a> |
            <a href="../../Controle/ControleQuarto.php?ACAO=excluirQuarto&idQuarto=<?= $quarto['idQuarto'] ?>"
               onclick="return confirm('Tem certeza que deseja excluir este quarto?')">Excluir</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<p><a href="../../index.php">Voltar</a></p>

</body>
</html>
