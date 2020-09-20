<?php

    class Pedido {

        private $idpedido;
        private $datahora;
        private $valor;
        private $nomepedido;
        private $status;
        private $fkcliente;
        private $fkfuncionario;

        public function getIdpedido()
        {
            return $this->idpedido;
        }

        public function setIdpedido($idpedido)
        {
            $this->idpedido = $idpedido;
        }

        public function getDatahora()
        {
            return $this->datahora;
        }

        public function setDatahora($datahora)
        {
            $this->datahora = $datahora;
        }

        public function getValor()
        {
            return $this->valor;
        }

        public function setValor($valor)
        {
            $this->valor = $valor;
        }

        public function getNomepedido()
        {
            return $this->nomepedido;
        }

        public function setNomepedido($nomepedido)
        {
            $this->nomepedido = $nomepedido;
        }

        public function getStatus()
        {
            return $this->status;
        }

        public function setStatus($status)
        {
            $this->status = $status;
        }

        public function getFkcliente()
        {
            return $this->fkcliente;
        }

        public function setFkcliente($fkcliente)
        {
            $this->fkcliente = $fkcliente;
        }

        public function getFkfuncionario()
        {
            return $this->fkfuncionario;
        }

        public function setFkfuncionario($fkfuncionario)
        {
            $this->fkfuncionario = $fkfuncionario;
        }

    }
