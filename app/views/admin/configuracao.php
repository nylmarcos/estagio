<div class="grid_12">
	<div class="page-header" style="margin-top: 5px; margin-bottom: 10px;">
		<h1>Configuração <small>Usuário</small></h1>
	</div>
</div>
<div class="grid_12">
	<?= flash ?>
</div>
<?php $Egmail = md5("google_ceulp.edu.br_".Session::get('usuario')->Login_Email) == Session::get('usuario')->Senha ? true : false; ?>
<div class="tabbable tabs-left">
	<ul class="nav nav-tabs">
		<li class="<?= $aba == "notificacao" || $aba == "padrao" ? "active" : "" ?>"><a href="#cn" data-toggle="tab">Configurar/Atualizar</a></li>
		<?php if(!$Egmail): ?>
		<li class="<?= $aba == "senha" ? "active" : "" ?>"><a href="#as" data-toggle="tab">Alterar senha</a></li>
		<?php endif ?>
	</ul>
	<div class="tab-content" style="width: 760px; margin-left: 5px;">
		<div class="tab-pane <?= $aba == "notificacao" || $aba == "padrao" ? "active" : "" ?>" id="cn" >
			<form action="" method="post">
				<legend>Email</legend>
				<label class="checkbox">
					<input type="checkbox" value="1" <?= $usuario->ReceberEmail ? "checked" :"" ?>  name="ReceberEmail" />
					Receber e-mail 
				</label>
				<legend>Dados</legend>
				<div class="form_5">
					<label for="Telefone">Telefone</label>
					<input type="text" name="Telefone" class="mask-telefone" id="Telefone" value="<?= $usuario->Telefone ?>">
				</div>
						<div class="form_5">
					<label for="Cargo">Cargo</label>
					<input type="text" name="Cargo" class="" id="Cargo" value="<?= $usuario->Cargo ?>">
				</div>
				<!--<label class="checkbox">
					<input type="checkbox" value="1"  name="ReceberEmailNovaObs" />
					Receber e-mail quando adicionarem observação a CI que estou 
				</label>
				
				<div class="page-header" style="margin-top: 2px; margin-bottom: 2px;">
					<h4><small>SMS</small></h4>
				</div>
				<label class="checkbox">
					<input type="checkbox" value="">
					Receber SMS quando eu ou a(s) unidade(s) que estou alocado receber uma CI
				</label>
				<label class="checkbox">
					<input type="checkbox" value="">
					Receber SMS quando adicionarem observação a alguma CI que estou 
				</label> -->
				<div class="">
					<input type="submit" class="botao_login btn btn-primary" name="Salvar" value="Salvar" />
				</div> 
			</form>
		</div>
		<?php if(!$Egmail): ?>
		<div class="tab-pane <?= $aba == "senha" ? "active" : "" ?>" id="as">
			<form action="" method="post">
				<div class="form_10">
					<label for="Senha">Senha Atual</label>
					<input type="password" name="SenhaAtual" class="" id="SenhaAtual" value="">
				</div>
				<div class="form_5">
					<label for="Senha">Nova Senha</label>
					<input type="password" name="NovaSenha" class="" id="NovaSenha" value="">
				</div>
				<div class="form_5">
					<label for="Senha">Confirmar Nova Senha</label>
					<input type="password" name="CNovaSenha" class="" id="CNovaSenha" value="">
				</div>
				<div class="">
					<input type="submit" class="botao_login btn btn-primary" name="Salvar" value="Alterar" />
					<a href="~/inicio" class="btn">Cancelar</a>
				</div>
			</form>
		</div>
		<?php endif ?>
	</div>
</div>