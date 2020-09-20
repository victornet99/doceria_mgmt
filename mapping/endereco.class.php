<?php

    class Endereco {
        private $idendereco;
        private $rua;
        private $cep;
        private $numero;
        private $bairro;
        private $complemento;

        public function getIdendereco()
        {
            return $this->idendereco;
        }

        public function setIdendereco($idendereco)
        {
            $this->idendereco = $idendereco;
        }

        public function getRua()
        {
            return $this->rua;
        }

        public function setRua($rua)
        {
            $this->rua = $rua;
        }

        public function getCep()
        {
            return $this->cep;
        }

        public function setCep($cep)
        {
            $this->cep = $cep;
        }

        public function getNumero()
        {
            return $this->numero;
        }

        public function setNumero($numero)
        {
            $this->numero = $numero;
        }

        public function getBairro()
        {
            return $this->bairro;
        }

        public function setBairro($bairro)
        {
            $this->bairro = $bairro;
        }

        public function getComplemento()
        {
            return $this->complemento;
        }

        public function setComplemento($complemento)
        {
            $this->complemento = $complemento;
        }

    }
