<div class="grid_12">
	<div class="page-header" style="margin-top: 5px; margin-bottom: 10px;">
		<h1>Unidade <small>Dados</small></h1>
	</div>
</div>
<div class="grid_12">
	<?= flash ?>
</div>
<div class="grid_12">
	<h4>Nome: <small><?= $unidade->Nome ?></small></h4>
</div>
<div class="grid_6">
	<h4>Email: <small><?= $unidade->Email ?></small></h4>
</div>
<div class="grid_6">
	<h4>Telefone: <small><?= $unidade->Telefone ?></small></h4>
</div>
<div class="grid_12">
	<div class="page-header" style="margin-top: 5px; margin-bottom: 10px;">
		<h1>Usuários <small>Unidade</small></h1>
	</div>
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
			<?php if (is_array($usuarios)): ?>
				<?php foreach ($usuarios as $usuario): ?>
					<tr>
						<td style="width: 500px;"><?= $usuario->NomeUsuario ?></td>
						<td><?= $usuario->TelefoneUsuario ?></td>

						<td style="width: 30px;">
							<a href="~/unidade/excluir/<?= $usuario->IdUsuarioUnidade ?>" class="btn btn-danger tool_tip" rel="tooltip" title="Excluir Vinculo"> <i class="icon-trash icon-white"></i></a>
						</td>
						<?php if ($usuario->Permissao == 2): ?>
						<td style="width: 30px;"><a href="javascript:void(0)" class="btn btn-success tool_tip disabled" rel="tooltip" title="Administrador">Administrador</a></td>
						<td style="width: 30px;"><a href=<?= root_virtual."unidade/alterar_permissao/".$usuario->IdUsuarioUnidade ?> class="btn btn-primary tool_tip" rel="tooltip" title="comunn">Comum</a></td>
						<?php else: ?>
						<td style="width: 30px;"><a href=<?= root_virtual."unidade/alterar_permissao/".$usuario->IdUsuarioUnidade ?> class="btn btn-primary tool_tip" rel="tooltip" title="Administrador">Administrador</a></td>
						<td style="width: 30px;"><a href="javascript:void(0)" class="btn btn-success tool_tip disabled" rel="tooltip" title="comunn">Comum</a></td>
						<?php endif ?>
					</tr>
				<?php endforeach ?>
			<?php else: ?>
				<tr>
					<td colspan="4">Esta unidade não possui usuários vinculados!</td>
				</tr>
			<?php endif ?>
		</tbody>
	</table>
</div>