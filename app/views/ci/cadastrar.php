
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
    <textarea cols="80" id="editor" name="conteudo" rows="10">
    </textarea>
</div>
<script type="text/javascript" src="~/js/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
    CKEDITOR.replace('editor');
</script>