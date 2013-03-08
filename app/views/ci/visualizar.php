<script>
	function visualizar(id,enviar)
	{
		$.get(root+'ci/modalvisualizar/'+id, function(data) {
			//alert();
			$("#modal-visualizacao > .modal-body").html(data.d.Conteudo);
			if(enviar == 1){
				$("#button-enviar").show();
				$("#button-enviar").attr("href", "javascript:void(0);");
				$("#button-enviar").attr("onclick", "modal("+id+", 'ci/enviar/','Tem certeza que deseja enviar esta CI?')");
			}else {
				$("#button-enviar").hide();
				$("#button-enviar").attr("href", "javascript:void(0);");
			}
				
			
			$('#modal-visualizacao').modal('show');	
		});
	
	}
</script>
<div class="grid_12">
	<div class="page-header" style="margin-top: 5px; margin-bottom: 10px;">
		<h1>Ci <a href="~/ci/rascunho"><small>Visualizar</small></a></h1>
	</div>
</div>
<div class="grid_12">
	<?= flash ?>
</div>
<div class="grid_6">
	<h3>Assunto: <small><?= $ci->Assunto ?></small></h3>
</div>
<div class="grid_6">
	<h3>Data: <small><?= date('d/m/Y H:m', $ci->Data) ?></small></h3>
</div>
<div class="grid_6">
	<h3>De: <small><?= $ci->NomeDe ?></small></h3>
</div>
<div class="grid_6">
	<h3>Para: <small><?= $ci->NomePara ?></small></h3>
</div>
<div class="grid_12">
	<?= $ci->Conteudo ?>
</div>
<?php if ($ci->IdUsuarioAutorizacao && $ci->IdUsuarioAutorizacao == Session::get('usuario')->Id): ?>
	<div class="grid_12">
		<h3>Autorizar?</h3>
		<div style="width: 250px; float: left;">
			<a href="javascript:void(0);" class="btn btn-success" onclick="modal(<?= $ci->Id ?>,'ci/autorizar_naoautorizar/1/','Tem certeza que deseja autorizar esta CI?')">Sim</a>
			<a href="javascript:void(0);" class="btn btn-success" onclick="modal(<?= $ci->Id ?>,'ci/autorizar_naoautorizar/2/','Tem certeza que deseja não aceitar esta CI?')">Não</a>
		</div>
	</div>
<?php endif; ?>
<div class="grid_12">
	<h3>Atenciosamente: <?= $ci->NomeAtenciosamente ?></h3>
</div>
<?php if ($ci->IdUsuarioVisualizou): ?>
	<div class="grid_12">
		<h3>Visualizado: <?= $ci->NomeUsuarioVisualizou ?>  Data: <?= date('d/m/Y H:m', $ci->DataVisualizou) ?> </h3>
	</div>
<?php endif; ?>
<?php if ($ci->IdUsuarioAutorizacao): ?>
	<div class="grid_12">
		<h3> <?= $ci->Autorizado == 1 ? 'Autorizado por:' : 'Não autorizado por:'; ?> <?= $ci->NomeUsuarioAutorizacao ?>  </h3>
	</div>
<?php endif; ?>
<a href="#modal-observacao" class="btn btn-primary" data-toggle="modal"><i class="icon-plus icon-white"></i> Observação</a>
<a href="~/ci/gerarpdf/<?= $ci->Id  ?>" class="btn btn-primary" data-toggle="modal"><i class="icon-print icon-white"></i></a>
<?php if ($observacoes != null): ?>
	<div class="grid_12">
		<div class="page-header" style="margin-top: 5px; margin-bottom: 10px;">
			<h2>Observações</h2>
		</div>
	</div>
<?php endif; ?>
<?php foreach ($observacoes as $obs): ?>
	<div class="grid_6">
		Enviada por: <?= $obs->Nome ?>
	</div>
	<div class="grid_6">
		Data: <?= date('d/m/Y H:m', $obs->Data) ?>
	</div>
	<div class="grid_12" style="border: 1px solid #EEEEEE;">
		<span style="margin: 5px;"><?= $obs->Conteudo ?></span>
	</div>
<?php endforeach; ?>

<div class="modal hide" id="modal-observacao" >
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">×</button>
		<h3 class="cliente-nome">OBSERVAÇÃO</h3>
	</div>
	<form method="POST" action="" style="margin: 0;padding: 0;">
	<div class="modal-body">
		<textarea rows="5" style="width: 510px;" name="Conteudo"></textarea>
	</div>
	<div class="modal-footer">
		<a href="javascript:void(0);" class="btn" data-dismiss="modal">Cancelar</a>
		<input type="submit" class="botao_login btn btn-primary" name="Salvar" value="Salvar" />
	</div>
	</form>
</div>
