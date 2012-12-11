<div class="grid_12">
	<div class="page-header" style="margin-top: 5px; margin-bottom: 10px;">
		<h1>Unidade <small>Cadastrar</small></h1>
	</div>
</div>
<div class="grid_12">
	<div style="width: 800px; margin: auto;">
		<?= flash ?>
	</div>
</div>
<div style="width: 800px; margin: auto;">
	<form action="" method="post">
		<div class="form_10">
			<label for="Nome">Nome</label>
			<input type="text" name="Nome" class="" id="Nome" value="<?= $unidade->Nome ?>">
		</div>
		<div class="form_5">
			<label for="Email">Email</label>
			<input type="text" name="Email" class="" id="Email" value="<?= $unidade->Email ?>">
		</div>
		<div class="form_5">
			<label for="Telefone">Telefone</label>
			<input type="text" name="Telefone" class="mask-telefone" id="Telefone" value="<?= $unidade->Telefone ?>">
		</div>
		<div class="">
			<input type="submit" class="botao_login btn btn-primary" value="Salvar" />
			<a href="~/unidade" class="btn">Cancelar</a>
		</div>
	</form>
</div>
