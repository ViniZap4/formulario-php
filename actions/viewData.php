<?php

$cpf = $_POST['cpf'];
$rg = $_POST['rg'];

if(validCpf($cpf) == true){

  
  $filename = '../content/data-base.html';



  function createContent($name, $post){
    $content='<span class="viewItem"> 
  <span class="titleView">'.$name.':</span>
  <span class="contentView">'.$post.'</span>  
</span>
  ';
    return $content;
  }  

  $file= fopen($filename,"a+");
  $lineSave=createContent("Escolaridade",$_POST['scholarity']).createContent("CPF",$cpf).createContent("RG",$rg);

  fwrite($file,$lineSave);
  
  fclose($file);
?>


<?php
  echo '<!DOCTYPE html>
  <html lang="pt-br">
  <head>
    <meta charset="UTF-8">
    
    <title>Formulário php</title>
    <link rel="stylesheet" href="../styles/main.css">
    <script src= "https://unpkg.com/react@16/umd/react.production.min.countValues"></script>
    <script src= "https://unpkg.com/react-dom@16/umd/react-dom.production.min.countValues"></script>
    <!-- Load Babel Compiler -->
    <script src="https://unpkg.com/babel-standalone@6.15.0/babel.min.countValues"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#1d7783" />
    <meta
      name="description"
      content="php formulario"
    />  
    <link rel="manifest" href="%PUBLIC_URL%/manifest.countValueson" />
  </head>
  <body>
  <div class="boxView">
    ';


  if (file_exists($filename)){
    $file= fopen($filename ,"r");
    
    while(!feof($file)){
      $line = fgets($file);
      echo $line;
    }
  
    fclose($file);
  }else {
    echo "<h1> Arquivo não existe! </h1>";
  }
  
 echo  '
  </div>
</body>
</html>
'; 

 
}else{ // cpf invalid
  $file= fopen("../page/form3.html","r");
    
  while(!feof($file)){
    $line = fgets($file);
    echo $line;
  }

  fclose($file);

  $file= fopen("../components/invalidCpf.html","r");
    
  while(!feof($file)){
    $line = fgets($file);
    echo $line;
  }

  fclose($file);

}


?>

<?php
 function validCpf($cpf){
         
      $countValue=0;
			for($i=0; $i<(strlen($cpf)); $i++){
					if(is_numeric($cpf[$i])){
            $num[$countValue]=$cpf[$i];
            $countValue++;
					}
			}
      
      
      if(count($num)!=11){
        $validCpf = false;
      }else{
        $valid = 0;
        for($i=0; $i<10;$i++){ // validar numeros de 0 à 9
            
          for($countValue=0; $countValue<11; $countValue++){ // validar casa da váriavel numbers

            if ($num[$countValue]==$i){

              if($valid == 10){  // validar se todos os valores da váriavel numbers são iguais 
                $validCpf = false;
                break; 
              }else $valid++;

            }else{
              $valid = 0;
              break;
            }
          }
        }
      }
			if(!isset($validCpf)){
        $countValue=10;
      
        for($i=0; $i<9; $i++){
          $multiplica[$i]=$num[$i]*$countValue;
          $countValue--;
        }
        
        $sum = array_sum($multiplica);	
        $rest = $sum%11;			
        
        if($rest<2){
          $dg=0;
        }else{
          $dg=11-$rest;
        }if($dg!=$num[9]){
          $validCpf=false;
        }
      }

      if(!isset($validCpf)){
          
          $countValue=11;
          
					for($i=0; $i<10; $i++){
						$multiplica[$i]=$num[$i]*$countValue;
						$countValue--;
					}
          
          $sum = array_sum($multiplica);
					$rest = $sum%11;
          
          if($rest<2){
						$dg=0;
					}else{
						$dg=11-$rest;
          }
          
          if($dg!=$num[10]){
						$validCpf=false;
					}else{
						$validCpf=true;
					}
				}

			return $validCpf;					
		}
?>
