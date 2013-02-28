<div class="grid_12">
	<div class="page-header" style="margin-top: 5px; margin-bottom: 10px;">
		<h1>Unidades <a href="~/unidade"><small>Lista</small></a></h1>
	</div>
</div>
<div class="grid_12">
    <?= flash ?>
</div>
<div class="grid_6">
    <a href="~/unidade/cadastrar" class="btn btn-primary">Novo</a>
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
                        <td style="width: 500px;"><?= $unidade->Nome ?></td>
                        <td><?= $unidade->Telefone ?></td>

                        <td style="width: 30px;">
                            <a href="~/unidade/editar/<?= $unidade->Id ?>" class="btn btn-primary tool_tip" rel="tooltip" title="Editar"> <i class="icon-pencil icon-white"></i></a>
                        </td>
                        <td style="width: 30px;"><a href="javascript:void(0)" onclick="modal(<?= $unidade->Id ?>,'unidade/excluir/','Tem certeza que deseja excluir a Unidade? ')" class="btn btn-danger tool_tip" rel="tooltip" title="Excluir"> <i class="icon-trash icon-white"></i></a></td>
                        <td style="width: 30px;"><a href="~/unidade/visualizar/<?= $unidade->Id ?>" class="btn btn-success tool_tip" rel="tooltip" title="Visualizar"> <i class="icon-eye-open icon-white"></i></a></td>
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
    <?= Pagination::create('unidade/index/', $unidades->Total, $p) ?>
</div>
