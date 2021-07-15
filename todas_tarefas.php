<?php
	$acao = 'recuperar';
	require 'tarefa_controller.php';
	/*echo '<pre>';
	print_r($tarefas);
	echo '</pre>';*/
	
?>


<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>App Lista Tarefas</title>

		<link rel="stylesheet" href="css/estilo.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

		<script>
			function editar(tarefa_id, tarefa_anterior){
				let form = document.createElement('form');
				form.action = "tarefa_controller.php?acao=atualizar";
				form.method = "POST";
				form.className = "row"

				let input = document.createElement('input');
				input.type = "text";
				input.name = "tarefa";
				input.className = "col-9 form-control";
				input.value = tarefa_anterior;

				//input hidden
				let inputId = document.createElement('input');
				inputId.type = "hidden";
				inputId.name = "id";
				inputId.value = tarefa_id;

				let button = document.createElement('button');
				button.type = "submit";
				button.className = "col-3 btn btn-info";
				button.innerHTML = "Atualizar";

				form.appendChild(input);
				form.appendChild(button);
				form.appendChild(inputId);

				let tarefa = document.getElementById(tarefa_id);

				tarefa.innerHTML = '';

				tarefa.insertBefore(form, tarefa[0]);
			}

			function remover(tarefa_id){
				location.href = 'todas_tarefas.php?acao=remover&id='+tarefa_id+'&pagina=todas_tarefas';
			}

			function concluir(tarefa_id){
				location.href = 'todas_tarefas.php?acao=concluir&id='+tarefa_id+'&pagina=todas_tarefas';
			}
		</script>
	</head>

	<body>
		<nav class="navbar navbar-light bg-light">
			<div class="container">
				<a class="navbar-brand" href="#">
					<img src="img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
					App Lista Tarefas
				</a>
			</div>
		</nav>

		<?php
			if(isset($_GET['inclusao']) && $_GET['inclusao'] == 1){
		?>

		<div class="bg-success pt-2 text-white d-flex justify-content-center">
			<h3>Tarefa inserida com sucesso!</h3>
		</div>
		
		<?php } ?>

		<div class="container app">
			<div class="row">
				<div class="col-sm-3 menu">
					<ul class="list-group">
						<li class="list-group-item"><a href="index.php">Tarefas pendentes</a></li>
						<li class="list-group-item"><a href="nova_tarefa.php">Nova tarefa</a></li>
						<li class="list-group-item active"><a href="#">Todas tarefas</a></li>
					</ul>
				</div>

				<div class="col-sm-9">
					<div class="container pagina">
						<div class="row">
							<div class="col">
								<h4>Todas tarefas</h4>
								<hr />

								<?php foreach($tarefas as $key => $tarefa){ ?>

									<div class="row mb-3 d-flex align-items-center tarefa">
										<div id="<?= $tarefa->id ?>" class="col-sm-9">
											<? 
												echo $tarefa->tarefa; 
												echo " ($tarefa->status)";
											?>
										</div>
										<div class="col-sm-3 mt-2 d-flex justify-content-between">						
											<i class="fas fa-trash-alt fa-lg text-danger" onclick="remover(<?= $tarefa->id ?>)"></i>
											<? if($tarefa->status == 'pendente'){ ?>
											<i class="fas fa-edit fa-lg text-info" onclick="editar(<?= $tarefa->id ?>, '<?= $tarefa->tarefa ?>')"></i>
											<i class="fas fa-check-square fa-lg text-success" onclick="concluir(<?= $tarefa->id ?>)"></i>
											<? } ?>
										</div>
									</div>

								<?php } ?>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</body>
</html>