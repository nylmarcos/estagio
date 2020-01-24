<script type="text/javascript">
	var nome = '<?= Session::get('usuario')->Nome; ?>';
	var IdUsuario = '<?= Session::get('usuario')->Id; ?>';
	var actionatual = '<?= ACTION ?>';
	$(document).ready(function() { 
		$("#De").select2(); 
		$("#Para").select2();
		$("#Atenciosamente").select2(); 
		$("#Autorizar").select2();
		$('#De').change(function() {
			if($(this).val().split('-')[1] == 0){
				$.get(root+'ci/get_adm_unidade/'+$(this).val().split('-')[0], function(data) {
					$('#salvar_enviar').hide();
					$("#Atenciosamente").select2();	
					
					
					if(data.d.Quantidade >1){
						$('#s2id_Atenciosamente > .select2-choice > span').html('Selecione');
						$('#Atenciosamente').html(data.d.Conteudo);
					}else{
						if($(data.d.Conteudo).val() == IdUsuario){
							$('#salvar_enviar').show();
						}else{
							$('#salvar_enviar').hide();
						}							
						$("#Atenciosamente").select2("disable");
						$('#s2id_Atenciosamente > .select2-choice > span').html($(data.d.Conteudo).html());
						$('#Atenciosamente').html(data.d.Conteudo);
					}
				});
			}else{
				$('#salvar_enviar').show();
				$('#s2id_Atenciosamente > .select2-choice > span').html(nome);
				$('#Atenciosamente').html('<option value="'+$(this).val().split('-')[0]+'-1" selected="selected">'+nome+'</option>');
				$("#Atenciosamente").select2("disable");
			}
		});
		$('#Atenciosamente').change(function() {
			if($(this).val().split('-')[0] == IdUsuario)
				$('#salvar_enviar').show();
			else
				$('#salvar_enviar').hide();
		});
		$('#salvar_enviar').click(function() {
			$('#form-ci').submit(function() {
				
				$("#modal-confirmacao > .modal-body").text("Tem certeza que deseja salvar e ENVIAR esta CI?");
				$("#button-confirmar").attr("onclick", "submeter_form();");
				$('#modal-confirmacao').modal('show');
				return false;
			});
			;
		});
		if($("#Atenciosamente > option:selected").val() != IdUsuario)
			$('#salvar_enviar').hide();
		if($("#Atenciosamente > option").size() == 1)
			$("#Atenciosamente").select2("disable");
		/*if(actionatual != 'editar'){
			
			$("#Atenciosamente").select2("disable");
			Atenciosamente
		}*/
	});
	function submeter_form(){
		$('#s-e').attr('name',"Salvar");
		$('#s-e').attr('value',"Salvar e Enviar");
		document.forms["form-ci"].submit();    
	}
</script>
<div class="grid_12">
	<div class="page-header" style="margin-top: 5px; margin-bottom: 10px;">
		<h1>CI <small> <?= ucfirst(strtolower(ACTION)) ?></small>
			<a style="float: right;" href="javascript:history.back(1);" class="btn btn-primary tool_tip" rel="tooltip" title="Voltar"> <i class="icon-arrow-left icon-white"></i></a>
		</h1>
	</div>
</div>
<div class="grid_12">
	<div style="width: 800px; margin: auto;">
		<?= flash ?>
	</div>
</div>
<div style="width: 800px; margin: auto;">
	<form action="" id="form-ci" name="form-ci" method="post">
		<div class="form_10">
			<label for="Assunto">Assunto</label>
			<input type="text" name="Assunto" class="" id="Assunto" value="<?= $ci->Assunto ?>">
		</div>
		<div class="form_5">
			<label for="De">De</label>
			<select id="De" class="populate" style="width: 380px; display: none;" name="IdDe">
				<?php if (is_array($m_unidades)): ?>
					<optgroup label="Unidade">
						<?php foreach ($m_unidades as $unidade): ?>
							<option value="<?= $unidade->IdUnidade . '-0' ?>" <?= $unidade->IdUnidade . '-0' == $ci->IdDe . '-' . $ci->TipoDe ? 'selected="selected"' : ''; ?> ><?= $unidade->NomeUnidade ?></option>
						<?php endforeach ?>
					</optgroup>
					<optgroup label="EU">
						<option value="<?= Session::get("usuario")->Id . '-1' ?>" <?= !$ci->IdDe || Session::get("usuario")->Id . '-' . $ci->TipoDe == $ci->IdDe ? 'selected="selected"' : ''; ?> ><?= Session::get("usuario")->Nome ?></option>
					</optgroup>
				<?php else: ?>
					<option value="<?= Session::get("usuario")->Id . '-1' ?>" selected="selected"><?= Session::get("usuario")->Nome ?></option>
				<?php endif ?>
			</select>
		</div>
		<div class="form_5">
			<label for="Para">Para</label>
			<select id="Para" class="populate" style="width: 380px; display: none;" name="IdPara">

				<?php if (is_array($unidades)): ?>
					<optgroup label="Unidade">
						<?php foreach ($unidades as $unidade): ?>
							<?php if ($unidade->Id . '-0' == $ci->IdPara . '-' . $ci->TipoPara): ?>
								<option value="<?= $unidade->Id ?>-0"  selected="selected"><?= $unidade->Nome ?></option>
							<?php else: ?>
								<option value="<?= $unidade->Id ?>-0"><?= $unidade->Nome ?></option>
							<?php endif ?>
						<?php endforeach ?>
					</optgroup>
				<?php else: ?>
					<option value="">Não possui unidade cadastrada!</option>
				<?php endif ?>
				<?php if (is_array($usuarios)): ?>
					<optgroup label="Funcionário">
						<?php foreach ($usuarios as $usuario): ?>
							<?php if ($usuario->Id . '-1' == $ci->IdPara . '-1' . $ci->TipoPara): ?>
								<option value="<?= $usuario->Id ?>-1"  selected="selected"><?= $usuario->Nome ?></option>
							<?php else: ?>
								<option value="<?= $usuario->Id ?>-1"><?= $usuario->Nome ?></option>
							<?php endif ?>

						<?php endforeach ?>
					</optgroup>
				<?php else: ?>
					<option value="">Não possui usuários cadastrados</option>
				<?php endif ?>
			</select>
		</div>
		<div class="form_10">
			<div class="editor-container">
				<div class="btn-toolbar editor-toolbar">
					<div class="btn-group toolbar-controls toolbar-controls">
						<a class="btn tip" title="Negrito" href="javascript:void(0)" onclick="CKEDITOR.tools.callFunction(6, this); return false;"><i class="icon-bold"></i></a>
						<a class="btn tip" title="Itálico" href="javascript:void(0)" onclick="CKEDITOR.tools.callFunction(9, this); return false;"><i class="icon-italic"></i></a>
						<a class="btn tip" title="Sublinhado" href="javascript:void(0)" onclick="CKEDITOR.tools.callFunction(12, this); return false;"><i class="icon-text-width"></i></a>
					</div>
					<div class="btn-group toolbar-controls">
						<a class="btn tip" title="Lista Ordenada" href="javascript:void(0)" onclick="CKEDITOR.tools.callFunction(15, this); return false;"><i class="icon-list"></i></a>
						<a class="btn tip" title="Lista" href="javascript:void(0)" onclick="CKEDITOR.tools.callFunction(18, this); return false;"><i class="icon-list"></i></a>
					</div>
					<div class="btn-group toolbar-controls">
						<a class="btn tip" title="Remover Identação" href="javascript:void(0)" onclick="CKEDITOR.tools.callFunction(21, this); return false;"><i class="icon-indent-right"></i></a>
						<a class="btn tip" title="Identar" href="javascript:void(0)" onclick="CKEDITOR.tools.callFunction(24, this); return false;"><i class="icon-indent-left"></i></a>
					</div>
					<div class="btn-group toolbar-controls">
						<a class="btn tip" title="Imagem" href="javascript:void(0)" onclick="CKEDITOR.tools.callFunction(42, this); return false;"><i class="icon-picture"></i></a>
						<a class="btn tip" title="Tabela" href="javascript:void(0)" onclick="CKEDITOR.tools.callFunction(45, this); return false;"><i class="icon-th"></i></a>
						<a class="btn tip" title="Linha Horizontal" href="javascript:void(0)" onclick="CKEDITOR.tools.callFunction(48, this); return false;"><i class="icon-minus"></i></a>
						<a class="btn tip editor-link" title="Link" href="javascript:void(0)" onclick="CKEDITOR.tools.callFunction(39, this); return false;"><i class="icon-globe"></i></a>
					</div>
					<div class="btn-group editor-select-style">
						<button class="btn dropdown-toggle tip" onclick="try{CKEDITOR.tools.callFunction(49, {});}catch(e){} return false;" title="Estilo do Texto" data-toggle="dropdown">
							<span class="editor-selected-style">Texto Normal</span>
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu">
							<li><a href="javascript:void(0)" onclick="CKEDITOR.tools.callFunction(61,'p'); $('.editor-container .editor-selected-style').text(this.text); return false;">Texto Normal</a></li>
							<li><a href="javascript:void(0)" onclick="CKEDITOR.tools.callFunction(61,'h1'); $('.editor-container .editor-selected-style').text(this.text); return false;"><h1>Titulo 1</h1></a></li>
							<li><a href="javascript:void(0)" onclick="CKEDITOR.tools.callFunction(61,'h2'); $('.editor-container .editor-selected-style').text(this.text); return false;"><h2>Titulo 2</h2></a></li>
							<li><a href="javascript:void(0)" onclick="CKEDITOR.tools.callFunction(61,'h3'); $('.editor-container .editor-selected-style').text(this.text); return false;"><h3>Titulo 3</h3></a></li>
							<li><a href="javascript:void(0)" onclick="CKEDITOR.tools.callFunction(61,'h4'); $('.editor-container .editor-selected-style').text(this.text); return false;"><h4>Titulo 4</h4></a></li>
							<li><a href="javascript:void(0)" onclick="CKEDITOR.tools.callFunction(61,'h5'); $('.editor-container .editor-selected-style').text(this.text); return false;"><h5>Titulo 5</h5></a></li>
							<li><a href="javascript:void(0)" onclick="CKEDITOR.tools.callFunction(61,'h6'); $('.editor-container .editor-selected-style').text(this.text); return false;"><h6>Titulo 6</h6></a></li>
						</ul>
					</div>
					<div class="btn-group toolbar-controls">
						<a class="btn tip" title="Alinhar à Esquerda" href="javascript:void(0)" onclick="CKEDITOR.tools.callFunction(27, this); return false;"><i class="icon-align-left"></i></a>
						<a class="btn tip" title="Alinhar à Centro" href="javascript:void(0)" onclick="CKEDITOR.tools.callFunction(30, this); return false;"><i class="icon-align-center"></i></a>
						<a class="btn tip" title="Alinhar à Direita" href="javascript:void(0)" onclick="CKEDITOR.tools.callFunction(33, this); return false;"><i class="icon-align-right"></i></a>
						<a class="btn tip" title="Justificar" href="javascript:void(0)" onclick="CKEDITOR.tools.callFunction(36, this); return false;"><i class="icon-align-justify"></i></a>
					</div>
				</div>
				<textarea cols="80" id="editor" name="Conteudo" rows="10">
					<?php if (ACTION == 'cadastrar' && $ci->Conteudo == ''): ?>
						<?= $html_modelo ?>
					<?php else: ?>
						<?= $ci->Conteudo ?>
					<?php endif ?>
						
				</textarea>
			</div>
		</div>
		<div class="form_5">
			<label for="Atenciosamente">Remetente</label>
			<select id="Atenciosamente" class="populate" style="width: 380px; display: none;" name="IdUsuarioAtenciosamente">
				<?php if ($usuarios_u != null): ?>
					<?php foreach ($usuarios_u as $usuario): ?>
						<option value="<?= $usuario->IdUsuario ?>" <?= $ci->IdUsuarioAtenciosamente == $usuario->IdUsuario ? 'selected="selected"' : ""; ?> ><?= $usuario->NomeUsuario ?></option>
					<?php endforeach ?>	
				<?php else: ?>

					<option value="<?= Session::get('usuario')->Id ?>" <?= $ci->IdUsuarioAtenciosamente == Session::get('usuario')->Id ? 'selected="selected"' : ""; ?> ><?= Session::get('usuario')->Nome ?></option>
				<?php endif ?>
			</select>
		</div>
		<div class="form_5">
			<label for="Autorizar">Autorizar por</label>
			<select id="Autorizar" class="populate" style="width: 380px; display: none;" name="IdUsuarioAutorizacao">
				<option value="-1">Não necessita de autorização</option>
				<?php if (is_array($usuarios)): ?>
					<?php foreach ($usuarios as $usuario): ?>
						<option value="<?= $usuario->Id ?>" <?= $ci->IdUsuarioAutorizacao == $usuario->Id ? 'selected="selected"' : ""; ?>><?= $usuario->Nome ?></option>
					<?php endforeach ?>
				<?php else: ?>
					<option value="">Não possui usuários cadastrados</option>
				<?php endif ?>
			</select>
		</div>
		<div class="form-actions" style="margin-top: 75px;">
			<input type="hidden" name="s-e" id="s-e" />
			<input type="submit" class="botao_login btn btn-primary" name="Salvar" value="Salvar" />
			<input type="submit" class="botao_login btn btn-primary" name="Salvar" id="salvar_enviar" value="Salvar e Enviar" />
			<a href="~/ci/rascunho" class="btn">Cancelar</a>
		</div>
	</form>
</div>
<script type="text/javascript" src="~/js/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
    CKEDITOR.replace('editor');
</script>
