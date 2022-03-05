<div class="row">
            <?php
            include_once 'partials/header.php';
            ?>
        </div>

<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sessionDoc = $_POST['textDoc'];
    $sessionArte = $_POST['textArte'];
    $textDoc = '';
    $textArte = '';
}
else{
    $sessionDoc = '';
    $sessionArte = '';
}
    ?>
<html>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous"> 
<link rel="stylesheet" href="css/style.css">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8" />

<!--  List compare -->
<div id="main" class="container-md">
<div class="container p-3">
    <div class="titulo p-3">
        Compara lista de arquivos
    </div>
<form action="list_compare.php" method="post">
    <div class="input-group">
        <div class="col-md-6">
            <span class="input-group-text textwrapper" id="inputGroup-sizing-default">
               Arquivos no MySGS:
            </span>
            <div class="textwrapper" >
                <textarea rows="30" cols="50" name="textDoc"  style="width:100%"><?php echo $sessionDoc;?></textarea>
            </div>
        </div>
        <div class="col-md-6">
            <span class="input-group-text textwrapper" id="inputGroup-sizing-default">
               Arquivos da pasta finais:
            </span>
            <div class="textwrapper">
                <textarea rows="30" cols="50" name="textArte"   style="width:100%"><?php echo $sessionArte;?></textarea>
            </div>
        </div>

    </div>
</div>
    <div class="container p-3">

        <input type = "submit" value = "Comparar" class="btn btn-success" />
    </div>
    </form>
    <?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $textDoc = $_POST['textDoc'];
    $textArte = $_POST['textArte'];
    $extensoes = array('psd','tif');

    foreach($extensoes as $ext){
        $textDoc = str_replace("." . $ext,"",$textDoc);
        $textArte = str_replace("." . $ext,"",$textArte);
    }

    $textDoc = preg_replace("/  /"," ",$textDoc);
    $textArte = preg_replace("/  /"," ",$textArte);
    $textDoc = preg_replace(array('/\r+/','/\n+/', '/\,+/'),",",$textDoc);
    $textArte = preg_replace(array('/\r+/','/\n+/','/\,+/'),',',$textArte);

    $textDocLinhas = explode(',',$textDoc,9999);
    $textArteLinhas = explode(',',$textArte,9999);

    $textDocLinhas=array_filter(array_unique($textDocLinhas));
    $textArteLinhas=array_filter(array_unique($textArteLinhas));

    $textCompara = array();

    foreach ($textDocLinhas as $docLinha){
        foreach($textArteLinhas as $arteLinha){
            if(preg_match('/' . $docLinha . '($|\s$)/i',$arteLinha)){
                if($docLinha != '') array_push($textCompara,$arteLinha);
                array_splice($textDocLinhas,array_search($docLinha,$textDocLinhas),1);
                array_splice($textArteLinhas,array_search($arteLinha,$textArteLinhas),1);
            }
        }
    }
} ?>

<!-- echo '<br><br><h5>Os ' . count($textCompara) . ' arquivos iguais são:</h5><br>';
foreach($textCompara as $textResult){
    echo $textResult . '<br>';
}
-->
<div class="container p-3 m-0">
<?php if(isset($textCompara)){

    echo '<h5>' . count($textCompara) . ' arquivos correspondem.</h5><br>';
}
?>
</div>

<div class="row p-3 m-0">

    <div class="col-md-6">
        <?php
        if(isset($textDocLinhas)){
         echo '<h5>Os ' . count($textDocLinhas) . '/'. (count($textDocLinhas) + count($textCompara)) . ' arquivos não correspondentes no MySGS são:</h5><br>';
         foreach($textDocLinhas as $textResult){
             echo $textResult . '<br>';
            }}
            ?>
 </div>
 <div class="col-md-6">
     <?php
     if(isset($textArteLinhas)){
             echo '<h5>Os ' . count($textArteLinhas) . '/'. (count($textArteLinhas) + count($textCompara)) .  ' arquivos não correspondentes na pasta Finais são:</h5><br>';
             foreach($textArteLinhas as $textResult){
                 echo $textResult . '<br>';
                }
            }

                ?>
 </div>
</div>
<div class="row p-3"></div>

</div>
<?php include_once 'partials/footer.php'; ?>
    </html>