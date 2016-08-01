<?php

class Search extends Controller {

    function __construct() {
        parent::__construct();
        $this->view->js = array('search/js/default.js');
        
    }
    
    function index() 
    {    
        $this->view->title = 'Search';
        //echo Hash::create('sha256', 'usuario', HASH_PASSWORD_KEY);
        $this->view->render('header');
        $this->view->render('search/index');
        $this->view->render('footer');
    }
    
    function listaBoletins()
    {
        $this->model->listaBoletins();
    }
    function listaBoletinsFTS()
    {
        $data = array();
        
        if(isset($_POST['search_slct_tipo_vsl'])){
            $data['tipo'] = $_POST['search_slct_tipo_vsl'];
        }
        
        if(isset($_POST['search_datepicker_from'])){
            $data['de'] = $_POST['search_datepicker_from'];
        }
        
        if(isset($_POST['search_datepicker_to'])){ 
            $data['para'] = $_POST['search_datepicker_to'];
        }
        
        if(isset($_POST['search_slct_ano_bol'])){
            $data['ano'] = $_POST['search_slct_ano_bol'];
        }
        
        if(isset($_POST['palavras'])){
            
            $data['palavras'] = preg_replace('/\s(?=\s)/', '', trim($_POST['palavras']));
            $data['palavras'] = preg_replace('/[\n\r\t]/', ' ', $_POST['palavras']);
        }
        $this->model->listaBoletinsFTS($data);
    }
    
    function getPeriodoAno()
    {
        $this->model->getPeriodoAno();
    }
    
    function logout(){
        Session::destroy();
        header('location: ' . URL .  'login');
        exit;
    }
}