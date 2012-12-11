<script typo="text/javascript">
	function excluir(id)
	{
		$("#button-confirmar").attr("href", root+"usuario/excluir/"+id);
		$('#usuario-confirmacao').modal('show');
	}

</script>
<div class="grid_12">
	<div class="page-header" style="margin-top: 5px; margin-bottom: 10px;">
		<h1>Usuários <a href="~/unidade"><small>Lista</small></a></h1>
	</div>
</div>
<div class="grid_12">
    <?= flash ?>
</div>
<div class="grid_6">
    <a href="~/usuario/cadastrar" class="btn btn-primary">Novo</a>
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
				 <th>Status</th>
                <th colspan="4" style="text-align: center;">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (is_array($usuarios->Dados)): ?>
                <?php foreach ($usuarios->Dados as $usuario): ?>
                    <tr>
                        <td style="width: 500px;"><?= $usuario->Nome ?></td>
                        <td><?= $usuario->Telefone ?></td>
						<td style="width: 30px;">
							<?php if ($usuario->Bloqueado == 0): ?>
								<a href="~/usuario/bloquear_desbloquear/<?= $usuario->Id ?>" class="btn btn-primary tool_tip" rel="tooltip" title="Clique para Bloquear"> <i class="icon-thumbs-up icon-white"></i></a>
							<?php else: ?>
								<a href="~/usuario/bloquear_desbloquear/<?= $usuario->Id ?>" class="btn btn-danger tool_tip" rel="tooltip" title="Clique para Desbloquear"> <i class="icon-thumbs-down icon-white"></i></a>
							<?php endif ?>
						</td>
                        <td style="width: 30px;">
                            <a href="~/usuario/editar/<?= $usuario->Id ?>" class="btn btn-primary tool_tip" rel="tooltip" title="Editar"> <i class="icon-pencil icon-white"></i></a>
                        </td>
                        <td style="width: 30px;"><a href="javascript:void(0)" onclick="excluir(<?= $usuario->Id ?>)" class="btn btn-danger tool_tip" rel="tooltip" title="Excluir"> <i class="icon-trash icon-white"></i></a></td>
                        <td style="width: 30px;"><a href="~/usuario/v/<?= $usuario->Id ?>" class="btn btn-success tool_tip" rel="tooltip" title="Vincular usuário"> <i class="icon-resize-small icon-white"></i></a></td>
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
    <?= Pagination::create('usuario/index/', $usuarios->Total, $p) ?>
</div>


<div class="modal hide" id="usuario-confirmacao">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3 class="cliente-nome">CONFIRMAÇÃO</h3>
    </div>
    <div class="modal-body">
        Tem certeza que deseja excluir o Usuário?
    </div>
    <div class="modal-footer">
        <a href="javascript:void(0);" class="btn" data-dismiss="modal">Cancelar</a>
        <a class="btn btn-primary" id="button-confirmar">OK</a>
    </div>
</div>
