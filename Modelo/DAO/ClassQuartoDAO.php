<?php

require_once 'Conexao.php';
require_once __DIR__ . '/../ClassQuarto.php';
class ClassQuartoDAO {

    public function cadastrarQuarto(ClassQuarto $quarto) {
        try {
            $pdo = Conexao::getInstance();
            $sql = "INSERT INTO quarto (numero, tipo, preco, status) VALUES (?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $quarto->getNumero());
            $stmt->bindValue(2, $quarto->getTipo());
            $stmt->bindValue(3, $quarto->getPreco());
            $stmt->bindValue(4, $quarto->getStatus());
            $stmt->execute();
            return $pdo->lastInsertId();
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function buscarQuarto($idQuarto) {
        try {
            $pdo = Conexao::getInstance();
            $sql = "SELECT * FROM quarto WHERE idQuarto = :idQuarto LIMIT 1";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':idQuarto', $idQuarto);
            $stmt->execute();

            $dadosQ = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($dadosQ) {
                $quarto = new ClassQuarto();
                $quarto->setIdQuarto($dadosQ['idQuarto']);
                $quarto->setTipo($dadosQ['tipo']);
                $quarto->setNumero($dadosQ['numero']);
                $quarto->setPreco($dadosQ['preco']);
                return $quarto;
            }

            return null;
            
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            return null;
        }
    }

    public function listarQuarto() {
        try {
            $pdo = Conexao::getInstance();
            $sql = "SELECT * FROM quarto ORDER BY numero";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function alterarQuarto(ClassQuarto $alterarQuarto)
    {
        try {
            $pdo = Conexao::getInstance();
            $sql = "UPDATE quarto SET tipo=?,
                    numero=?, preco=? WHERE idQuarto=? ";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $alterarQuarto->getTipo());
            $stmt->bindValue(2, $alterarQuarto->getNumero());
            $stmt->bindValue(3, $alterarQuarto->getPreco());
            $stmt->bindValue(4, $alterarQuarto->getIdQuarto());
            $stmt->execute();
            return $stmt->rowCount();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function excluirQuarto($idQuarto) {
        try {
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare("DELETE FROM quarto WHERE idQuarto = ?");
            $stmt->bindValue(1, $idQuarto);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro ao excluir reserva: " . $e->getMessage();
            return false;
        }
    }

    public function buscarUltimoQuarto() {
    try {
        $pdo = Conexao::getInstance();
        $sql = "SELECT * FROM quarto ORDER BY idQuarto DESC LIMIT 1";
        $stmt = $pdo->query($sql);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Erro ao buscar último quarto: " . $e->getMessage();
        return null;
    }
    }

    public function listarTodosQuartos() {
        try {
            $pdo = Conexao::getInstance();
            $sql = "SELECT idQuarto, numero,
                    status, preco, tipo
                    FROM quarto";

            $stmt = $pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erro ao listar quartos: " . $e->getMessage();
            return [];
        }
    }

}
?>