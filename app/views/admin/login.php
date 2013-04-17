<div class="grid_12">
	<?= flash ?>
</div>
	<div class="grid_8">
		<div style="margin-top: 90px">
			<h1>Sistema de CI</h1>
			<p class="lead">Sistema de gerenciamento das Comunicações Internas</p>
		</div>
	</div>	
	<div class="grid_4">
		<div class="navbar-inner" style="width: 223px; height: 340px; margin-top: 40px;">
			<legend>Entrar</legend>
			<form method="post" action="" class="navbar-form pull-left">
				<label style="margin-bottom: 0;">E-mail</label>
				<input type="text" name="email" class="credenciais" id="email" style="margin-top: 0;" />
				<label style="margin-bottom: 0;">Senha</label>
				<input type="password" name="senha" class="credenciais" id="senha" style="margin-top: 0;" />
				<div style="text-align: right;"><input type="submit" class="botao_login btn btn-info" value="Entrar" /></div>
				<div>
					<legend>Ou utilize:</legend>
					<div style="text-align: center;"><a class='login' href="<?= isset($authUrl) ? $authUrl : "#"; ?>"><img src="~/img/logo-email-ulbra.png"></a></div>
				</div>

			</form>

		</div>
	</div>