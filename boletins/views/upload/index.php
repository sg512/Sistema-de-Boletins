<h1>Uploads</h1>

<br>

<form id="FrmDirSel" method="post" enctype="multipart/form-data" class="form-inline">
    <div class="form-group">
        <input type="file" name="DirSel[]" id="diretorioSelecionado" webkitdirectory directory multiple/>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-danger" data-toggle="popover" name="submit" style="margin-left: -1%;margin-top: 3%">
            <i id="icone_botao_upload" class="glyphicon glyphicon-send"></i> Enviar Arquivos...
        </button>
    </div>   
</form>
<br>
<hr class="m-y-2">

<div id="alert_processamento" class="alert alert-danger fade in" style="display: none">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Aguarde:</strong> Sua solicitação está sendo processada..
</div>

<div id="mostra_boletins" >
    <!-- DataTables -->
    <table id="TabelaPrincipal" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>id</th>
                <th>nome</th>
                <th>data</th>
                <th>diretorio</th>
                <th>tipo</th>
                <th>tamanho</th>
            </tr>
        </thead>
    </table>
</div>
<!-- DataTables -->