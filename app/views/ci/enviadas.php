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
		<h1>CIs <a href="~/ci/enviadas"><small>Enviadas</small></a>
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
				<th>Data</th>
				<th>De</th>
				<th>Para</th>
				<th>Visualizado</th>
				<th colspan="3" style="text-align: center;">Ações/Status</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($cis_resposta_v->Dados as $ci): ?>
				<tr>
					<td><?= date('d/m/Y', $ci->Data) ?></td>
					<td><?= $ci->NomeDe ?></td>
					<td><?= $ci->NomePara ?></td>

					<?php if ($ci->IdUsuarioVisualizou): ?>
						<td style="width: 30px; text-align: center;"><span class="badge badge-success tool_tip" rel="tooltip" title="<?= 'por: '.$ci->NomeUsuarioVisualizou ?>"> <i class="icon-eye-open icon-white"></i></span></td>


						<td style="width: 30px; text-align: center;"><a href="~/ci/visualizar/<?= $ci->Id ?>" class="btn btn-success tool_tip" rel="tooltip" title="Visualizar"> <i class="icon-eye-open icon-white"></i></a></td>
						<?php if ($ci->IdUsuarioStatus): ?>
						<td style="width: 30px; text-align: center;"><span class="label tool_tip <?= $ci->Status == 1 ?'label-success':'label-important'; ?>" rel="tooltip" title="<?= 'por: '.$ci->NomeUsuarioStatus ?>" ><?= $ci->Status == 1 ?'Executada':'Não Executada'; ?></span></td>
						<?php else: ?>
						<td style="width: 30px; text-align: center;"><span class="label label-warning">Aguardando Execução</span></td>
						<?php endif ?>
					<?php else: ?>
						<?php if ($ci->IdUsuarioAutorizacao): ?>
							<?php if ($ci->Autorizado): ?>
								<td style="width: 30px; text-align: center;"><?= $ci->Autorizado == 1 ? '<span class="badge label-important"><i class="icon-eye-close icon-white"></i></span>' : ' <span class="label"> -- </span>'; ?></td>
								<td style="width: 30px; text-align: center;"><a href="~/ci/visualizar/<?= $ci->Id ?>" class="btn btn-success tool_tip" rel="tooltip" title="Visualizar"> <i class="icon-eye-open icon-white"></i></a></td>
								<td style="width: 30px; text-align: center;">
									<?php if ($ci->Autorizado == 1): ?>
									<span class="label label-success tool_tip" rel="tooltip" title="<?= 'por: '.$ci->NomeUsuarioAutorizacao?>">
										Autorizada
									</span>
									<span class="label label-info">Aguardando</span>
									<?php else: ?>
									<span class="label label-important tool_tip" rel="tooltip" title="<?= 'por: '.$ci->NomeUsuarioAutorizacao ?>">
										Não Autorizada
									</span>
									<?php endif ?>
								</td>
							<?php else: ?>
								<td style="width: 30px; text-align: center;"><span class="badge label-important"> <i class="icon-eye-close icon-white"></i></span></td>
								<td style="width: 30px; text-align: center;"><a href="~/ci/visualizar/<?= $ci->Id ?>" class="btn btn-success tool_tip" rel="tooltip" title="Visualizar"> <i class="icon-eye-open icon-white"></i></a></td>
								<td style="width: 30px; text-align: center;"><span class="label label-warning tool_tip" rel="tooltip" title="<?= 'de: '.$ci->NomeUsuarioAutorizacao ?>">Aguardando Autorização</span></td>
							<?php endif ?>
						<?php else: ?>
							<td style="width: 30px; text-align: center;"><span class="badge label-important"> <i class="icon-eye-close icon-white"></i></span></td>
							<td style="width: 30px; text-align: center;"><a href="~/ci/visualizar/<?= $ci->Id ?>" class="btn btn-success tool_tip" rel="tooltip" title="Visualizar"> <i class="icon-eye-open icon-white"></i></a></td>
							<td style="width: 30px; text-align: center;"><span class="label label-info">Aguardando</span></td>
						<?php endif ?>


					<?php endif ?>
				<?php endforeach ?>
		</tbody>
	</table>
</div>
<div class="grid_12" style="text-align: center;">
	<?= Pagination::create_data('ci/enviadas/', $cis_resposta_v->Total, $p) ?>
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
						<img src="~/ajuda/enviadas-3.png" />
					</td>
					<td>
						CI Visualizada!
					</td>
				</tr>
				<tr>
					<td>
						<img src="~/ajuda/enviadas-1.png" />
					</td>
					<td>
						CI não visualizada!
					</td>
				</tr>
				<tr>
					<td>
						<img src="~/ajuda/enviadas-2.png" />
					</td>
					<td>
						CI visualizada e Aguardando Execução!
					</td>
				</tr>
				<tr>
					<td>
						<img src="~/ajuda/enviadas-4.png" />
					</td>
					<td>
						Sem status, porque não foi autorizada a execução!
					</td>
				</tr>
				<tr>
					<td>
						<img src="~/ajuda/enviadas-5.png" />
					</td>
					<td>
						Não Autorizada a Execução!
					</td>
				</tr>
				<tr>
					<td>
						<img src="~/ajuda/enviadas-6.png" />
					</td>
					<td>
						Autorizada a Execução!
					</td>
				</tr>
				<tr>
					<td>
						<img src="~/ajuda/enviadas-7.png" />
					</td>
					<td>
						Aguardando Visualização!
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="modal-footer">
		<a href="javascript:void(0);" class="btn" data-dismiss="modal">Fechar</a>
	</div>
</div>