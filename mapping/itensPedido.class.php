<?php

    class itensPedido {
        private $iditenspedido;
        private $quantidade;
        private $fkpedido;
        private $fkproduto;

        public function getIditenspedido()
        {
            return $this->iditenspedido;
        }

        public function setIditenspedido($iditenspedido)
        {
            $this->iditenspedido = $iditenspedido;
        }

        public function getQuantidade()
        {
            return $this->quantidade;
        }

        public function setQuantidade($quantidade)
        {
            $this->quantidade = $quantidade;
        }

        public function getFkpedido()
        {
            return $this->fkpedido;
        }

        public function setFkpedido($fkpedido)
        {
            $this->fkpedido = $fkpedido;
        }

        public function getFkproduto()
        {
            return $this->fkproduto;
        }

        public function setFkproduto($fkproduto)
        {
            $this->fkproduto = $fkproduto;
        }

    }
