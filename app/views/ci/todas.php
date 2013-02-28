<script typo="text/javascript">
	function excluir(id)
	{
		$("#button-confirmar").attr("href", root+"unidade/excluir/"+id);
		$('#unidade-confirmacao').modal('show');
	}

</script>
<div class="grid_12">
	<div class="page-header" style="margin-top: 5px; margin-bottom: 10px;">
		<h1>Cis <a href="~/unidade"><small>Lista</small></a></h1>
	</div>
</div>
<div class="grid_12">
	<?= flash ?>
</div>
<div class="grid_6">
    <a href="~/ci/cadastrar" class="btn btn-primary">Novo</a>
</div>
<div class="grid_6">
    <form method="get" class="form-search" style="margin-bottom: 5px; float: right;">
        <div class="input-append">
            <input type="text" name="s" class="span2 search-query">
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
				<th style="text-align: center;">Visualizado</th>
                <th colspan="3" style="text-align: center;">Ações</th>
            </tr>
        </thead>
        <tbody>
			<?php if (is_array($cis->Dados)): ?>
				<?php foreach ($cis->Dados as $ci): ?>
					<tr>
						<td><?= date('d/m/Y', $ci->Data) ?></td>
						<td><?= $ci->NomeDe ?></td>
						<td><?= $ci->NomePara ?></td>
						<?php if ($ci->IdUsuarioVisualizou): ?>
							<td style="text-align: center;"><span class="badge badge-success"> <i class="icon-eye-open icon-white"></i></span></td>
						
							<td style="width: 30px;"><a href="" class="btn btn-success tool_tip" rel="tooltip" title="Visualizar"> <i class="icon-eye-open icon-white"></i></a></td>
							<td style="width: 30px;"><a href="" class="btn btn-success tool_tip" rel="tooltip" title="Enviar"> <i class="icon-share icon-white"></i></a></td>
							<td style="width: 30px;"><a href="" class="btn btn-success tool_tip" rel="tooltip" title="Enviar"> <i class="icon-share icon-white"></i></a></td>
						<?php else: ?>
							<td style="text-align: center;"><span class="badge badge-warning"><i class=" icon-eye-close icon-white"></i></span></td>
							<td style="text-align: center; " colspan="3"><a href="" class="btn btn-success tool_tip" rel="tooltip" title="Visualizar"> <i class="icon-eye-open icon-white"></i></a></td>
						<?php endif ?>
					</tr>
				<?php endforeach ?>
			<?php else: ?>
				<tr>
					<td colspan="4">Não possui unidade cadastrada!</td>
				</tr>
			<?php endif ?>
        </tbody>
    </table>
</div>
