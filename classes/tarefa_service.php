<?php
    //CRUD
    class tarefaService{
        private $conexao;
        private $tarefa;

        public function __construct(Conexao $conexao,Tarefa $tarefa){
            $this->conexao = $conexao->conectar();//->conectar();
            $this->tarefa = $tarefa;
        }

        public function create(){
            $query = 'insert into tb_tarefas (tarefa) values(:tarefa)';
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':tarefa', $this->tarefa->__get('tarefa'));//porquw o _get?
            $stmt->execute();

        }

        public function read(){
            $query = 'select 
                        t.id, s.status, tarefa
                      from 
                        tb_tarefas as t
                        left join tb_status as s on (t.id_status = s.id)'; //retorna de tb_status apenas os que satisfazrem a igualdade
            $stmt = $this->conexao->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        public function update(){
            $query = 'update tb_tarefas set tarefa = ? where id = ?';
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(1, $this->tarefa->__get('tarefa'));
            $stmt->bindValue(2, $this->tarefa->__get('id'));
            return $stmt->execute();  //1 sucesso ou N para quantos N registros foram atualizados

        }

        public function delete(){
            $query = 'delete from tb_tarefas where id = ?';
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(1, $this->tarefa->__get('id'));
            return $stmt->execute(); 
        } 

        public function concluirTarefa(){
            $query = 'update tb_tarefas set id_status = ? where id = ?';
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(1, $this->tarefa->__get('id_status'));
            $stmt->bindValue(2, $this->tarefa->__get('id'));
            return $stmt->execute();  
        }
    }
?>