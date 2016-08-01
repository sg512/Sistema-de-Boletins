<div id="dialog-message" title="Atenção">
    <p id="message_alert">
    </p>
</div>
<div>
    <center>
        <h1 class="display-3">
            <img src="<?php echo URL; ?>public/images/SEF.png" width="5%" height="5%" class="img-rounded pull-xs-left" alt="...">
            Pesquisa de Boletins...
        </h1>
    </center>
    
    <!-- linha -->
    <hr class="m-y-2">
        <div>
            <form id="FrmBolSrch" method="post" enctype="multipart/form-data">
                <div class="container">
                    <div class="row">
						<div class="col-sm-3">
							<select name="search_slct_tipo_vsl" id="search_slct_tipo_vsl" class="form-control" style="margin-left: -0.30%" required>
								<option value="selecione" selected="Selecione">Selecione..</option>
								<option value="ano">Ano</option>
								<option value="periodo">Período</option>
							</select>
						</div>
						<div id="search_li_ano_bol" style='display: none' class="col-sm-2">
							<select id="search_slct_ano_bol" name="search_slct_ano_bol" class=" form-control">
								<!-- itens dinamicamente add-->
							</select>
						</div>
						<div id="search_periodo_bol_from" style='display: none' class="col-sm-2">
							<input type="text" id="search_datepicker_from" name="search_datepicker_from" class="form-control">
						</div>
						<div id="search_periodo_icon" style='display: none;' class="semclasse">
							<label style="width: 1px">/</label>
						</div>
						<div id="search_periodo_bol_to" style='display: none' class="col-sm-2">
							<input type="text" id="search_datepicker_to" name="search_datepicker_to" class=" form-control">
						</div>
                    </div>
					<div class="row" style="padding-top:10px;">
						<div class="col-sm-11">
							<input id="palavras" name="palavras" type="text" placeholder="Insira as palavras a serem localizadas..." class="form-control">
						</div>
						<div class="col-sm-1">
							<button type="submit" id="btn_pesquisar" class="btn btn-danger" data-toggle="popover" name="submit" style="margin-left: -35%" data-loading-text="Loading..." class="btn btn-primary" autocomplete="off"><i class="glyphicon glyphicon-search"></i> Pesquisar</button>
						</div>
					</div>
					<div class="row" style="padding-top:10px;">
						<p class="text-warning">Para pesquisar a palavra inteira, utilizar _ (underline). Exemplo:  ASSUNTOS_ADMINISTRATIVOS </p>
						
						<p class="bg-warning">ANTONIO HAMILTON MARTINS MOURÃO = Retorna cada palavra.</p>
						<p class="bg-warning">ANTONIO_HAMILTON_MARTINS_MOURÃO = Retorna a consulta especifica.</p>
						<hr />
						<p class="text-info">Dúvidas e sugestões: <a href="mailto:casimiro@sef.eb.mil.br">casimiro@sef.eb.mil.br</a></p>
						<p class="text-info"><small>Ramal 3156 Sgt Augusto ou Ten Casimiro</small></p>
					</div>
					
                </div>
            </form>
    </div>
    <!-- linha -->
    <hr class="m-y-2">    
</div>

<div id="mostra_boletins" style='display: none'>
<!-- DataTables -->
<table id="searchBoletins" class="display" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Ocorrências</th>          
        </tr>
    </thead>
</table>
</div>
<!-- DataTables -->