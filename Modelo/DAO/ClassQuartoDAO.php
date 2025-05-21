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

    public function buscarQuarto($id) {
        try {
            $pdo = Conexao::getInstance();
            $sql = "SELECT * FROM quarto WHERE idQuarto = :idQuarto LIMIT 1";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            return $ex->getMessage();
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

    public function excluirQuarto($idQuarto) {
        try {
            $pdo = Conexao::getInstance();
            $sql = "DELETE FROM quarto WHERE idQuarto = :idQuarto";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':idQuarto', $idQuarto);
            $stmt->execute();
            return true;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
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

    public function atualizarStatusQuarto($idQuarto, $novoStatus) {
    try {
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare("UPDATE quarto SET status = ? WHERE idQuarto = ?");
        $stmt->bindValue(1, $novoStatus);
        $stmt->bindValue(2, $idQuarto);
        return $stmt->execute();
    } catch (PDOException $e) {
        echo "Erro ao atualizar status do quarto: " . $e->getMessage();
        return false;
    }
    }

    public function listarTodosQuartos() {
        try {
            $pdo = Conexao::getInstance();
            $sql = "SELECT idQuarto, numero, status, preco FROM quarto";
            $stmt = $pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erro ao listar quartos: " . $e->getMessage();
            return [];
        }
    }

}
?>