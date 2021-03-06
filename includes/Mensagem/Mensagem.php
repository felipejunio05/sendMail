<?php

    class Mensagem {
        private $cPara;
        private $cAssunto;
        private $cMensagem;
        private $aStatus;

        function __construct($cPara, $cAssunto, $cMensagem) {
            $this->cPara = $cPara;
            $this->cAssunto = $cAssunto;
            $this->cMensagem = $cMensagem;
        }

        public function getPara() {
            return $this->cPara;
        }

        public function getAssunto() {
            return $this->cAssunto;
        }

        public function getMsg() {
            return $this->cMensagem;
        }

        public function setStatus($id, $msg) {
            $this->aStatus = ['id' => $id, 'msg' => $msg];
        }

        public function getStatus() {
            return $this->aStatus;
        }

        public function msgValida() {
            $bTudoOk = true;

            if ( empty($this->cPara) || empty($this->cAssunto) || empty($this->cMensagem) ) {
                $bTudoOk = false;
            }

            return $bTudoOk;
        }
    }
?>
