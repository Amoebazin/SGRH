<?php

require_once '../Modelo/ClassQuarto.php';
require_once '../Modelo/DAO/ClassQuartoDAO.php';

$acao = $_GET['ACAO'];

$idQuarto =@$_POST['idQuarto'];
$numero =@$_POST['numero'];
$tipo =@$_POST['tipo'];
$preco =@$_POST['preco'];
$status =@$_POST['status'];

$novoQuarto = new ClassQuarto();
$novoQuarto->setIdQuarto($idQuarto);
$novoQuarto->setNumero($numero);
$novoQuarto->setTipo($tipo);
$novoQuarto->setPreco($preco);
$novoQuarto->setStatus($status);

$classQuartoDAO= new ClassQuartoDAO();
switch ($acao) {
    case "cadastrarQuarto":
        $quarto = $classQuartoDAO->cadastrarQuarto($novoQuarto);
        if($quarto >= 1){
           header("Location:../Visao/Reserva/Cadastrar.php?&MSG= Cadastro realizado com sucesso");
        } else {
            header('Location:../index.php?&MSG= Não foi possivel realizar o cadastro do quarto!');
        }

        break;

    case "alterarQuarto":
        $quarto = $classQuartoDAO->alterarQuarto($novoQuarto);
        if($quarto == 1){
            header('Location:../Visao/Reserva/Listar.php?&MSG= Alteração realizada com sucesso!');
        } else {
            header('Location:../index.php?$MSG= Não foi possivel realizar a alteração!');
        }
        break;    
        
        case "excluirQuarto":
            if (isset($_GET['idQuarto'])) {
                $idQuarto = $_GET['idQuarto'];
                //var_dump($idQuarto);
                $excluirQ = $classQuartoDAO->excluirQuarto($idQuarto);
                //var_dump($excluirQ); // DEBUG
                //exit;
                header('Location:../Visao/Quarto/Listar.php?MSG= ' . 
                ($excluirQ ? 'Quarto excluida com sucesso!'
                     : 'Erro ao excluir Quarto'));
                exit;
            }
            break; 
    default:
        break;

    }

?>