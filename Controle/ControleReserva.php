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
        // Verifica se o quarto está disponível no período
        $disponivel = $classReservaDAO->verificarDisponibilidade($idQuarto, $checkin, $checkout);
        if ($disponivel) {
            $reserva = $classReservaDAO->cadastrarReserva($novaReserva);
            if ($reserva >= 1) {
                $classQuartoDAO = new ClassQuartoDAO();
                $classQuartoDAO->atualizarStatusQuarto($idQuarto, 'ocupado');
               header('Location: ../Visao/Reserva/Listar.php?MSG=Reserva cadastrada com sucesso!');
            } else {
                header('Location:../index.php?&MSG=Não foi possível realizar o cadastro!');
            }
        } else {
            header('Location:../index.php?&MSG=Quarto indisponível no período selecionado!');
        }
        break;

    case "alterarReserva":
        $reserva = $classReservaDAO->alterarReserva($novaReserva);
        if ($reserva == 1) {
            header('Location:../index.php?&MSG=Reserva atualizada com sucesso!');
        } else {
            header('Location:../index.php?&MSG=Não foi possível atualizar a reserva!');
        }
        break;

    case "excluirReserva":
        if (isset($_GET['idex'])) {
            $idReserva = $_GET['idex'];
            $reserva = $classReservaDAO->buscarReservaPorId($idReserva);
            $idQuarto = $reserva['idQuarto']/

            $res = $classReservaDAO->excluirReserva($idReserva);
            if ($res == TRUE) {
                $classQuartoDAO = new ClassQuartoDAO();
                $classQuartoDAO->atualizarStatusQuarto($idQuarto, 'livre');
                header('Location:../index.php?PAGINA=listarReserva&MSG=Reserva excluída com sucesso!');
            } else {
                header('Location:../index.php?PAGINA=listarReserva&MSG=Não foi possível excluir a reserva!');
            }
        }
        break;

    default:
        header('Location:../index.php?&MSG=Ação inválida!');
        break;
}
