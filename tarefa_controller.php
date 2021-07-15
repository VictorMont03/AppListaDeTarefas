<?php
    //echo $_POST['tarefa'];
    require './classes/tarefa.model.php';
    require './classes/conexao.php';
    require './classes/tarefa_service.php';

    $acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

    //echo $acao;

    if($acao == 'inserir'){
        
        $tarefa = new Tarefa();
        $tarefa->__set('tarefa', $_POST['tarefa']);

        print_r($tarefa);
        echo $tarefa->__get('tarefa');

        $conexao = new Conexao();

        $tarefaService = new TarefaService($conexao, $tarefa);

        $tarefaService->create();

        header("Location: todas_tarefas.php?inclusao=1");

    } else if($acao == 'recuperar'){
        $tarefa = new Tarefa();
        $conexao = new Conexao();

        $tarefaService = new TarefaService($conexao, $tarefa);

        $tarefas = $tarefaService->read();
    } else if($acao == 'atualizar'){
        $tarefa = new Tarefa();
        $tarefa->__set("id", $_POST['id'])->__set("tarefa", $_POST['tarefa']);
            
        $conexao = new Conexao();
        //print_r($tarefa);

        $tarefaService = new TarefaService($conexao, $tarefa);

        $rota2 = $_GET['pagina'];

        if($tarefaService->update()){
            header('Location: '. $rota2 .'.php');
        }   
    } else if ($acao == 'remover'){
        $tarefa = new Tarefa();
        $tarefa->__set("id", $_GET['id']);
        $conexao = new Conexao();

        $tarefaService = new TarefaService($conexao, $tarefa);
        
        $rota2 = $_GET['pagina'];

        if($tarefaService->delete()){
            header('Location: '. $rota2 .'.php');
        } 
    } else if ($acao == 'concluir'){
        $tarefa = new Tarefa();
        $tarefa->__set("id", $_GET['id'])->__set("id_status", 2);

        $conexao = new Conexao();

        $tarefaService = new TarefaService($conexao, $tarefa);

        $rota2 = $_GET['pagina'];
       // echo $rota2;

        if($tarefaService->concluirTarefa()){
            header('Location: '. $rota2 .'.php');
        }

    }

?>