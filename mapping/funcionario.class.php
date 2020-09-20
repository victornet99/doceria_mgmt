<?php

    class Funcionario {
        private $idfuncionario;
        private $nome;
        private $cpf;
        private $rg;
        private $ctps;
        private $status;
        private $dataadmissao;
        private $datademissao;
        private $nrtelefone;
        private $login;
        private $senha;
        private $fktipofuncionario;

        public function getIdfuncionario()
        {
            return $this->idfuncionario;
        }

        public function setIdfuncionario($idfuncionario)
        {
            $this->idfuncionario = $idfuncionario;
        }

        public function getNome()
        {
            return $this->nome;
        }

        public function setNome($nome)
        {
            $this->nome = $nome;
        }

        public function getCpf()
        {
            return $this->cpf;
        }

        public function setCpf($cpf)
        {
            $this->cpf = $cpf;
        }

        public function getRg()
        {
            return $this->rg;
        }

        public function setRg($rg)
        {
            $this->rg = $rg;
        }

        public function getCtps()
        {
            return $this->ctps;
        }

        public function setCtps($ctps)
        {
            $this->ctps = $ctps;
        }

        public function getStatus()
        {
            return $this->status;
        }

        public function setStatus($status)
        {
            $this->status = $status;
        }

        public function getDataadmissao()
        {
            return $this->dataadmissao;
        }

        public function setDataadmissao($dataadmissao)
        {
            $this->dataadmissao = $dataadmissao;
        }

        public function getDatademissao()
        {
            return $this->datademissao;
        }

        public function setDatademissao($datademissao)
        {
            $this->datademissao = $datademissao;
        }

        public function getNrtelefone()
        {
            return $this->nrtelefone;
        }

        public function setNrtelefone($nrtelefone)
        {
            $this->nrtelefone = $nrtelefone;
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

        public function getFktipofuncionario()
        {
            return $this->fktipofuncionario;
        }

        public function setFktipofuncionario($fktipofuncionario)
        {
            $this->fktipofuncionario = $fktipofuncionario;
        }

    }
