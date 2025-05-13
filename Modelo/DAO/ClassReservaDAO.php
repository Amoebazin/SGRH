<?php
require_once 'Conexao.php';
require_once __DIR__ . '/../ClassReserva.php';

class ClassReservaDAO {

    public function cadastrar(ClassReserva $reserva) {
        try {
            $pdo = Conexao::getInstance();
            $sql = "INSERT INTO reserva (id_hospede, id_quarto, checkin, checkout, status) VALUES (?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $reserva->getIdHospede());
            $stmt->bindValue(2, $reserva->getIdQuarto());
            $stmt->bindValue(3, $reserva->getCheckin());
            $stmt->bindValue(4, $reserva->getCheckout());
            $stmt->bindValue(5, $reserva->getStatus());
            $stmt->execute();
            return true;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function buscar($id) {
        try {
            $pdo = Conexao::getInstance();
            $sql = "SELECT * FROM reserva WHERE id = :id LIMIT 1";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            return $ex->getMessage();
        }
    }

    public function listar() {
        try {
            $pdo = Conexao::getInstance();
            $sql = "SELECT * FROM reserva ORDER BY checkin DESC";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function excluir($id) {
        try {
            $pdo = Conexao::getInstance();
            $sql = "DELETE FROM reserva WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            return true;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
}
?>