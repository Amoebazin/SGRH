<!DOCTYPE html>
<html>
    <head>
        
        <meta charset="UTF-8">
         <title></title>
         <link rel="stylesheet" href="..\css\alterarQuarto.css">
    </head>
    <body>
        
            <h1>Atualização dos Quartos</h1>

        </div>
		
        <?php
            require_once __DIR__ . '/../../Modelo/ClassQuarto.php';
            require_once __DIR__ . '/../../Modelo/DAO/ClassQuartoDAO.php';
			$idQuarto =@$_GET['idQuarto'];
            $novoQuarto = new ClassQuarto();
            $quartoDAO = new ClassQuartoDAO();
            $novoQuarto = $quartoDAO->buscarQuarto($idQuarto);

        ?>
        <form method="post" action="../../Controle/ControleQuarto.php?ACAO=alterarQuarto" >
                <input type="hidden" name="idQuarto" value="<?php echo $novoQuarto->getIdQuarto(); ?>">
                Tipo:<input name="tipo" id="tipo" size="40" value="<?php echo $novoQuarto->getTipo(); ?>" /><br>
                Número:<input type="text" id="numero" name="numero" size="40" value="<?php echo $novoQuarto->getNumero(); ?>"/>
                Preço:<input type="preco" id="preco" name="preco" size="40" value="<?php echo $novoQuarto->getPreco(); ?>"/>
                <br>
				<button type="submit" value="Alterar">Alterar</button> 
				<button 
                type="reset" value="Limpar">Resetar</button>
            </div>
        </form>
    </body>
</html>
