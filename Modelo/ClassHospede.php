<?php
class ClassHospede
{
    private $idHospede;
    private $nome;
    private $email;
    private $telefone;
    private $dataNascimento;

    function getIdHospede()
    {
        return $this->idHospede;
    }

    function getNome()
    {
        return $this->nome;
    }

    function getEmail()
    {
        return $this->email;
    }

    function getTelefone()
    {
        return $this->telefone;
    }

    function getDataNascimento()
    {
        return $this->dataNascimento;
    }


    function setIdUsuario($idHospede)
    {
        $this->idUsuario = $idHospede;
    }

    function setNome($nome)
    {
        $this->nome = $nome;
    }

    function setEmail($email)
    {
        $this->email = $email;
    }

    function setTelefone()
    {
        $this->telefone = $telefone;
    }

    function setDataNascimento()
    {
        $this->dataNascimento = $dataNascimento;
    }
}
