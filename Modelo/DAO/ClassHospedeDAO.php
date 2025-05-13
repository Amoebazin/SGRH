<?php

require_once 'Conexao.php';
require_once __DIR__ . '/../ClassHospede.php';

class ClassHospedeDAO {

    public function cadastrarHospede(ClassHospede $hospede) {
        try {
            $pdo = Conexao::getInstance();
            $sql = "INSERT INTO hospede (nome, email, telefone) VALUES (?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $hospede->getNome());
            $stmt->bindValue(2, $hospede->getEmail());
            $stmt->bindValue(3, $hospede->getTelefone());
            $stmt->execute();
            return true;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function buscarHospede($idHospede) {
        try {
            $pdo = Conexao::getInstance();
            $sql = "SELECT * FROM hospede WHERE idHospede = :idHospede LIMIT 1";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':idHospede', $idHospede);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            return $ex->getMessage();
        }
    }

    public function listarHospede() {
        try {
            $pdo = Conexao::getInstance();
            $sql = "SELECT * FROM hospede ORDER BY nome";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function excluir($idHospede) {
        try {
            $pdo = Conexao::getInstance();
            $sql = "DELETE FROM hospede WHERE idHospede =:idHospede";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':idHospede', $idHospede);
            $stmt->execute();
            return true;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
}
?>