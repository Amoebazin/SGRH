<?php
require_once '../../Modelo/DAO/ClassHospedeDAO.php';

$dao = new ClassHospedeDAO();
$hospedes = $dao->listarHospedes();

echo "<h2>Lista de Hóspedes</h2>";
echo "<table border='1'>";
echo "<tr><th>Nome</th><th>Telefone</th><th>Ações</th></tr>";

foreach ($hospedes as $h) {
    echo "<tr>";
    echo "<td>" . $h['nome'] . "</td>";
    echo "<td>" . $h['telefone'] . "</td>";
    echo "<td>
        <a href='../../Controle/ControleHospede.php?ACAO=excluirHospede&idHospede=" . $h['idHospede'] . "' onclick='return confirm(\"Deseja excluir?\")'>Excluir</a> |
        <a href='Hospede/Alterar.php?idHospede=" . $h['idHospede'] . "'>Alterar</a>
    </td>";
    echo "</tr>";
}
echo "</table>";