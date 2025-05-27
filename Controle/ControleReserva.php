<?php

require_once '../Modelo/ClassReserva.php';
require_once '../Modelo/DAO/ClassReservaDAO.php';

$idReserva = @$_POST['idex'];
$idHospede = @$_POST['idHospede'];
$idQuarto = @$_POST['idQuarto'];
$checkin = @$_POST['checkin'];
$checkout = @$_POST['checkout'];
$acao = isset($_GET['ACAO']) ? $_GET['ACAO'] : null;


$novaReserva = new ClassReserva();
$novaReserva->setIdReserva($idReserva);
$novaReserva->setIdHospede($idHospede);
$novaReserva->setIdQuarto($idQuarto);
$novaReserva->setCheckin($checkin);
$novaReserva->setCheckout($checkout);


$classReservaDAO = new ClassReservaDAO();

switch ($acao) {
    case "cadastrarReserva":
            $reserva = $classReservaDAO->cadastrarReserva($novaReserva);
            if ($reserva >= 1) {
                $classQuartoDAO = new ClassQuartoDAO();
               header('Location: ../Visao/Reserva/Listar.php?MSG=Reserva cadastrada com sucesso!');
               exit;
            } else {
                header('Location:../index.php?&MSG=Não foi possível realizar o cadastro!');
            }
        break;


   case "alterarReserva":
    // 1) Criar o objeto
    $novaReserva = new ClassReserva();

    // 2) Setar o ID — **sem isso o idReserva fica NULL**!
    $novaReserva->setIdReserva($_POST['idReserva']);

    // 3) Setar os campos que vêm do form
    $novaReserva->setCheckin($_POST['checkin']);
    $novaReserva->setCheckout($_POST['checkout']);

    // 4) Chamar o DAO
    $res = $classReservaDAO->alterarReserva($novaReserva);

    // 5) Lógica de redirecionamento
    if ($res === false) {
        // erro de execução
        header('Location:../index.php?&MSG=Erro ao executar o UPDATE!');
    } else {
        // res é int (0 = nada mudou / 1 = linha alterada)
        header(
          'Location:../Visao/Reserva/Listar.php?&MSG=' .
          ($res > 0
             ? 'Alteração realizada com sucesso!'
             : 'Nenhuma modificação detectada, mas sem erros.')
        );
    }
    exit;
    break;


    case "excluirReserva":
        if (isset($_GET['idReserva'])) {
            $idReserva = $_GET['idReserva'];
            $ok = $classReservaDAO->excluirReserva($idReserva);
            header('Location:../Visao/Reserva/Listar.php?MSG= ' . 
            ($ok ? 'Reserva excluida com sucesso!'
                 : 'Erro ao excluir reserva'));
            exit;
        }
        break;        

                
}
