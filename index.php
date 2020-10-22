
<?php

  $file= fopen("page/form1.html","r");
  
  while(!feof($file)){
    $line = fgets($file);
    echo $line;
  }

  fclose($file);

?>



