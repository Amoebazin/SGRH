<?php
require_once '../../Modelo/DAO/ClassQuartoDAO.php';

$dao = new ClassQuartoDAO();
$quartos = $dao->listarQuartos();

echo "<h2>Lista de Quartos</h2>";
echo "<table border='1'>";
echo "<tr><th>Número</th><th>Tipo</th><th>Valor</th><th>Ações</th></tr>";

foreach ($quartos as $q) {
    echo "<tr>";
    echo "<td>" . $q['numero'] . "</td>";
    echo "<td>" . $q['tipo'] . "</td>";
    echo "<td>R$" . $q['preco'] . "</td>";
    echo "<td>
        <a href='../../Controle/ControleQuarto.php?ACAO=excluirQuarto&idQuarto=" . $q['idQuarto'] . "' onclick='return confirm(\"Deseja excluir?\")'>Excluir</a> |
        <a href='Quarto/Alterar.php?idQuarto=" . $q['idQuarto'] . "'>Alterar</a>
    </td>";
    echo "</tr>";
}
echo "</table>";
?>
