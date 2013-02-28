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
		<h1>Cis <a href="~/ci/rascunho"><small>Rascunho</small></a></h1>
	</div>
</div>
<div class="grid_12">
	<?= flash ?>
</div>
<div class="grid_12">

    <form method="get" class="form-search" style="margin-bottom: 5px; float: right;">
			Listar De:
			<div class="input-append date">
				<input id="dpd1" class="span2 search-query" type="text" value="<?= $i; ?>" name="i" data-date-format="dd/mm/yyyy"/>
			</div>
			Até:
			<div class="input-append">
				<input id="dpd2" class="span2 search-query" type="text" value="<?= $f; ?>" name="f" data-date-format="dd/mm/yyyy" />
			</div>
        <div class="input-append">
            <input type="text" name="s" class="span2 search-query" value="<?= $s; ?>">
            <button type="submit" class="btn">Pesquisar</button>
        </div>
    </form>
</div>
<div class="grid_12">
    <table id="" class="table table-bordered table-striped table-condensed">
        <thead>
            <tr>
                <th>Data</th>
				<th>De</th>
				<th>Para</th>
                <th colspan="4" style="text-align: center;">Ações</th>
            </tr>
        </thead>
        <tbody>
			<?php if (is_array($cis->Dados)): ?>
				<?php foreach ($cis->Dados as $ci): ?>
					<tr>
						<td><?= date('d/m/Y', $ci->Data) ?></td>
						<td><?= $ci->NomeDe ?></td>
						<td><?= $ci->NomePara ?></td>
						<?php if ($ci->IdUsuarioAtenciosamente == Session::get('usuario')->Id): ?>
							<td style="width: 30px; text-align: center;"><a href="javascript:void(0);" onclick="visualizar(<?= $ci->Id ?>,'1')" class="btn btn-success tool_tip" rel="tooltip" title="Visualizar"> <i class="icon-eye-open icon-white"></i></a></td>
							<td style="width: 30px;"><a href="~/ci/editar/<?= $ci->Id ?>" class="btn btn-primary tool_tip" rel="tooltip" title="Editar"> <i class="icon-pencil icon-white"></i></a></td>
							<td style="width: 30px;"><a href="javascript:void(0);" onclick="modal(<?= $ci->Id ?>, 'ci/excluir/','Tem certeza que deseja excluir esta CI?')" class="btn btn-danger tool_tip" rel="tooltip" title="Excluir"> <i class="icon-trash icon-white"></i></a></td>
							<td style="width: 30px;"><a href="javascript:void(0);"  onclick="modal(<?= $ci->Id ?>, 'ci/enviar/','Tem certeza que deseja enviar esta CI?')" class="btn btn-success tool_tip" rel="tooltip" title="Enviar"> <i class="icon-share icon-white"></i></a></td>
						<?php else: ?>
							<td style="width: 30px; text-align: center;"><a href="javascript:void(0);" onclick="visualizar(<?= $ci->Id ?>,'0')" class="btn btn-success tool_tip" rel="tooltip" title="Visualizar"> <i class="icon-eye-open icon-white"></i></a></td>
							<td style="width: 30px;"><a href="~/ci/editar/<?= $ci->Id ?>" class="btn btn-primary tool_tip" rel="tooltip" title="Editar"> <i class="icon-pencil icon-white"></i></a></td>
							<td style="width: 30px;"><a href="javascript:void(0);" onclick="modal(<?= $ci->Id ?>, 'ci/excluir/','Tem certeza que deseja excluir esta CI?')" class="btn btn-danger tool_tip" rel="tooltip" title="Excluir"> <i class="icon-trash icon-white"></i></a></td>

							<td style="width: 30px;"><a href="javascript:void(0);" class="btn btn-success tool_tip disabled" rel="tooltip" title="Você não tem permissão"> <i class="icon-share icon-white"></i></a></td>
						<?php endif ?>
					</tr>
				<?php endforeach ?>
			<?php else: ?>
				<tr>
					<td colspan="4">Não possui ci cadastrada!</td>
				</tr>
			<?php endif ?>
        </tbody>
    </table>
</div>
<div class="grid_12" style="text-align: center;">
	<?= Pagination::create_data('ci/rascunho/', $cis->Total, $p) ?>
</div>
<div class="modal hide" id="modal-visualizacao" style="margin:-250px 0 0 -390px; width: 750px;">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">×</button>
		<h3 class="cliente-nome">VISUALIZAÇÃO</h3>
	</div>
	<div class="modal-body" style="width: 720px;">

	</div>
	<div class="modal-footer">
		<a href="javascript:void(0);" class="btn" data-dismiss="modal">Fechar</a>
		<a class="btn btn-primary" id="button-enviar">Enviar</a>
	</div>
</div>
