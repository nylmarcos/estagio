<script typo="text/javascript">
	function excluir(id)
	{
		$("#button-confirmar").attr("href", root+"unidade/excluir/"+id);
		$('#unidade-confirmacao').modal('show');
	}

</script>
<div class="grid_12">
	<div class="page-header" style="margin-top: 5px; margin-bottom: 10px;">
		<h1>CIs <small>Rascunho</small></h1>
	</div>
</div>
<div class="grid_12">
    <?= flash ?>
</div>
<div class="grid_12">
    <table id="" class="table table-bordered table-striped table-condensed">
        <thead>
            <tr>
                <th>Data</th>
				<th>De</th>
				<th>Para</th>
                <th colspan="2" style="text-align: center;">Ações</th>
            </tr>
        </thead>
        <tbody>
			<tr>
				<td>10/10/1025</td>
				<td>Sistemas de Informação</td>
				<td>Coppex</td>
				<td style="width: 30px;"><a href="" class="btn btn-success tool_tip" rel="tooltip" title="Visualizar"> <i class="icon-eye-open icon-white"></i></a></td>
				 <td style="width: 30px;"><a href="" class="btn btn-success tool_tip" rel="tooltip" title="Enviar"> <i class="icon-share icon-white"></i></a></td>
				
			</tr>
			<tr>
				<td>10/10/1025</td>
				<td>Sistemas de Informação</td>
				<td>Coppex</td>
				<td style="width: 30px;"><a href="" class="btn btn-success tool_tip" rel="tooltip" title="Visualizar"> <i class="icon-eye-open icon-white"></i></a></td>
				 <td style="width: 30px;"><a href="" class="btn btn-success tool_tip" rel="tooltip" title="Enviar"> <i class="icon-share icon-white"></i></a></td>	
				
			</tr>
        </tbody>
    </table>
</div>
<div class="grid_12">
	<div class="page-header" style="margin-top: 5px; margin-bottom: 10px;">
		<h1>CIs <small>Aguardando Resposta</small></h1>
	</div>
</div>
<div class="grid_12">
    <table id="" class="table table-bordered table-striped table-condensed">
        <thead>
            <tr>
                 <th>Data</th>
				<th>De</th>
				<th>Para</th>
                <th colspan="2" style="text-align: center;">Ações</th>
            </tr>
        </thead>
        <tbody>
			<tr>
				<td>10/10/1025</td>
				<td>Sistemas de Informação</td>
				<td>Coppex</td>
				<td style="width: 30px;"><a href="" class="btn btn-success tool_tip" rel="tooltip" title="Visualizar"> <i class="icon-eye-open icon-white"></i></a></td>
				
				
				 <td style="width: 30px;">
					<div class="btn-group">
						<button class="btn">Status</button>
						<button class="btn dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
						<ul class="dropdown-menu">
							<li><a href="#">Deferir</a></li>
							<li><a href="#">Indeferir</a></li>
						</ul>
					</div>
				 </td>
			</tr>
			<tr>
				<td>10/10/1025</td>
				<td>Sistemas de Informação</td>
				<td>Coppex</td>
				<td style="width: 30px; text-align: center;" colspan="2"><a href="" class="btn btn-success tool_tip" rel="tooltip" title="Visualizar"> <i class="icon-eye-open icon-white"></i></a></td>
				 
				
			</tr>
        </tbody>
    </table>
</div>
<div class="grid_12">
	<div class="page-header" style="margin-top: 5px; margin-bottom: 10px;">
		<h1>CIs <small>Aguardando Autorização</small></h1>
	</div>
</div>
<div class="grid_12">
    <table id="" class="table table-bordered table-striped table-condensed">
        <thead>
            <tr>
                <th>Data</th>
				<th>De</th>
				<th>Para</th>
                <th colspan="2" style="text-align: center;">Ações</th>
            </tr>
        </thead>
        <tbody>
			<tr>
				<td>10/10/1025</td>
				<td>Sistemas de Informação</td>
				<td>Coppex</td>
				<td style="width: 30px;"><a href="" class="btn btn-success tool_tip" rel="tooltip" title="Visualizar"> <i class="icon-eye-open icon-white"></i></a></td>
				<td style="width: 30px;">
					<div class="btn-group">
						<button class="btn">Autorizar</button>
						<button class="btn dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
						<ul class="dropdown-menu">
							<li><a href="#">Sim</a></li>
							<li><a href="#">Não</a></li>
						</ul>
					</div>
				 </td>
			</tr>
			<tr>
				<td>10/10/1025</td>
				<td>Sistemas de Informação</td>
				<td>Coppex</td>
				<td style="width: 30px;"><a href="" class="btn btn-success tool_tip" rel="tooltip" title="Visualizar"> <i class="icon-eye-open icon-white"></i></a></td>
				<td style="width: 30px;">
					<div class="btn-group">
						<button class="btn">Autorizar</button>
						<button class="btn dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
						<ul class="dropdown-menu">
							<li><a href="#">Sim</a></li>
							<li><a href="#">Não</a></li>
						</ul>
					</div>
				 </td>
			</tr>
        </tbody>
    </table>
</div>