


<?php
$tipoQuarto = isset($_GET['tipo']) ? $_GET['tipo'] : '';


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
    <style>
        form {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background: #f9f9f9;
            border-radius: 8px;
            font-family: Arial, sans-serif;
        }
        label {
            display: block;
            margin-top: 10px;
        }
        input, select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
        }
        button {
            margin-top: 15px;
            padding: 10px;
            background: #4CAF50;
            border: none;
            color: white;
            width: 100%;
            cursor: pointer;
        }
    </style>
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
