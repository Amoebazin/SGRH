<?php
require_once 'Conexao.php';

class ClassReservaDAO {

    public function cadastrar(ClassReserva $reserva) {
        try {
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare("INSERT INTO reserva (idHospede, idQuarto, checkin, checkout) VALUES (?, ?, ?, ?)");
            $stmt->bindValue(1, $reserva->getIdHospede()->getIdHospede());
            $stmt->bindValue(2, $reserva->getQuarto());
            $stmt->bindValue(3, $reserva->getCheckin());
            $stmt->bindValue(4, $reserva->getCheckout());
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro ao cadastrar reserva: " . $e->getMessage();
            return false;
        }
    }

    public function verificarDisponibilidade($idQuarto, $checkin, $checkout) {
        try {
            $pdo = Conexao::getInstance();
            $sql = "SELECT COUNT(*) FROM reserva 
                    WHERE idQuarto = ? 
                    AND (checkin < ? AND checkout > ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $idQuarto);
            $stmt->bindValue(2, $checkout);    
            $stmt->bindValue(3, $checkout);  
            $stmt->execute();
            $quantidade = $stmt->fetchColumn();
            return $quantidade == 0;
        } catch (PDOException $e) {
            echo "Erro ao verificar disponibilidade: " . $e->getMessage();
            return false;
        }
    }

    public function alterarReserva(ClassReserva $reserva) {
        try {
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare("UPDATE reserva SET idQuarto = ?, checkin = ?, checkout = ? WHERE idReserva = ?");
            $stmt->bindValue(1, $reserva->getQuarto());
            $stmt->bindValue(2, $reserva->getCheckin());
            $stmt->bindValue(3, $reserva->getCheckout());
            $stmt->bindValue(4, $reserva->getIdReserva());
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro ao alterar reserva: " . $e->getMessage();
            return false;
        }
    }

    public function excluirReserva($idReserva) {
        try {
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare("DELETE FROM reserva WHERE idReserva = ?");
            $stmt->bindValue(1, $idReserva);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro ao excluir reserva: " . $e->getMessage();
            return false;
        }
    }
}
