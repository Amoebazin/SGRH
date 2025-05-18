<?php
class ClassQuarto
{
    private $idQuarto;
    private $numero;
    private $tipo;
    private $preco;
    private $status;

        public function getIdQuarto() {
        return $this->idQuarto;
    }

    public function setIdQuarto($idQuarto) {
        $this->idQuarto = $idQuarto;
    }

    public function getNumero() {
        return $this->numero;
    }

    public function setNumero($numero) {
        $this->numero = $numero;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    public function getPreco() {
        return $this->preco;
    }

    public function setPreco($preco) {
        $this->preco = $preco;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }
}





