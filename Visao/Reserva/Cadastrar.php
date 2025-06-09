

<?php


require_once '../../Modelo/DAO/ClassHospedeDAO.php';
require_once '../../Modelo/DAO/ClassQuartoDAO.php';

$hospedeDAO = new ClassHospedeDAO();
$quartoDAO = new ClassQuartoDAO();

$quartoDAO = new ClassQuartoDAO(); 
$ultimoQuarto = $quartoDAO->buscarUltimoQuarto(); 

$hospedes = $hospedeDAO->listarTodosHospedes();
$quartos = $quartoDAO->listarTodosQuartos();
$ultimoHospede = $hospedeDAO->buscarUltimoHospede(); 
$ultimoQuarto = $quartoDAO->buscarUltimoQuarto(); 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="..\css\cadFormReserva.css">
</head>
<body>

<h2>Nova Reserva</h2>
<form action="../../Controle/ControleReserva.php?ACAO=cadastrarReserva" method="POST">
  
 <label for="idHospede">Hóspede:</label>
  <input type="hidden" name="idHospede" value="<?= $ultimoHospede['idHospede'] ?>">
  <input type="text" name="nomeHospede" value="<?= $ultimoHospede['nome'] ?>" readonly>
  <input type="text" name="emailHospede" value="<?= $ultimoHospede['email'] ?>" readonly>

  <label for="idQuarto">Quarto:</label>
  <input type="hidden" name="idQuarto" value="<?= $ultimoQuarto['idQuarto'] ?>">
  <input type="text" name="numeroQuarto" value="<?= $ultimoQuarto['numero'] ?>" readonly>
  <input type="text" name="tipoQuarto" value="<?= $ultimoQuarto['tipo'] ?>" readonly>
  <input type="text" name="precoQuarto" value="<?= $ultimoQuarto['preco'] ?>" readonly>


  <label>Check-in:</label>
  <input type="datetime-local" name="checkin" required>

  <label>Check-out:</label>
  <input type="datetime-local" name="checkout" required>

  <button type="submit">Confirmar Reserva</button>

</form>

</body>
</html>
