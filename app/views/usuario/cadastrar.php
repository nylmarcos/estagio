<?php $Egmail =   isset($usuario) && md5("google_ceulp.edu.br_".$usuario->Login_Email) == $usuario->Senha ? true : false; ?>
<div class="grid_12">
	<div class="page-header" style="margin-top: 5px; margin-bottom: 10px;">
		<h1>Usuário <small>Cadastrar</small></h1>
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
			<input type="text" name="Nome" class="" id="Nome" <?= $Egmail ? 'disabled=""':""; ?>  value="<?= $usuario->Nome ?>">
		</div>
		<div class="form_5">
			<label for="Email">Email</label>
			<input type="text" name="Login_Email" class="" id="Login_Email"   <?= $Egmail ? 'disabled=""':""; ?>  value="<?= $usuario->Login_Email ?>" >
		</div>
		<div class="form_5">
			<label for="Telefone">Telefone</label>
			<input type="text" name="Telefone" class="mask-telefone" id="Telefone" value="<?= $usuario->Telefone ?>">
		</div>
		<div class="form_5">
			<label for="Senha">Senha</label>
			<input type="password" name="Senha" class="" id="Senha" value=""  <?= $Egmail ? 'disabled=""':""; ?> >
		</div>
		<div class="form_5">
			<label for="ConfirmarSenha">Confirmar Senha</label>
			<input type="password" name="ConfirmarSenha" class="" id="ConfirmarSenha" value=""  <?= $Egmail ? 'disabled=""':""; ?> >
		</div>
		
		<div class="form_5">
			<label for="Cargo">Cargo</label>
			<input type="text" name="Cargo" class="" id="Cargo" value="<?= $usuario->Cargo ?>">
		</div>
		<div class="form_5" style="margin-bottom: 20px; margin-top: 10px;">
			<label for="Cargo">Administrador</label>
			<input type="radio" name="EhAdmin" value="1" <?= $usuario->EhAdmin == 1 ? "checked" : "";?>   style="width: 15px; margin-top: 0px;">Sim
			<input type="radio" name="EhAdmin" value="0" <?= $usuario->EhAdmin == 0 ? "checked" : "";?>   style="width: 25px; margin-top: 0px;">Não
		</div>
		<div class="form-actions" style="margin-top: 225px;">
			<input type="submit" class="botao_login btn btn-primary" value="Salvar" />
			<a href="javascript:history.back(1);" class="btn">Cancelar</a>
		</div>
	</form>
</div>
