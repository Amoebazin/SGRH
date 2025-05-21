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
</head>
<body>

<h2>Reservas Cadastradas</h2>

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
    </tr>
    <?php endforeach; ?>

    <td>
    <a href="Alterar.php?idReserva=<?= $reserva['idReserva'] ?>">Editar</a> |
    <a href="../../Controle/ControleReserva.php?ACAO=excluirReserva&idex=<?= $reserva['idReserva'] ?>"
       onclick="return confirm('Tem certeza que deseja excluir esta reserva?')">Excluir</a>
    <a href="../../index.php">Voltar
    </a>
</td>

</table>

</body>
</html>
