<?php
  $file= fopen("../page/form3.html","r");
    
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
  $lineSave=createContent("name",$_POST['name']).createContent("Endereço",$_POST['address']).createContent("Telefone",$_POST['phone']);

  fwrite($fileSave,$lineSave);
  
  fclose($fileSave);

?>