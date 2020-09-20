<?php

    class Produto {
        private $idproduto;
        private $descricao;
        private $valor;
        private $observacoes;
        private $prodativo;

        public function getIdproduto()
        {
            return $this->idproduto;
        }

        public function setIdproduto($idproduto)
        {
            $this->idproduto = $idproduto;
        }

        public function getDescricao()
        {
            return $this->descricao;
        }

        public function setDescricao($descricao)
        {
            $this->descricao = $descricao;
        }

        public function getValor()
        {
            return $this->valor;
        }

        public function setValor($valor)
        {
            $this->valor = $valor;
        }

        public function getObservacoes()
        {
            return $this->observacoes;
        }

        public function setObservacoes($observacoes)
        {
            $this->observacoes = $observacoes;
        }

        public function getProdativo()
        {
            return $this->prodativo;
        }

        public function setProdativo($prodativo)
        {
            $this->prodativo = $prodativo;
        }



    }
