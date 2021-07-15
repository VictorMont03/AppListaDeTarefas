<?php
    class Tarefa{
        private $id;
        private $id_status;
        private $tarefa;
        private $data_cadastro;

        public function __set($attr, $value){
            $this->$attr = $value;
            return $this;
        }

        public function __get($attr){
            return $this->$attr;
        }
    }
?>