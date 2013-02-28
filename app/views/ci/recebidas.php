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
		<h1>Cis <a href="~/ci/recebidas"><small>Recebidas</small></a></h1>
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
				<th colspan="2" style="text-align: center;">Ações</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($cis_resposta_r->Dados as $ci): ?>
				<tr>
					<td><?= date('d/m/Y', $ci->Data) ?></td>
					<td><?= $ci->NomeDe ?></td>
					<td><?= $ci->NomePara ?></td>

					<?php if ($ci->IdUsuarioVisualizou): ?>
						<td style="width: 30px; text-align: center;"><a href="~/ci/visualizar/<?= $ci->Id ?>" class="btn btn-success tool_tip" rel="tooltip" title="Visualizar"> <i class="icon-eye-open icon-white"></i></a></td>
						<?php if ($ci->IdUsuarioStatus): ?>
						<td style="width: 30px; text-align: center;"><span class="label <?= $ci->Status == 1 ?'label-success':'label-important'; ?>"><?= $ci->Status == 1 ?'Deferida':'Indeferida'; ?></span></td>
						<?php else: ?>
							<td style="width: 30px;">
								<div class="btn-group">
									<button class="btn">Status</button>
									<button class="btn dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
									<ul class="dropdown-menu">
										<li><a href="javascript:void(0);" onclick="modal(<?= $ci->Id ?>,'ci/deferir_indeferir/1/','Tem certeza que deseja marcar como deferido esta CI?')">Deferir</a></li>
										<li><a href="javascript:void(0);" onclick="modal(<?= $ci->Id ?>,'ci/deferir_indeferir/0/','Tem certeza que deseja marcar como indeferido esta CI?')">Indeferir</a></li>
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
<?= $cis_resposta_r->Total; ?>
<div class="grid_12" style="text-align: center;">
	<?= Pagination::create_data('ci/recebidas/', $cis_resposta_r->Total, $p) ?>
</div>
