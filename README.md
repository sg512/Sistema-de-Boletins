# Sistema-de-Boletins
Conversor de Boletins

Configurações:

1º - Acesse e configure o arquivo "config.php" com os demais dados de seu servidor de Web.

2º - Verificar se banco está criado e populado, dentro da raiz do sistema tem um export da estrutura do sistema.

3º - Certifique-se de qual sistema operacional está rodando seu servidor web para configurar o endereço local do conversor de PDF's. 
Configura-se o conversor alterando o "include" setando o endereço local do vendor (Windows: include 'C:\xampp\htdocs\boletins\public\vendor\autoload.php';),
no método "pdfParaTexto" que se encontra no ".\boletins\controllers\upload.php";

4º configurar o include do datatables:
  Windows: require_once($_SERVER["DOCUMENT_ROOT"].'\boletins\libs\ssp.class.php');
  Linux: require_once($_SERVER["DOCUMENT_ROOT"].'/boletins/libs/ssp.class.php');
