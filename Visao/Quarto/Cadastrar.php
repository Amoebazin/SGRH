<?php
require_once '../../Modelo/DAO/ClassQuartoDAO.php';

$tipoQuarto = isset($_GET['tipo']) ? $_GET['tipo'] : '';
$quartoDAO = new ClassQuartoDAO(); 
$ultimoQuarto = $quartoDAO->buscarUltimoQuarto(); 

switch ($tipoQuarto) {
    case 'Solteiro':
        $preco = 50.00;
        $quartosDisponiveis = ['A101', 'A102', 'A103'];
        break;
    case 'Casal':
        $preco = 100.00;
        $quartosDisponiveis = ['B201', 'B202', 'B203'];
        break;
    case 'Suite':
        $preco = 200.00;
        $quartosDisponiveis = ['C301', 'C302', 'C303'];
        break;
    default:
        $preco = 0.00;
        $quartosDisponiveis = [];
        break;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Quarto</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/cadFormQuarto.css">
</head>
<body>

<form action="../../Controle/ControleQuarto.php?ACAO=cadastrarQuarto" method="POST">
    <input type="hidden" name="acao" value="cadastrarQuarto">
  <input type="hidden" name="tipo" value="<?php echo htmlspecialchars($_GET['tipo']); ?>">

    <label for="numero">Número do Quarto:</label>
    <select name="numero" id="numero" required>
        <option value="">Selecione...</option>
        <?php foreach ($quartosDisponiveis as $numero): ?>
            <option value="<?= $numero ?>"><?= $numero ?></option>
        <?php endforeach; ?>
    </select>

    <label for="preco">Preço (R$):</label>
    <input type="number" name="preco" id="preco" step="0.01" value="<?= $preco ?>" readonly>

    <label for="status">Status:</label>
    <select name="status" id="status" required>
        <option value="Disponível">Disponível</option>
        <option value="Indisponível">Indisponível</option>
        <option value="Manutenção">Manutenção</option>
    </select>

    <button type="submit">Cadastrar Quarto</button>
</form>

</body>
</html>
