<?php

class Upload extends Controller {
    
    function __construct(){
        parent::__construct();
        Auth::handleLogin();
        $this->view->js = array('upload/js/default.js');
    }
    
    function index(){    
        $this->view->title = 'Upload';
        
        $this->view->render('header');
        $this->view->render('upload/index');
        $this->view->render('footer');
    }
    
    function logout(){
        Session::destroy();
        header('location: ' . URL .  'login');
        exit;
    }
    
    function tirarAcentos($string){
        return strtoupper(preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$string));
    }
    
    public function removerEspacosCaracteres($_str){        
        $_str = str_replace('..','',$_str);
        $_str = trim($_str);
        $_str = str_replace(array('(',')',',','"',','),'',$_str);
        $_str = str_replace(array('-'),' ',$_str);
        $_str = preg_replace('/\s(?=\s)/', '', $_str);
        $_str = preg_replace('/[\n\r\t]/', ' ', $_str);
        
        return $_str;
    }
    
    public function extrairDataPeloNome($str){
        //separo o nome do arquivo pelo underline
        $str = explode("_", $str);
        //nome do boletim        
        //$nome = $str[0];
        
        $dia = $str[1];        
        $mes = $str[2];        
        switch (strtoupper($mes)){
            //abreviado
            case 'JAN':
                $mes = "01";
                break;
            case 'FEV':
                $mes = "02";
                break;
            case 'MAR':
                $mes = "03";
                break;
            case 'ABR':
                $mes = "04";
                break;
            case 'MAIO':
                $mes = "05";
                break;
            case 'JUN':
                $mes = "06";
                break;
            case 'JUL':
                $mes = "07";
                break;
            case 'AGO':
                $mes = "08";
                break;
            case 'SET':
                $mes = "09";
                break;
            case 'OUT':
                $mes = "10";
                break;
            case 'NOV':
                $mes = "11";
                break;
            case 'DEZ':
                $mes = "12";
                break;           
            //extenso
            case 'JANEIRO':
                $mes = "01";
                break;
            case 'FEVEREIRO':
                $mes = "02";
                break;
            case 'MARÇO':
                $mes = "03";
                break;
            case 'ABRIL':
                $mes = "04";
                break;
            case 'MAIO':
                $mes = "05";
                break;
            case 'JUNHO':
                $mes = "06";
                break;
            case 'JULHO':
                $mes = "07";
                break;
            case 'AGOSTO':
                $mes = "08";
                break;
            case 'SETEMBRO':
                $mes = "09";
                break;
            case 'OUTUBRO':
                $mes = "10";
                break;
            case 'NOVEMBRO':
                $mes = "11";
                break;
            case 'DEZEMBRO':
                $mes = "12";
                break;           
        }        
        $ano = $str[3];
        $ano = explode(".", $ano);
        return $ano[0]."-".$mes."-".$dia;
    }
    
    public function pdfParaTexto($ArquivoPdf){
        //Ao implantar em outra infra estrutura, reconfigurar o endereço local
        //include 'C:\xampp\htdocs\boletins\public\vendor\autoload.php';
        include '/var/www/boletins/public/vendor/autoload.php';
        $parser = new \Smalot\PdfParser\Parser();
        $pdf = $parser->parseFile($ArquivoPdf);
        $text = $pdf->getText();         
        return $text;
    }
    
    function varre_diretorios($rootDir, $allData=array()){
        // defini quais arquivos irão passar desapercebidos
        $invisibleFileNames = array(".", "..", ".htaccess", ".htpasswd");
        // listando os arquivos
        $dirContent = scandir($rootDir);
        foreach($dirContent as $key => $content){
            // filtra todos os arquivos não acessiveis
            $path = $rootDir.'/'.$content;
            if(!in_array($content, $invisibleFileNames)){
                // se o conteúdo do arquivo é legivel
                if(is_file($path) && is_readable($path)){
                    // salva o arquivo com o endereço
                    $allData[] = $path;
                    //se o conteudo é um diretorio e é legível, adiciona o endereço e o nome.
                }
                elseif(is_dir($path) && is_readable($path)){
                    // chamava recursiva para abrir o diretorio
                    $allData = scanDirectories($path, $allData);
                }
            }
        }
        return $allData;
    }
    
    function envia_arquivos_de_um_diretorio(){
        //capturo por post os arquivos
        $total = count($_FILES['DirSel']['name']);
        // passo por um de cada
        for($i=0; $i<$total; $i++){
            //se o tipo for pdf
            if($_FILES['DirSel']['type'][$i]=="application/pdf"){
                //pego o caminho temporário do arquivo
                $tmpFilePath = $_FILES['DirSel']['tmp_name'][$i];
                //verifico se o endereço está setado
                if ($tmpFilePath != ""){
                    //crio um novo diretório para salvar o arquivo
                    //retiro so o BI do nome do arquivo
                    $newFileName = $_FILES['DirSel']['name'][$i];
                    $newFileNameArr = explode("_", $newFileName);
                    $newFileData = $this->extrairDataPeloNome($newFileName);
                    $newFilePath = SERVIDOR_DE_ARQUIVO.$newFileData.".".$_FILES['DirSel']['name'][$i];
                    $newFilePathExt = URL."public/uploads/".$newFileData.".".$_FILES['DirSel']['name'][$i];
                    $newFileSize = $_FILES['DirSel']['size'][$i];
                    $newFileType = $_FILES['DirSel']['type'][$i];
                    //movo o arquivo para o meu novo diretório
                    if(move_uploaded_file($tmpFilePath, $newFilePath)){
                        //echo $this->removerEspacosCaracteres($this->pdfParaTexto($newFilePath));
                        $texto ="";
                        $texto = $this->removerEspacosCaracteres($this->pdfParaTexto($newFilePath));
                        
                        $data = array();
                        $data['nome'] = $newFileNameArr[0];
                        $data['tamanho'] = $newFileSize;
                        $data['tipo'] = $newFileType;
                        $data['diretorio'] = $newFilePath;
                        $data['url'] = $newFilePathExt;
                        $data['data'] = $newFileData;
                        $data['conteudo'] = $this->tirarAcentos($texto);
                        $data['conteudo_mantido'] = $texto;

                        //criar o método create
                        if($this->model->create($data)){
                            echo "Arquivo '".$newFileNameArr[0]."' com data '".$newFileData."' fora convertido com sucesso! \n";
                        }
                    }
                }
            }
        }
    }
    
    function lista_arquivos_datatables(){
        //tabela que será usada
        $table = "upload";
        //Primary key da tabela
        $primaryKey = "uploadid";
        
        $columns = array(
            array( 'db' => 'uploadid',  'dt' => 0 ),          
            array( 'db' => 'nome',  'dt' => 1 ),          
            array(
                'db' => 'data',
                'dt' => 2,
                'formatter' => function( $d, $row )
                {
                    return date( 'd/M/y', strtotime($d));
                }
            ),          
            array( 'db' => 'diretorio',  'dt' => 3 ),          
            array( 'db' => 'tipo',  'dt' => 4 ),          
            array( 'db' => 'tamanho',  'dt' => 5 )          
        );
            
        $sql_details = array(
            'user' => DB_USER,
            'pass' => DB_PASS,
            'db'   => DB_NAME,
            'host' => DB_HOST
        );
        //windows
        //require_once($_SERVER["DOCUMENT_ROOT"].'\boletins\libs\ssp.class.php');        
        //linux
        require_once($_SERVER["DOCUMENT_ROOT"].'/boletins/libs/ssp.class.php');        
        echo json_encode(SSP::simple( $_POST, $sql_details, $table, $primaryKey, $columns ));
    }
    
    function xhrGetListings(){
        $this->model->xhrGetListings();
    }
    
    function xhrDeleteListing(){
        $this->model->xhrDeleteListing();
    }

}