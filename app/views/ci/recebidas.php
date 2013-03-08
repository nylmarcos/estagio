<script>
	function visualizar(id)
	{
		$.get(root+'ci/modalvisualizar/'+id, function(data) {
			//alert();
			$("#modal-visualizacao > .modal-body").html(data.d.Conteudo);
			$('#modal-visualizacao').modal('show');	
		});
	
	}
</script>
<div class="grid_12">
	<div class="page-header" style="margin-top: 5px; margin-bottom: 10px;">
		<h1>Cis <a href="~/ci/recebidas"><small>Recebidas</small></a>
			<a style="float: right;" href="javascript:void(0);" onclick="modalhelp()" class="btn btn-primary tool_tip" rel="tooltip" title="Ajuda"> <i class="icon-question-sign icon-white"></i></a>
		</h1>
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
				<th>Número</th>
				<th>Data</th>
				<th>De</th>
				<th>Para</th>
				<th colspan="2" style="text-align: center;">Ações/Status</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($cis_resposta_r->Dados as $ci): ?>
				<tr>
					<td><?= $ci->Numero . '/' . date('Y', $ci->Data) ?></td>
					<td><?= date('d/m/Y', $ci->Data) ?></td>
					<td><?= $ci->NomeDe ?></td>
					<td><?= $ci->NomePara ?></td>

					<?php if ($ci->IdUsuarioVisualizou): ?>
						<td style="width: 30px; text-align: center;"><a href="~/ci/visualizar/<?= $ci->Id ?>" class="btn btn-success tool_tip" rel="tooltip" title="Visualizar"> <i class="icon-eye-open icon-white"></i></a></td>
						<?php if ($ci->IdUsuarioStatus): ?>
							<td style="width: 30px; text-align: center;"><span class="label <?= $ci->Status == 1 ? 'label-success' : 'label-important'; ?>"><?= $ci->Status == 1 ? 'Executada' : 'Não Executada'; ?></span></td>
						<?php else: ?>
							<td style="width: 30px;">
								<div class="btn-group">
									<button class="btn">Status</button>
									<button class="btn dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
									<ul class="dropdown-menu">
										<li><a href="javascript:void(0);" onclick="modal(<?= $ci->Id ?>,'ci/executada_naoexecutada/1/','Tem certeza que deseja marcar como EXECUTADA esta CI?')">Executada</a></li>
										<li><a href="javascript:void(0);" onclick="modal(<?= $ci->Id ?>,'ci/executada_naoexecutada/0/','Tem certeza que deseja marcar como NÃO EXECUTADA esta CI?')">Não Executada</a></li>
									</ul>
								</div>
							</td>
						<?php endif ?>
					<?php else: ?>
						<td style="width: 30px; text-align: center;" colspan="2" ><a href="~/ci/visualizar/<?= $ci->Id ?>" class="btn btn-success tool_tip" rel="tooltip" title="Visualizar"> <i class="icon-eye-open icon-white"></i></a></td>
					<?php endif ?>
				<?php endforeach ?>
		</tbody>
	</table>
</div>
<div class="grid_12" style="text-align: center;">
	<?= Pagination::create_data('ci/recebidas/', $cis_resposta_r->Total, $p) ?>
</div>
<div id="modal-help" class="modal hide">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">×</button>
		<h3 class="cliente-nome">AJUDA</h3>
	</div>
	<div class="modal-body">
		<table id="" class="table table-bordered table-striped table-condensed">
			<thead>
				<tr>
					<th style="text-align: center;">Imagem</th>
					<th style="text-align: center;">Significado</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
						<img src="~/ajuda/recebidas-1.png" />
					</td>
					<td>
						CI aguardando a SUA Visualização!
					</td>
				</tr>
				<tr>
					<td>
						<img src="~/ajuda/recebidas-2.png" />
					</td>
					<td>
						CI visualizada e aguardando adicionar um status!
					</td>
				</tr>
				<tr>
					<td>
						<img src="~/ajuda/recebidas-4.png" />
					</td>
					<td>
						CI marcada como Executada!
					</td>
				</tr>
				<tr>
					<td>
						<img src="~/ajuda/recebidas-5.png" />
					</td>
					<td>
						CI marcada como Não Executada!
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="modal-footer">
		<a href="javascript:void(0);" class="btn" data-dismiss="modal">Fechar</a>
	</div>
</div>