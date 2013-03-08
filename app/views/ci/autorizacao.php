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
		<h1>Cis <a href="~/ci/autoriza"><small>Autorização</small></a>
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
	<?php if (is_array($cis_autorizacao->Dados)): ?>
		<div class="grid_12">
			<table id="" class="table table-bordered table-striped table-condensed">
				<thead>
					<tr>
						<th>Data</th>
						<th>De</th>
						<th>Para</th>
						<th colspan="2" style="text-align: center;">Ações</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($cis_autorizacao->Dados as $ci): ?>
						<tr>
							<td><?= date('d/m/Y', $ci->Data) ?></td>
							<td><?= $ci->NomeDe ?></td>
							<td><?= $ci->NomePara ?></td>


							<td style="width: 30px; text-align: center;"><a href="javascript:void(0);" onclick="visualizar(<?= $ci->Id ?>)" class="btn btn-success tool_tip" rel="tooltip" title="Visualizar"> <i class="icon-eye-open icon-white"></i></a></td>
							<?php if (!$ci->Autorizado): ?>
								<td style="width: 30px;">
									<div class="btn-group">
										<button class="btn">Autorizar?</button>
										<button class="btn dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
										<ul class="dropdown-menu">
											<li><a href="javascript:void(0);" onclick="modal(<?= $ci->Id ?>,'ci/autorizar_naoautorizar/1/','Tem certeza que deseja autorizar esta CI?')">Sim</a></li>
											<li><a href="javascript:void(0);" onclick="modal(<?= $ci->Id ?>,'ci/autorizar_naoautorizar/2/','Tem certeza que deseja não aceitar esta CI?')">Não</a></li>
										</ul>
									</div>
								</td>
							<?php else: ?>
								<?php if ($ci->Autorizado == 1): ?>
									<td style="width: 30px; text-align: center;"><span class="label label-success">Autorizada</span></td>
								<?php else: ?>
									<td style="width: 30px; text-align: center;"><span class="label label-important">Não Autorizada</span></td>
								<?php endif ?>

							<?php endif ?>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
	<?php endif ?>
	<div class="grid_12" style="text-align: center;">
		<?= Pagination::create_data('ci/autoriza/', $cis_autorizacao->Total, $p) ?>
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
		</div>
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
						<img src="~/ajuda/autorizacao-1.png" />
					</td>
					<td>
						CI Aguardando Autorização!
					</td>
				</tr>
				<tr>
					<td>
						<img src="~/ajuda/autorizacao-3.png" />
					</td>
					<td>
						CI Não Autorizada!
					</td>
				</tr>
				<tr>
					<td>
						<img src="~/ajuda/autorizacao-2.png" />
					</td>
					<td>
						CI Autorizada!
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="modal-footer">
		<a href="javascript:void(0);" class="btn" data-dismiss="modal">Fechar</a>
	</div>
</div>
