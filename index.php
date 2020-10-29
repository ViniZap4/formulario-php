<?php
$steps = 'Nform';

if(!isset($_COOKIE[$steps])) { 
  $Nform=1;
  setcookie($steps,$Nform);
}else{
  $Nform=$_COOKIE[$steps];
}

function path($value){return '<script type="text/babel" src="../components/form'.$value.'.js"></script>';}
if($Nform < 4){
  $form = path($Nform);
}


function createContent($name, $post){
  $content='<span class="viewItem"> 
<span class="titleView">'.$name.':</span>
<span class="contentView">'.$post.'</span>  
</span>
';

  return $content;
}

function fileSave($content){
  $fileSave= fopen("./content/data-base.html","a+");
  $lineSave=$content;

  fwrite($fileSave,$lineSave);
  
  fclose($fileSave);
}

// if (!isset( $_POST ) || empty( $_POST)){
//   $update=false;
// }


if($Nform==2){
  fileSave(createContent("nickname",$_POST['nickname']).createContent("E-mail",$_POST['email']));

}
if($Nform==3){
  fileSave(createContent("name",$_POST['name']).createContent("Endereço",$_POST['address']).createContent("Telefone",$_POST['phone']));

}
if($Nform==4){
  fileSave(createContent("Escolaridade",$_POST['scholarity']).createContent("CPF",$$_POST['cpf']).createContent("RG",$_POST['rg']));
}
if($Nform >=4){
    $Nform=0;
}

if($update){

  if($Nform<4){
    $Nform+=1;
  }
  setcookie($steps,$Nform);
}




$file = fopen("page/head.html", "r");
while(!feof($file)){
    $line = fgets($file);
    echo $line;
}
fclose($file);


echo '<body>';
echo '<div id="content"></div>';
echo $form;
echo '</body>';
echo '</html>';

?>