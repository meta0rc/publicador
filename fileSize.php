<?php
    
    header('Content-Type: application/json');

    $arq = '../site.zip';
    
    $fileLenth = (filesize($arq));
    
    echo json_encode($fileLenth);


     
    
    
    
     

    