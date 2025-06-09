<?php

require_once 'Conexao.php';
require_once __DIR__ . '/../ClassHospede.php';

class ClassHospedeDAO {

    public function cadastrarHospede(ClassHospede $hospede) {
        try {
            $pdo = Conexao::getInstance();
            $sql = "INSERT INTO hospede (nome, email, telefone, data_nascimento) VALUES (?, ?, ?,?)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $hospede->getNome());
            $stmt->bindValue(2, $hospede->getEmail());
            $stmt->bindValue(3, $hospede->getTelefone());
            $stmt->bindValue(4, $hospede->getDataNascimento());
            $stmt->execute();

            $idHospede = $pdo->lastInsertId();
            return $idHospede;

         } catch (PDOException $exc) {
        echo "Erro: " . $exc->getMessage();
        exit;

        }
    }

    public function buscarHospede($idHospede) {
        try {
            $pdo = Conexao::getInstance();
            $sql = "SELECT * FROM hospede WHERE idHospede = :idHospede LIMIT 1";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':idHospede', $idHospede);
            $stmt->execute();

            $dadosH = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($dadosH) {
                $hospede = new ClassHospede();
                $hospede->setIdHospede($dadosH['idHospede']);
                $hospede->setNome($dadosH['nome']);
                $hospede->setEmail($dadosH['email']);
                $hospede->setTelefone($dadosH['telefone']);
                $hospede->setDataNascimento($dadosH['data_nascimento']);
                return $hospede;
            }

            return null;
            
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            return null;
        }
    }

    public function listarTodosHospedes() {
        try {
            $pdo = Conexao::getInstance();
            $sql = "SELECT idHospede, nome,
                    email, telefone, data_nascimento
                    FROM hospede";
            $stmt = $pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erro ao listar quartos: " . $e->getMessage();
            return [];
        }
    }

    public function alterarHospede(ClassHospede $alterarHospede)
    {
        try {
            $pdo = Conexao::getInstance();
            $sql = "UPDATE hospede SET nome=?,
                    email=?, telefone=?, data_nascimento=?
                    WHERE idHospede=? ";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $alterarHospede->getNome());
            $stmt->bindValue(2, $alterarHospede->getEmail());
            $stmt->bindValue(3, $alterarHospede->getTelefone());
            $stmt->bindValue(4, $alterarHospede->getDataNascimento());
            $stmt->bindValue(5, $alterarHospede->getIdHospede());
            $stmt->execute();
            return $stmt->rowCount();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function excluirHospede($idHospede) {
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
}
?>