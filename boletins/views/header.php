<!doctype html>
<html>
<head>
    <link rel="shortcut icon" type="image/ico" href="<?php echo URL; ?>public/images/fav.ico" />
    <title><?=(isset($this->title)) ? $this->title : 'Boletins'; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <!-- Jquery -->
        <script type="text/javascript" src="<?php echo URL; ?>public/js/jquery-1.12.3.min.js"></script>
    <!-- Jquery -->
    <!-- Bootstrap -->
        <link href="<?php echo URL; ?>public/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="<?php echo URL; ?>public/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="<?php echo URL; ?>public/TableTools-master/css/dataTables.tableTools.css" rel="stylesheet">
        
        <script type="text/javascript" src="<?php echo URL; ?>public/bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo URL; ?>public/TableTools-master/js/dataTables.tableTools.js"></script>
        
        
    <!-- Bootstrap -->
    <!-- JqueryUI -->
        <link rel="stylesheet" href="<?php echo URL; ?>public/js/jquery-ui-1.11.4/jquery-ui.min.css" />
        <script type="text/javascript" src="<?php echo URL; ?>public/js/jquery-ui-1.11.4/jquery-ui.min.js"></script>
    <!-- JqueryUI -->
    <!-- DataTables -->
        <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/DataTables-1.10.11/media/css/jquery.dataTables.min.css"/>
        <script type="text/javascript" src="<?php echo URL; ?>public/DataTables-1.10.11/media/js/jquery.dataTables.min.js"></script>
    <!-- DataTables -->
    <!-- Tag -->
        <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/tag-it-master/css/jquery.tagit.css"/>
        <script type="text/javascript" src="<?php echo URL; ?>public/tag-it-master/js/tag-it.min.js"></script>
    <!-- Tag -->
    <!-- inputMask -->
        <script type="text/javascript" src="<?php echo URL; ?>public/js/jquery.maskedinput.min.js"></script>
    <!-- inputMask -->
    <!-- Customizado -->
        <link rel="stylesheet" href="<?php echo URL; ?>public/css/default.css" />
        <script type="text/javascript" src="<?php echo URL; ?>public/js/custom.js"></script>
    <!-- Customizado -->
    
    <?php 
    if (isset($this->js)) 
    {
        foreach ($this->js as $js)
        {
            echo '<script type="text/javascript" src="'.URL.'views/'.$js.'"></script>';
        }
    }
    ?>
</head>
<body>

<?php Session::init(); ?>
    
<div id="header">

    <?php if (Session::get('loggedIn') == false):?>
        <a href="http://intranet.sef.eb.mil.br/index.php" title="Voltar para a Intranet da SEF"><i class="glyphicon glyphicon-arrow-left"></i></a>
        <a href="<?php echo URL; ?>search"><i class="glyphicon glyphicon-home" title="Página principal da pesquisa de Boletins"></i></a>
        <a href="<?php echo URL; ?>help"><i class="glyphicon glyphicon-question-sign" title="Ajuda"></i></a>
    <?php endif; ?>    
    <?php if (Session::get('loggedIn') == true):?>
        <a href="<?php echo URL; ?>upload"><i class="glyphicon glyphicon-floppy-open" title="Página de Upload de Boletins"></i></a>
        
        <?php if (Session::get('role') == 'owner'):?>
        <a href="<?php echo URL; ?>user"><i class="glyphicon glyphicon-user" title="Adicionar e Remover Usuários"></i></a>
        <?php endif; ?>
        
        <a href="<?php echo URL; ?>dashboard/logout"><i class="glyphicon glyphicon-off" title="Efetuar Logoff"></i></a>    
    <?php else: ?>
        <a href="<?php echo URL; ?>login"><i class="glyphicon glyphicon-off" title="Efetuar Loggin"></i></a>
    <?php endif; ?>
</div>
<div id="content">
    
    