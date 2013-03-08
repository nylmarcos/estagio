<div class="grid_12">
	<div class="page-header" style="margin-top: 5px; margin-bottom: 10px;">
		<h1>Vincular <small><?= $usuario->Nome ?></small></h1>
	</div>
</div>
<div class="grid_12">
	<?= flash ?>
</div>
<div class="grid_6">
    .
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
                <th>Nome</th>
				<th>Telefone</th>
                <th colspan="3" style="text-align: center;">Ações</th>
            </tr>
        </thead>
        <tbody>
			<?php if (is_array($unidades->Dados)): ?>
				<?php foreach ($unidades->Dados as $unidade): ?>
					<tr>
						<td style="width: 500px;"><?= $unidade->NomeUnidade ?></td>
							<td><?= $unidade->TelefoneUnidade ?></td>
						<?php if ($unidade->IdUsuario == $usuario->Id): ?>
							<td style="width: 30px;"><a href="javascript:void(0);" onclick="modal(<?= $unidade->IdUsuarioUnidade ?>,'usuario/excluir_vinculo/','Tem certeza que deseja excluir vinculo?')" class="btn btn-danger tool_tip" rel="tooltip" title="Excluir vinculo"> <i class="icon-trash icon-white"></i></a></td>
							<?php if ($unidade->Permissao == 2): ?>
								<td style="width: 30px;"><a href="javascript:void(0);" class=" btn btn-success tool_tip disabled" rel="tooltip" title="">Administrador</a></td>
								<td style="width: 30px;"><a href="~/usuario/alterar_permissao/<?= $unidade->IdUsuarioUnidade ?>" class=" btn btn-primary tool_tip " rel="tooltip" title="Comum">Comum</a></td>
							<?php else: ?>
								<td style="width: 30px;"><a href="~/usuario/alterar_permissao/<?= $unidade->IdUsuarioUnidade ?>" class=" btn btn-primary tool_tip" rel="tooltip" title="Administrador">Administrador</a></td>
								<td style="width: 30px;"><a href="javascript:void(0);" class="btn btn-success tool_tip disabled" rel="tooltip" title="">Comum</a></td>
							<?php endif ?>
						<?php else: ?>
							<td style="width: 30px;"><a href="javascript:void(0);" class="btn btn-danger tool_tip disabled" rel="tooltip" title=""> <i class="icon-trash icon-white"></i></a></td>
							<td style="width: 30px;"><a href="~/usuario/vincular/<?= $unidade->IdUnidade . '/' . $usuario->Id . '/2' ?>" class="btn btn-primary tool_tip" rel="tooltip" title="Clique para criar vincular"> Administrador </a></td>
							<td style="width: 30px;"><a href="~/usuario/vincular/<?= $unidade->IdUnidade . '/' . $usuario->Id . '/3' ?>"  class="btn btn-primary tool_tip" rel="tooltip" title="Clique para criar vincular"> Comum </a></td>
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
<div class="grid_12" style="text-align: center;">
	<?= Pagination::create('usuario/v/' . $usuario->Id .'/', $unidades->Total, $p) ?>
</div>
