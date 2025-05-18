

<?php


require_once '../../Modelo/DAO/ClassHospedeDAO.php';
require_once '../../Modelo/DAO/ClassQuartoDAO.php';

$hospedeDAO = new ClassHospedeDAO();
$quartoDAO = new ClassQuartoDAO();

$hospedes = $hospedeDAO->listarHospede(); // ou outro nome que você tenha dado
$quartos = $quartoDAO->listarQuarto();
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

<h2>Nova Reserva</h2>

<form action="../../Controle/ControleReserva.php?ACAO=cadastrarReserva" method="POST">
  
  <label for="idHospede">Hóspede: </label>
  <select name="idHospede" required>
    <option value="">Selecione...</option>
    <?php foreach ($hospedes as $h): ?>
      <option value="<?= $h['idHospede'] ?>"><?= $h['nome'] ?> - <?= $h['email'] ?></option>
      <?php endforeach; ?>
  </select>

  <label for="idQuarto">Quarto: </label>
  <select name="idQuarto">
    <option value="">Selecione...</option>
    <?php foreach ($quartos as $q): ?>
      <option value="<?= $q['idQuarto'] ?>">#<?= $q['numero'] ?> - <?= $q['tipo'] ?> - <?= $q['preco'] ?></option>
      <?php endforeach; ?>
  </select>


  <label>Check-in:</label>
  <input type="date" name="checkin" required>

  <label>Check-out:</label>
  <input type="date" name="checkout" required>

  <button type="submit">Confirmar Reserva</button>
</form>

</body>
</html>
