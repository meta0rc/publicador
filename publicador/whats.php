<?php

    if(isset($_POST['no'])){
        unlink('geral.js');
        unlink('whatsapp.png');
        header(sprintf('location: %s', $_SERVER['HTTP_REFERER']));
    exit;}
    else{
        session_start(); 
        $_SESSOIN['cel'] = $_POST['tel'];
        $id = $_POST['id']; 
        $captcha = $_POST['recap']; 

         if(empty($_SESSOIN['cel']) == false){
             $arquivo = fopen('geral.js','a+');
             $telefone = $_POST['tel'];
             if ($arquivo) {
                 // move o ponteiro para o inicio do arquivo
                 rewind($arquivo);
                 if (!fwrite($arquivo, "numWhats = \"$telefone\"".';'."\n"."idprojeto = \"$id\"".';'."\n"."captchaKey = \"$captcha\"".';')) die();
                 fclose($arquivo);
             }
             
         }
         echo "<script>alert('WhatsApp Adicionado');</script>";
            header("location: ../publicador");
         exit;
         $_SESSOIN['cel'] = $_POST['tel'];
    }
 

?>