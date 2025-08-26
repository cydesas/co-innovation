<?php

require_once '../define.php';

$arr_file_types = ['image/png', 'image/gif', 'image/jpg', 'image/jpeg'];
  
if (!(in_array($_FILES['file']['type'], $arr_file_types))) {
    echo "#errorType de fichier non supporté !";
    return;
}

if ($_FILES['file']['size'] > 2097152) {
    echo "#errorTaille de l'image supérieure à 2 Mo !";
    return;
}

  
/*if (!file_exists('img')) {
    mkdir('img', 0777);
}*/
  
$filename = time().'_'.$_FILES['file']['name'];
  
move_uploaded_file($_FILES['file']['tmp_name'], SITE_ROOT.'/public/img/'.$filename);
  
echo $filename;
die;