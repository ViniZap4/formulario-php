<?php
  $file= fopen("../page/form2.html","r");
      
  while(!feof($file)){
    $line = fgets($file);
    echo $line;
  }

  fclose($file);
?>



<?php 

  function createContent($name, $post){
    $content='<span class="viewItem"> 
  <span class="titleView">'.$name.':</span>
  <span class="contentView">'.$post.'</span>  
</span>
  ';

    return $content;
  }

  $fileSave= fopen("../content/data-base.html","a+");
  $lineSave=createContent("nickname",$_POST['nickname']).createContent("E-mail",$_POST['email']);

  fwrite($fileSave,$lineSave);
  
  fclose($fileSave);
?>