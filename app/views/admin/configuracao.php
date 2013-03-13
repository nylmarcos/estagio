<div class="grid_12">
	<div class="page-header" style="margin-top: 5px; margin-bottom: 10px;">
		<h1>Configuração <small>Usuário</small></h1>
	</div>
</div>
<div class="grid_12">
	<?= flash ?>
</div>
<div class="tabbable tabs-left">
	<ul class="nav nav-tabs">
		<li class="<?= $aba == "notificacao" || $aba == "padrao" ? "active" : "" ?>"><a href="#cn" data-toggle="tab">Configurar notificações</a></li>
		<li class="<?= $aba == "senha" ? "active" : "" ?>"><a href="#as" data-toggle="tab">Alterar senha</a></li>
	</ul>
	<div class="tab-content" style="width: 760px; margin-left: 5px;">
		<div class="tab-pane <?= $aba == "notificacao" || $aba == "padrao" ? "active" : "" ?>" id="cn" >
			<form action="" method="post">
				<div class="page-header" style="margin-top: 2px; margin-bottom: 2px;">
					<h4><small>Email</small></h4>
				</div>
				<label class="checkbox">
					<input type="checkbox" value="1" <?= $usuario->ReceberEmail ? "checked" :"" ?>  name="ReceberEmail" />
					Receber e-mail 
				</label>
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
					<input type="submit" class="botao_login btn btn-primary" name="Salvar" value="Salvar Notificação" />
					<a href="~/usuario" class="btn">Cancelar</a>
				</div> 
			</form>
		</div>
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
					<a href="~/usuario" class="btn">Cancelar</a>
				</div>
			</form>
		</div>
	</div>
</div>