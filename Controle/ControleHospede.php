<?php

require_once '../Modelo/ClassHospede.php';
require_once '../Modelo/DAO/ClassHospedeDAO.php';

$acao = $_GET['ACAO'];

$idHospede = @$_POST['idH'];
$nome = @$_POST['nome'];
$email = @$_POST['email'];
$telefone = @$_POST['telefone'];
$dataNascimento = @$_POST['data_nascimento'];

$novoHospede = new ClassHospede();
$novoHospede->setIdHospede($id);
$novoHospede->setNome($nome);
$novoHospede->setEmail($email);
$novoHospede->setTelefone($telefone);
$novoHospede->setDataNascimento($dataNascimento);

$classHoespedeDAO = new ClassHospedeDAO();

switch ($acao) {
    case 'cadastrarHospede':
        $hospede = $$classHospedeDAO->cadastrar($novoHospede);
        if ($hospede >= 1) {
            header('Location:../index.php?&MSG=Hóspede cadastrado com sucesso!');
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
        if (isset($_GET['idH'])){
            $idHospede = $_GET['idH'];
            $classHoespedeDAO = new ClassHospedeDAO();
            $hs = $classUsuarioDAO->excluirHospede($idHospede);
            if ($hs == TRUE){
                header('Location:../index.php?PAGINA=listarHospede&MSG= Hóspede excluído com sucesso!');
            else{
                header('Location:../index.php?PAGINA=listarHospede&MSG= Não foi possível excluir o hóspede!');
                }
            }
        }
        break;

    default:
        break;
}

