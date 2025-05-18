<?php

require_once '../Modelo/ClassReserva.php';
require_once '../Modelo/DAO/ClassReservaDAO.php';
require_once '../Modelo/ClassHospede.php';
require_once '../Modelo/DAO/ClassHospedeDAO.php';

$acao = $_GET['ACAO'];


switch ($acao) {
    case 'cadastrarReserva':
        //Captura dados do formulário
        $idQuarto = $_POST['idQuarto'];
        $idHospede = $_POST['idHospede'];
        $checkin = $_POST['checkin'];
        $checkout = $_POST['checkout'];
       
        if ($idHospede >= 1) {
            //Verifica a disponibilidade do quarto
            $reservaDAO = new ClassReservaDAO();
            $disponivel = $reservaDAO->verificarDisponibilidade($idQuarto, $checkin, $checkout);

            if (!$disponivel) {
                header('Location:../index.php?MSG=Quarto indisponível para o período solicitado!');
                exit;
            }

            //Cria o objeto reserva
            $reserva = new ClassReserva();
            $reserva->setHospede($idHospede);
            $reserva->setQuarto($idQuarto);
            $reserva->setDataEntrada($checkin);
            $reserva->setDataSaida($checkout);

            //Chama o DAO para cadastrar a reserva
            $reserva = $reservaDAO->cadastrarReserva($reserva);
            if ($reserva >= 1) {
                header('Location:../Visao/Hospede/Cadastrar.php?idReserva=' . $reserva);
            } else {
                header('Location:../index.php?&MSG=Não foi possível realizar a reserva!');
            }
        } else {
            header('Location:../index.php?&MSG=Erro ao cadastrar hóspede!');
        }
        break;

    case 'alterarReserva':
        // Captura os dados da reserva a ser alterada
        $idReserva = $_POST['idReserva'];
        $idQuarto  = $_POST['quarto'];
        $checkin   = $_POST['checkin'];
        $checkout  = $_POST['checkout'];

        // Verifica a disponibilidade do quarto
        $reservaDAO = new ClassReservaDAO();
        $disponivel = $reservaDAO->verificarDisponibilidade($idQuarto, $checkin, $checkout);

        if (!$disponivel) {
            header('Location:../index.php?&MSG=Quarto indisponível para o período solicitado!');
            exit;
        }

        // Atualiza a reserva
        $reserva = new ClassReserva();
        $reserva->setIdReserva($idReserva);
        $reserva->setQuarto($idQuarto);
        $reserva->setDataEntrada($checkin);
        $reserva->setDataSaida($checkout);

        $reservaAtualizada = $reservaDAO->alterarReserva($reserva);

        if ($reservaAtualizada == 1) {
            header('Location:../index.php?&MSG=Reserva atualizada com sucesso!');
        } else {
            header('Location:../index.php?&MSG=Não foi possível realizar a atualização da reserva!');
        }
        break;

    case 'excluirReserva':
        if (isset($_GET['idReserva'])) {
            $idReserva = $_GET['idReserva'];
            $reservaDAO = new ClassReservaDAO();
            $reservaExcluida = $reservaDAO->excluirReserva($idReserva);

            if ($reservaExcluida == TRUE) {
                header('Location:../index.php?PAGINA=listarReserva&MSG=Reserva excluída com sucesso!');
            } else {
                header('Location:../index.php?PAGINA=listarReserva&MSG=Não foi possível excluir a reserva!');
            }
        }
        break;

    default:
        // Acao não reconhecida
        header('Location:../index.php?&MSG=Ação inválida!');
        break;
}
