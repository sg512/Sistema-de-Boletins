<?php

class Search_Model extends Model {

    public function __construct() {
        parent::__construct();
    }
    
    public function xhrInsert() 
    {
        $text = $_POST['text'];
        
        $this->db->insert('data', array('text' => $text));
        
        $data = array('text' => $text, 'id' => $this->db->lastInsertId());
        echo json_encode($data);
    }
    
    public function getPeriodoAno()
    {
        $result = $this->db->select("select min(data) as data_minima,max(data) as data_maxima from upload");
        echo json_encode($result);
    }
    
    public function listaBoletins()
    {
        $result = $this->db->select("SELECT uploadid,nome,data,diretorio,tipo,url,tamanho FROM upload");
        echo json_encode($result);
    }
    
    public function listaOcorrenciaPalavras($palavras,$conteudo)
    {
        //passo por todas as palavras
        foreach ($palavras as $pal){
            //enquanto o $numero_ocorrencias receber novas posições encontradas
            while(($numero_ocorrencias = strpos($string, $pal, $numero_ocorrencias+1)) != 0){
                echo $numero_ocorrencias.' ';
                //substr($texto, 11, 9); parametros(posição,quantos caracteres irá cortar)
            }
        }      
        
    }
    
    function tirarAcentos($string){
        return strtoupper(preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$string));
    }
    
    public function listaBoletinsFTS($data){
        
        //separo as palavras
        $palavras = explode(",", $data['palavras']);
        //crio uma variável para receber as palavras
        $partes_palavras_chave ='';
        //passo por todas as palavras e as concateno com espaço e +
        foreach ($palavras as $p){
            //$partes_palavras_chave .= "+" . $p ."* ";
            $partes_palavras_chave .= " '%" .$this->tirarAcentos($p)."%' OR";
        }
        //retiro resquicio de espaço
        $partes_palavras_chave = substr($partes_palavras_chave,0,-3);
        
        switch ($data['tipo']) {
            case "ano":
                $consulta = "SELECT *,DATE_FORMAT(data, '%d/%m/%Y') as data FROM `upload` WHERE YEAR(`data`)='".$data['ano']."' AND `conteudo` LIKE".$partes_palavras_chave." ORDER BY `nome` DESC";
                break;
            case "periodo":
                $data_inicio = explode("/", $data['de']);
                $data_inicio = $data_inicio[2]."-".$data_inicio[1]."-".$data_inicio[0];
                
                $data_fim = explode("/", $data['para']);
                $data_fim = $data_fim[2]."-".$data_fim[1]."-".$data_fim[0];
                
                $consulta = "SELECT *,DATE_FORMAT(data, '%d/%m/%Y') as data FROM `upload` WHERE `data` BETWEEN '".$data_inicio."' AND '".$data_fim."' AND `conteudo` LIKE".$partes_palavras_chave." ORDER BY `nome` DESC";
                break;
            default:
                die();
        }
        
        $result = $this->db->select($consulta);
        
        echo json_encode($result, JSON_UNESCAPED_UNICODE);        
    }
    
    public function xhrDeleteListing()
    {
        $id = (int) $_POST['id'];
        $this->db->delete('data', "id = '$id'");
    }
}