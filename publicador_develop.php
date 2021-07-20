<?php
// maximum execution time in seconds
//set_time_limit (24 * 60 * 60);

header('Content-Type: application/json');
if (!isset($_POST['id'])) die();
$id = $_POST['id'];
$_SESSION['id'] = $id; 
$url = "http://buscacliente.com.br/painel/app/webroot/renders/".$id."/site.zip";
$newFname = "../".basename($url);

$control = new Publish();
$control->downloadFile($id, $url, $newFname);

$control->extractFile($_SERVER['SCRIPT_FILENAME']);

//$control->moveSite();

class Publish
{
  function downloadFile($id, $url, $newFname){
    
    $file = fopen ($url, "rb");

    if ($file) {
      $newf = fopen ($newFname, "wb");
    
      if ($newf)
      while(!feof($file)) {
        fwrite($newf, fread($file, 1024 * 8 ), 1024 * 8 );
      }
    }
    
    if ($file) {
      fclose($file);
    }
    
    if ($newf) {
      fclose($newf);
    }
    
  } 

  function extractFile($server){

    
    $nomeArquivo = explode('/', $server);
    $nomeArquivo = $nomeArquivo[(count(explode('/', $server)) - 1)];
    $caminho = str_replace("publicador/publicador_develop.php", "", $server);
    $dir = scandir(str_replace("publicador/publicador_develop.php", "", $server));
    
    

    $file = '';
    foreach ($dir as $v) {
        if(strpos($v, '.zip') != false) {
            $file = $v;
        }
    }

    $zip = new ZipArchive();
    $res = $zip->open($caminho . $file);

    if ($res === TRUE) {
        $zip->extractTo($caminho);
        $zip->close();
        echo json_encode('Arquivo descompactado com sucesso.'); 
        unlink($caminho . $file);
        shell_exec('mv geral.js ../site/js ; mv whatsapp.png ../site/imagens ; cd ../ ; mv site ../ ; cd ../ ; mv public_html old ; mv site public_html ; cd public_html ; rm .htaccess ; cd ../old/publicador/htaccess ; mv .htaccess ../../../public_html');

    } else {
        echo json_encode('failed, code:' . $res);
    }
      }
    

}
