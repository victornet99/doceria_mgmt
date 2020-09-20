<?php

    class Cliente {
        private $idcliente;
        private $nome;
        private $telefone;
        private $login;
        private $senha;
        private $status;
        private $email;
        private $fkendereco;

        public function getIdcliente()
        {
            return $this->idcliente;
        }

        public function setIdcliente($idcliente)
        {
            $this->idcliente = $idcliente;
        }

        public function getNome()
        {
            return $this->nome;
        }

        public function setNome($nome)
        {
            $this->nome = $nome;
        }

        public function getTelefone()
        {
            return $this->telefone;
        }

        public function setTelefone($telefone)
        {
            $this->telefone = $telefone;
        }

        public function getLogin()
        {
            return $this->login;
        }

        public function setLogin($login)
        {
            $this->login = $login;
        }

        public function getSenha()
        {
            return $this->senha;
        }

        public function setSenha($senha)
        {
            $this->senha = $senha;
        }

        public function getStatus()
        {
            return $this->status;
        }

        public function setStatus($status)
        {
            $this->status = $status;
        }

        public function getEmail()
        {
            return $this->email;
        }

        public function setEmail($email)
        {
            $this->email = $email;
        }

        public function getFkendereco()
        {
            return $this->fkendereco;
        }

        public function setFkendereco($fkendereco)
        {
            $this->fkendereco = $fkendereco;
        }

    }
