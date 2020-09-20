<?php

    class pagamento {

        private $idpagamento;
        private $formapagamento;
        private $numautcartao;
        private $valorpago;
        private $fkpedido;

        public function getIdpagamento()
        {
            return $this->idpagamento;
        }

        public function setIdpagamento($idpagamento)
        {
            $this->idpagamento = $idpagamento;
        }

        public function getFormapagamento()
        {
            return $this->formapagamento;
        }

        public function setFormapagamento($formapagamento)
        {
            $this->formapagamento = $formapagamento;
        }

        public function getNumautcartao()
        {
            return $this->numautcartao;
        }

        public function setNumautcartao($numautcartao)
        {
            $this->numautcartao = $numautcartao;
        }

        public function getValorpago()
        {
            return $this->valorpago;
        }

        public function setValorpago($valorpago)
        {
            $this->valorpago = $valorpago;
        }

        public function getFkpedido()
        {
            return $this->fkpedido;
        }

        public function setFkpedido($fkpedido)
        {
            $this->fkpedido = $fkpedido;
        }

    }

