<?php
$tipo = isset($_GET['tipo']) ? $_GET['tipo'] : '';
require_once '../../Modelo/DAO/ClassHospedeDAO.php';

$hospedeDAO = new ClassHospedeDAO();
$ultimoHospede = $hospedeDAO->buscarUltimoHospede(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href=".\Visao\css\form.css">
</head>
<body>
    <h1>Insira suas Crendenciais</h1>

    <form method="post" action="../../Controle/ControleHospede.php?ACAO=cadastrarHospede">
        
    <label for="nome">Nome: </label>
    <input type="text" name="nome" id="nome" required>

    <label for="email">Email: </label>
    <input type="email" name="email" id="email" required>

    <label for="telefone">Telefone: </label>
    <input type="tel" name="telefone" id="telefone" required>

    <label for="data_nascimento">Data de nascimento: </label>
    <input type="date" name="data_nascimento" id="data_nascimento">

    <input type="hidden" name="checkin" value="2024-05-10"> 
    <input type="hidden" name="checkout" value="2024-05-12">
    <input type="hidden" name="quarto" value="3">

    <input type="submit" value="Enviar">

    <input type="hidden" name="tipo" value="<?= htmlspecialchars($tipo) ?>">
</form>

</body>
</html>
