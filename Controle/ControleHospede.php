<?php

require_once '../Modelo/ClassHospede.php';
require_once '../Modelo/DAO/ClassHospedeDAO.php';

$acao = $_GET['ACAO'];
$tipo = @$_POST['tipo'];

$idHospede = @$_POST['idHospede'];
$nome = @$_POST['nome'];
$email = @$_POST['email'];
$telefone = @$_POST['telefone'];
$dataNascimento = @$_POST['data_nascimento'];

$novoHospede = new ClassHospede();
$novoHospede->setIdHospede($idHospede);
$novoHospede->setNome($nome);
$novoHospede->setEmail($email);
$novoHospede->setTelefone($telefone);
$novoHospede->setDataNascimento($dataNascimento);


$classHospedeDAO = new ClassHospedeDAO();

switch ($acao) {
    case 'cadastrarHospede':
        $hospede = $classHospedeDAO->cadastrarHospede($novoHospede);

        if ($hospede >= 1) {
            header("Location:../Visao/Quarto/Cadastrar.php?tipo=$tipo&MSG= Hóspde Cadastrado com Sucesso!!");
        } else {
            header('Location:../index.php?&MSG=Erro ao cadastrar hóspede.');
        }           
        break;

    case 'alterarHospede':
        $hospede = $classHospedeDAO->alterarHospede($novoHospede);
        if($hospede == 1){
            header('Location:../index.php?&MSG= Cadastro atualizado com sucesso!');
        } else {
            header('Location:../index.php?&MSG= Não possível realizar a atualização!');
        }
        break;

  case 'excluirHospede':
    if (isset($_GET['idHospede'])) {
        $idHospede = $_GET['idHospede'];
        $classHospedeDAO = new ClassHospedeDAO();
        $hs = $classHospedeDAO->excluirHospede($idHospede);
        if ($hs == TRUE) {
            header('Location:../index.php?PAGINA=listarHospede&MSG=Hóspede excluído com sucesso!');
        } else {
            header('Location:../index.php?PAGINA=listarHospede&MSG=Não foi possível excluir o hóspede!');
        }
    }
    break;

}