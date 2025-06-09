<!DOCTYPE html>
<html>
    <head>
        
        <meta charset="UTF-8">
         <title></title>
         <link rel="stylesheet" href="..\css\alterarHospede.css">
    </head>
    <body>
        
            <h1>Atualização de Hóspedes</h1>
            <hr>
        </div>
		
        <?php
            require_once __DIR__ . '/../../Modelo/ClassHospede.php';
            require_once __DIR__ . '/../../Modelo/DAO/ClassHospedeDAO.php';
			$idHospede =@$_GET['idHospede'];
            $novoHospede = new ClassHospede();
            $hospedeDAO = new ClassHospedeDAO();
            $novoHospede = $hospedeDAO->buscarHospede($idHospede);

        ?>
        <form method="post" action="../../Controle/ControleHospede.php?ACAO=alterarHospede" >
                <input type="hidden" name="idHospede" value="<?php echo $novoHospede->getIdHospede(); ?>">
                Nome:<input type="text" name="nome" size="50" value="<?php echo $novoHospede->getNome(); ?>" /><br>
                Email:<input type="email" id="email" name="email" size="40" value="<?php echo $novoHospede->getEmail(); ?>"/>
                Telefone:<input type="telefone" id="telefone" name="telefone" size="40" value="<?php echo $novoHospede->getTelefone(); ?>"/>
                Data_Nascimento:<input type="date" id="data_nascimento" name="data_nascimento" size="40" value="<?php echo $novoHospede->getDataNascimento(); ?>"/>
                <br>
				<button type="submit" value="Alterar">Alterar</button> 
				<button 
                type="reset" value="Limpar">Limpar</button>
            </div>
        </form>
    </body>
</html>
