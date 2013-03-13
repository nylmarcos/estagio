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
		<h1>Ci <a href="~/ci/rascunho"><small>Visualizar</small></a>
		
		<a style="float: right;" href="javascript:history.back(1);" class="btn btn-primary tool_tip" rel="tooltip" title="Voltar"> <i class="icon-arrow-left icon-white"></i></a>
		</h1>
	</div>
</div>
<div class="grid_12">
	<?= flash ?>
</div>
<div class="grid_6">
	<h4>Assunto: <small><?= $ci->Assunto ?></small></h4>
</div>
<div class="grid_6">
	<h4>Data: <small><?= date('d/m/Y H:m', $ci->Data) ?></small></h4>
</div>
<div class="grid_6">
	<h4>De: <small><?= $ci->NomeDe ?></small></h4>
</div>
<div class="grid_6">
	<h4>Para: <small><?= $ci->NomePara ?></small></h4>
</div>
<div class="grid_12">
	<?= $ci->Conteudo ?>
	<br />
	<h5>Atenciosamente,</h5><br />
	<div style="text-align: center;"><?= $ci->NomeAtenciosamente ?></div>
	<div style="text-align: center;"><?= $ci->CargoUsuarioAtenciosamente ?></div>
</div>
<?php if ($ci->IdUsuarioAutorizacao == Session::get('usuario')->Id && $ci->Autorizado == 0): ?>
	<div class="grid_12">
		<h3>Autorizar?</h3>
		<div style="width: 250px; float: left;">
			<a href="javascript:void(0);" class="btn btn-success" onclick="modal(<?= $ci->Id ?>,'ci/autorizar_naoautorizar/1/','Tem certeza que deseja autorizar esta CI?')">Sim</a>
			<a href="javascript:void(0);" class="btn btn-success" onclick="modal(<?= $ci->Id ?>,'ci/autorizar_naoautorizar/2/','Tem certeza que deseja não aceitar esta CI?')">Não</a>
		</div>
	</div>
<?php endif; ?>
<?php if ($ci->IdUsuarioVisualizou): ?>
	<div class="grid_12">
		<h4>Visualizado: <small><?= $ci->NomeUsuarioVisualizou ?> </small> Data: <small><?= date('d/m/Y H:m', $ci->DataVisualizou) ?></small> </h4>
	</div>
<?php endif; ?>
<?php if ($ci->IdUsuarioAutorizacao != null && $ci->IdUsuarioAutorizacao != 0 && $ci->Autorizado != 0 ): ?>
	<div class="grid_12">
		<h4> <?= $ci->Autorizado == 1 ? 'Autorizado por:' : 'Não autorizado por:'; ?> <small><?= $ci->NomeUsuarioAutorizacao ?> </small> </h4>
	</div>
<?php endif; ?>
<div class="grid_12" style="margin-top: 5px;">
	<a href="#modal-observacao" class="btn btn-primary" data-toggle="modal"><i class="icon-plus icon-white"></i> Observação</a>
	<a href="~/ci/gerarpdf/<?= $ci->Id  ?>" class="btn btn-primary tool_tip" data-toggle="modal" rel="tooltip" title="Baixar CI"><i class=" icon-download-alt icon-white"></i></a>
</div>
<?php if ($observacoes != null): ?>
	<div class="grid_12">
		<div style="margin-top:10px;">
			<h3>Observações</h3><hr style="margin:0 0 20px 0;"/>
		</div>
	</div>
<?php endif; ?>
<div class="grid_12">
<?php foreach ($observacoes as $obs): ?>
<div class="popover" style="position:inherit; width:inherit; margin-bottom: 5px;">
            <div class="arrow"></div>
            <h3 class="popover-title"><?= $obs->Nome ?> - <?= date('d/m/Y H:m', $obs->Data) ?></h3>
            <div class="popover-content">
              <p><?= $obs->Conteudo ?></p>
            </div>
          </div>
<?php endforeach; ?>
</div>
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
