<?php
require_once 'Conexao.php';
require_once __DIR__ . '../ClassQuartoDAO.php';

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
            return $pdo->lastInsertId(); 
        } else {
            return false;
        }
    } catch (PDOException $e) {
        echo "Erro ao cadastrar reserva: " . $e->getMessage();
        return false;
    }
}

    public function alterarReserva(ClassReserva $alterarReserva)
    {
        try {
            $pdo = Conexao::getInstance();
            $sql = "UPDATE reserva SET checkin=?,
                    checkout=? WHERE idReserva=? ";
            $stmt = $pdo->prepare($sql);
            $checkin = str_replace("T", " ", $alterarReserva->getCheckin()) . ":00";
            $checkout = str_replace("T", " ", $alterarReserva->getCheckout()) . ":00";
        
            $stmt->bindValue(1, $checkin);
            $stmt->bindValue(2, $checkout);
            $stmt->bindValue(3, $alterarReserva->getIdReserva());

            $stmt->execute();  
            
            return $stmt->rowCount();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            return false;
        }
    }

    public function buscarReserva($idReserva) {
        try {
            $pdo = Conexao::getInstance();
            $sql = "SELECT * FROM reserva WHERE idReserva = :idReserva LIMIT 1";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':idReserva', $idReserva);
            $stmt->execute();

            $dadosR = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($dadosR) {
                $reserva = new ClassReserva();
                $reserva->setIdReserva($dadosR['idReserva']);
                $reserva->setCheckin($dadosR['checkin']);
                $reserva->setCheckout($dadosR['checkout']);
                return $reserva;
            }

            return null;
        
    } catch (PDOException $ex) {
        echo $ex->getMessage();
        return null;
    }
}

        public function listarReserva(){
        try {
            $pdo = Conexao::getInstance();
            $sql = "SELECT * FROM reserva order by (id_hospede) asc";
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
        ORDER BY r.checkin DESC;
        ";
    $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Erro ao listar reservas: " . $e->getMessage();
        return [];
    }
}

    public function buscarUltimaReserva() {
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
