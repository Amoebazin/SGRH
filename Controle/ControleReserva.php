<?php
require_once '../Modelo/ClassReserva.php';
require_once '../Modelo/DAO/ClassReservaDAO.php';
require_once '../Modelo/ClassHospede.php';
require_once '../Modelo/DAO/ClassHospedeDAO.php';

$acao = $_GET['ACAO'];

switch ($acao) {
    case 'cadastrarReserva':
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        $dataNascimento = $_POST['data_nascimento'];
        $quartoId = $_POST['quartoId'];
        $checkin = $_POST['checkin'];
        $checkout = $_POST['checkout'];

        $hospede = new ClassHospede();
        $hospede->setNome($nome);
        $hospede->setEmail($email);
        $hospede->setTelefone($telefone);
        $hospede->setDataNascimento($dataNascimento);

        $hospede = new ClassHospedeDAO();
        $idHospede =$hospedeDAO->cadastrar($hospede);

        $reservaDAO = new ClassReservaDAO();
        $disponivel = $reservaDAO->verificarDisponibilidade($quartoId, $checkin, $checkout);

        if (!$disponivel){
            header('Location:..index.php?MSG=Reserva realizada com sucesso!');
            break;
        }

        $reservaDAO->reservar($idHospede, $quartoId, $checkin, $checkout);
        header('Location:../index.php?MSG=Reserva realizada com sucesso!');

        default:
        break;
    }





