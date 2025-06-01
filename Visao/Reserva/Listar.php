<?php
require_once '../../Modelo/DAO/ClassReservaDAO.php';

$classReservaDAO = new ClassReservaDAO();
$reservas = $classReservaDAO->listarTodasComDetalhes();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Reservas</title>
    <link rel="stylesheet" href="..\css\listarReserva.css">
</head>
<body>

<h2>Reservas Cadastradas</h2>

<?php if (isset($_GET['MSG'])): ?>
    <p><?= htmlspecialchars($_GET['MSG']) ?></p>
<?php endif; ?>

<table border="1">
    <tr>
        <th>ID Reserva</th>
        <th>Hóspede</th>
        <th>Email</th>
        <th>Quarto</th>
        <th>Tipo</th>
        <th>Check-in</th>
        <th>Check-out</th>
        <th>Preço Total</th>
        <th>Ações</th>
    </tr>
    <?php foreach ($reservas as $reserva): ?>
    <tr>
        <td><?= $reserva['idReserva'] ?></td>
        <td><?= $reserva['hospede_nome'] ?></td>
        <td><?= $reserva['hospede_email'] ?></td>
        <td><?= $reserva['quarto_numero'] ?></td>
        <td><?= $reserva['quarto_tipo'] ?></td>
        <td><?= $reserva['checkin'] ?></td>
        <td><?= $reserva['checkout'] ?></td>
        <td>R$ <?= number_format($reserva['preco'], 2, ',', '.') ?></td>
        <td>
            <a href="Alterar.php?ACAO=alterarReserva&idReserva=<?= $reserva['idReserva'] ?>">Alterar</a> 
            <a href="../../Controle/ControleReserva.php?ACAO=excluirReserva&idReserva=<?= $reserva['idReserva'] ?>"
               onclick="return confirm('Tem certeza que deseja excluir esta reserva?')">Excluir</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<p><a href="../../index.php">Voltar</a></p>

</body>
</html>
