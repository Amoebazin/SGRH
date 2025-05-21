<?php
require_once 'Conexao.php';
require_once __DIR__ . '/ClassQuartoDAO.php';

class ClassReservaDAO {

   public function cadastrarReserva(ClassReserva $reserva) {
    try {
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare("INSERT INTO reserva (id_hospede, id_quarto, checkin, checkout) VALUES (?, ?, ?, ?)");
        $stmt->bindValue(1, $reserva->getIdHospede());
        $stmt->bindValue(2, $reserva->getIdQuarto());
        $stmt->bindValue(3, $reserva->getCheckin());
        $stmt->bindValue(4, $reserva->getCheckout());

        if ($stmt->execute()) {
            return $pdo->lastInsertId(); // RETORNA o ID da reserva
        } else {
            return false;
        }
    } catch (PDOException $e) {
        echo "Erro ao cadastrar reserva: " . $e->getMessage();
        return false;
    }
}

    public function buscarReserva($idReserva)
{
    try {
        $reserva = new ClassReserva(); 
        $pdo = Conexao::getInstance();
        $sql = "SELECT * FROM reserva WHERE idReserva = :id LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $idReserva);

        $stmt->execute();
        $reservaAssoc = $stmt->fetch(PDO::FETCH_ASSOC);

        $reserva->setIdReserva($reservaAssoc['idReserva']);
        $reserva->setIdHospede($reservaAssoc['idHospede']);
        $reserva->setIdQuarto($reservaAssoc['idQuarto']);
        $reserva->setCheckin($reservaAssoc['checkin']);
        $reserva->setCheckout($reservaAssoc['checkout']);

            return $reserva;
        } 
     catch (PDOException $ex) {
        return $ex->getMessage(); 
    }
}

        public function verificarDisponibilidade($idQuarto, $checkin, $checkout) {
            try {
                $pdo = Conexao::getInstance();
                $sql = "SELECT COUNT(*) FROM reserva r
                    JOIN quarto q ON r.id_quarto = q.idQuarto
                    WHERE r.id_quarto = ? 
                    AND q.status = 'livre'
                    AND (
                    (r.checkin <= ? AND r.checkout >= ?) OR
                    (r.checkin BETWEEN ? AND ?) OR
                    (r.checkout BETWEEN ? AND ?)
                )";
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(1, $idQuarto);
                $stmt->bindValue(2, $checkout);
                $stmt->bindValue(3, $checkin);
                $stmt->bindValue(4, $checkin);
                $stmt->bindValue(5, $checkout);
                $stmt->bindValue(6, $checkin);
                $stmt->bindValue(7, $checkout);
                $stmt->execute();
                $quantidade = $stmt->fetchColumn();
                return $quantidade == 0;
            } catch (PDOException $e) {
                echo "Erro ao verificar disponibilidade: " . $e->getMessage();
                return false;
            }
        }

        public function calcularValorReserva($idQuarto, $checkin, $checkout) {
    try {
        $pdo = Conexao::getInstance();
        $sql = "SELECT preco FROM quarto WHERE idQuarto = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, $idQuarto);
        $stmt->execute();
        $precoDiaria = $stmt->fetchColumn();

        $dataCheckin = new DateTime($checkin);
        $dataCheckout = new DateTime($checkout);
        $intervalo = $dataCheckin->diff($dataCheckout);
        $totalDias = $intervalo->days;

        return $totalDias * $precoDiaria;
    } catch (PDOException $e) {
        echo "Erro ao calcular valor da reserva: " . $e->getMessage();
        return false;
    }
}

        public function listarReserva(){
        try {
            $pdo = Conexao::getInstance();
            $sql = "SELECT * FROM reserva order by (idHospede) asc";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $reservas = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $reservas;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function listarTodasComDetalhes() {
         try {
        $pdo = Conexao::getInstance();
        $sql = "
      SELECT r.idReserva, r.checkin, r.checkout, 
       h.nome AS hospede_nome, h.email AS hospede_email, 
       q.numero AS quarto_numero, q.tipo AS quarto_tipo, q.preco
FROM reserva r
JOIN hospede h ON r.id_hospede = h.idHospede
JOIN quarto q ON r.id_quarto = q.idQuarto
ORDER BY r.checkin DESC;mud
        ";
    $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Erro ao listar reservas com detalhes: " . $e->getMessage();
        return [];
    }
}

    public function buscarUltimoHospede() {
        try {
            $pdo = Conexao::getInstance();
            $sql = "SELECT * FROM hospede ORDER BY idHospede DESC LIMIT 1";
            $stmt = $pdo->query($sql);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erro ao buscar último hóspede: " . $e->getMessage();
            return null;
        }
    }

    public function alterarReserva(ClassReserva $reserva) {
        try {
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare("UPDATE reserva SET idQuarto = ?, checkin = ?, checkout = ? WHERE idReserva = ?");
            $stmt->bindValue(1, $reserva->getIdQuarto());
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
