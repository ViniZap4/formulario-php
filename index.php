<?php
$steps = 'Nform';

if(!isset($_COOKIE[$steps])) { 
  $Nform=1;
  setcookie($steps,$Nform);
}else{
  $Nform=$_COOKIE[$steps];
}

function createContent($name, $post){
  $content='<span class="viewItem"> 
  <span class="titleView">'.$name.':</span>
  <span class="contentView">'.$post.'</span>  
</span>
';
  return $content;
}
function createInvalidBox($type){
  $content .= '<div id="'.$type.'" class="invalidBox">
       <spam class="invalidSpam">
         '.$type.' invalido! tente novamente.
       </spam>
    </div>';
  return $content;
}

function fileSave($content){
  $fileSave= fopen("./content/data-base.html","a+");
  $lineSave=$content;

  fwrite($fileSave,$lineSave);
  
  fclose($fileSave);
}

if (!isset( $_POST ) || empty( $_POST)){
  $update=false;
}

$contentFile = "";

// write file content 

if($Nform==1 and !empty( $_POST['nickname']) and !empty($_POST["email"])){
  fileSave(createContent("nickname",$_POST['nickname']).createContent("E-mail",$_POST['email']));
  $update=true;

}
if($Nform==2 and !empty( $_POST['name']) and !empty($_POST["address"]) and !empty($_POST["phone"]) ){
  fileSave(createContent("name",$_POST['name']).createContent("Endereço",$_POST['address']).createContent("Telefone",$_POST['phone']));
  $update=true;
}
if($Nform==3 and !empty( $_POST['scholarity']) and !empty($_POST["cpf"]) and !empty($_POST["rg"]) ){
  fileSave(createContent("Escolaridade",$_POST['scholarity']).createContent("CPF",$_POST['cpf']).createContent("RG",$_POST['rg']));  
  $update=true;
}


// management form content 

if($update){

  if($Nform<4){
    $Nform+=1;
  }
  setcookie($steps,$Nform);

}


// change content view


function path($value){return '<script type="text/babel" src="../components/form'.$value.'.js"></script>';}

if($Nform < 4){
  $form = path($Nform);
}else if($Nform >=4){

  $cpf = $_POST['cpf'];
  $rg = $_POST['rg'];


  $update=true;



  if(validCpf($cpf) == true and ValidRg($rg) == true){

    $idContent = "boxView";
   
    if (file_exists("./content/data-base.html")){

      $fileContent = fopen("./content/data-base.html", "r");
      while(!feof($fileContent)){
        $contentFile .= fgets($fileContent); 
      }
      fclose($fileContent);

    }else {
      $contentFile .= "<h1> Arquivo não existe! </h1>";
    }

   
    setcookie($steps,1);

  }else{   
    $idContent = "floatBox";

   
    $contentFile .= path(3);

    if (validCpf($cpf) != true){
      $contentFile .= createInvalidBox("CPF");
    }

    if (validRg($rg) != true){
      $contentFile .= createInvalidBox("RG");
    }
  }
}



// print content view

$file = fopen("page/head.html", "r");
while(!feof($file)){
    $line = fgets($file);
    echo $line;
}
fclose($file);

echo '<body>';


  echo '<div id="content"></div>';
if($Nform<4){
  echo $form;
}else if($Nform == 4){
  echo '<div class="'.$idContent.'">';
  echo $contentFile;
  echo '</div>';
}

echo '</body>';
echo '</html>';



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
        }
        
        if($dg!=$num[9]){
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

<?php
  function ValidRg($rg){

    if (strtolower(substr($rg, -1)) == "x" ){
      $rg .=0;
    }
    
    $countValue=0;

    for($i=0; $i<(strlen($rg)); $i++){
        if(is_numeric($rg[$i])){
          $num[$countValue]=$rg[$i];
          $countValue++;
        }
    }

    if(count($num)!=9){
      $validRg = false;
    }else{
      $valid = 0;
      for($i=0; $i<8;$i++){ // validar numeros de 0 à 9
          
        for($countValue=0; $countValue<11; $countValue++){ // validar casa da váriavel numbers

          if ($num[$countValue]==$i){

            if($valid == 8){  // validar se todos os valores da váriavel numbers são iguais 
              $validRg = false;
              break; 
            }else $valid++;

          }else{
            $valid = 0;
            break;
          }
        }
      }
    }

    if(!isset($validRg)){
      for($i=2;$i<=10;$i++){
      
        if($i==10){
          $multiplication[$i-2] = $num[$i-2] * 100;
  
        }else{
          $multiplication[$i-2] = $num[$i-2] * $i;
        }
        
      }
  
      $sum = array_sum($multiplication);
  
      if($sum%11 == 0){
        $validRg = true;
      }else{
        $validRg = false;
      }
    }
    return $validRg;

  }
?>