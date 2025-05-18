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


    function setIdHospede($idHospede)
    {
        $this->idHospede = $idHospede;
    }

    function setNome($nome)
    {
        $this->nome = $nome;
    }

    function setEmail($email)
    {
        $this->email = $email;
    }

    function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }

    function setDataNascimento($dataNascimento)
    {
        $this->dataNascimento = $dataNascimento;
    }
}
