<?php
require_once '../../Modelo/DAO/ClassHospedeDAO.php';

$classHospedeDAO = new ClassHospedeDAO();
$hospedes = $classHospedeDAO->listarTodosHospedes();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Hóspedes</title>
    <link rel="stylesheet" href="..\css\listarHospede.css">
</head>
<body>

<h2>Hospedes Cadastrados</h2>

<?php if (isset($_GET['MSG'])): ?>
    <p><?= htmlspecialchars($_GET['MSG']) ?></p>
<?php endif; ?>

<table border="1">
    <tr>
        <th>ID Hospede</th>
        <th>Hóspede</th>
        <th>Email</th>
        <th>Telefone</th>
        <th>Data_Nascimento</th>
        <th>Ações</th>
    </tr>
    <?php foreach ($hospedes as $hospede): ?>
    <tr>
        <td><?= $hospede['idHospede'] ?></td>
        <td><?= $hospede['nome'] ?></td>
        <td><?= $hospede['email'] ?></td>
        <td><?= $hospede['telefone'] ?></td>
        <td><?= $hospede['data_nascimento'] ?></td>
        <td>
            <a href="Alterar.php?ACAO=alterarHospede&idHospede=<?= $hospede['idHospede'] ?>">Alterar</a> 
            <a href="../../Controle/ControleHospede.php?ACAO=excluirHospede&idHospede=<?= $hospede['idHospede'] ?>"
               onclick="return confirm('Tem certeza que deseja excluir este Hóspede?')">Excluir</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<p><a href="../../index.php">Voltar</a></p>

</body>
</html>
