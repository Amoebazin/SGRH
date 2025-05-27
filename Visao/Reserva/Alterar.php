<!DOCTYPE html>
<html>
    <head>
        
        <meta charset="UTF-8">
         <title></title>
    </head>
    <body>
        
            <h1>Atualização das Reservas</h1>
            <hr>
        </div>
		
        <?php
            require_once __DIR__ . '/../../Modelo/ClassReserva.php';
            require_once __DIR__ . '/../../Modelo/DAO/ClassReservaDAO.php';
            function formatarParaInput($data) {

                return date('Y-m-d\TH:i', strtotime($data));
            }

			$idReserva =@$_GET['idReserva'];
            $novoReserva = new ClassReserva();
            $reservaDAO = new ClassReservaDAO();
            $novoReserva = $reservaDAO->buscarReserva($idReserva);


        ?>
        <form method="post" action="../../Controle/ControleReserva.php?ACAO=alterarReserva" >
                <input type="hidden" name="idReserva" value="<?php echo $novoReserva->getIdReserva(); ?>">
                Checkin:<input type="datetime-local" name="checkin" size="40" value="<?= formatarParaInput($novoReserva->getCheckin()); ?>"/><br>
                Checkout:<input type="datetime-local"name="checkout" size="40" value="<?= formatarParaInput($novoReserva->getCheckout()); ?>"/>
                <br>
				<button type="submit" value="Alterar">Alterar</button> 
				<button 
                type="reset" value="Limpar">Limpar</button>
            </div>
        </form>
    </body>
</html>
