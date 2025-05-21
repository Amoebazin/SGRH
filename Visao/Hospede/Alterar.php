<?php
require_once '../../Modelo/ClassHospede.php';
require_once '../../Modelo/DAO/ClassHospedeDAO.php';

if (isset($_GET['idHospede'])) {
    $id = $_GET['idHospede'];
    $dao = new ClassHospedeDAO();
    $hospede = $dao->buscarHospede($id);
}
?>

<h2>Alterar Hóspede</h2>
<form action="../../Controle/ControleHospede.php?ACAO=alterarHospede" method="post">
    <input type="hidden" name="idHospede" value="<?php echo $hospede->getIdHospede(); ?>">
    Nome: <input type="text" name="nome" value="<?php echo $hospede->getNome(); ?>"><br>
    Email: <input type="email" name="email" value="<?php echo $hospede->getEmail(); ?>">
    Telefone: <input type="text" name="telefone" value="<?php echo $hospede->getTelefone(); ?>"><br>
    Data de Nascimento: <input type="date" name="data_nascimrnto" value="<?php echo $hospede->getDataNascimento(); ?>">
    <input type="submit" value="Salvar Alterações">
</form>
