<link rel="icon" type="image/png" href="./images/favicon.svg" />
<div class="row">
    <?php
    include_once 'partials/header.php';
    ?>
</div>

<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sessionDoc = isset($_POST['textDoc']) ? $_POST['textDoc'] : '';
    $sessionArte = isset($_POST['textArte']) ? $_POST['textArte'] : '';
    $sessionRef = isset($_POST['textRef']) ? $_POST['textRef'] : '';
    $textDoc = '';
    $textArte = '';
    $textRef = '';
}
?>
<html>

<!-- Latest compiled and minified CSS -->
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

<link rel="stylesheet" href="css/style.css">
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
                    <div class="textwrapper">
                        <textarea rows="15" cols="50" name="textDoc" style="width:100%"><?php echo $sessionDoc; ?></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <span class="input-group-text textwrapper" id="inputGroup-sizing-default">
                        Arquivos da pasta finais:
                    </span>
                    <div class="textwrapper">
                        <textarea rows="15" cols="50" name="textArte" style="width:100%"><?php echo $sessionArte; ?></textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <span class="input-group-text textwrapper" id="inputGroup-sizing-default">
                        Arquivos de REFERÊNCIA:
                    </span>
                    <div class="textwrapper">
                        <textarea rows="15" cols="50" name="textRef" style="width:100%"><?php echo $sessionRef; ?></textarea>
                    </div>
                </div>

            </div>
    </div>
    <div class="container p-3">

        <input type="submit" value="Comparar" class="btn btn-success" />
    </div>
    </form>
    <?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $textDoc = $_POST['textDoc'];
        $textArte = $_POST['textArte'];
        $textRef = $_POST['textRef'];
        $extensoes = array('psd', 'tif');

        foreach ($extensoes as $ext) {
            $textDoc = str_replace("." . $ext, "", $textDoc);
            $textArte = str_replace("." . $ext, "", $textArte);
            $textRef = str_replace("." . $ext, "", $textRef);
        }

        $textDoc = preg_replace("/  /", " ", $textDoc);
        $textArte = preg_replace("/  /", " ", $textArte);
        $textRef = preg_replace("/  /", " ", $textRef);
        $textDoc = preg_replace(array('/\r+/', '/\n+/', '/\t+/', '/\,+/'), ",", $textDoc);
        $textArte = preg_replace(array('/\r+/', '/\n+/', '/\t+/', '/\,+/'), ',', $textArte);
        $textRef = preg_replace(array('/\r+/', '/\n+/', '/\t+/', '/\,+/'), ',', $textRef);

        $textDocLinhas = explode(',', $textDoc, 9999);
        $textArteLinhas = explode(',', $textArte, 9999);
        $textRefLinhas = explode(',', $textRef, 9999);

        $totalArq = count($textDocLinhas);

        $textDocLinhas = array_filter($textDocLinhas);
        $textArteLinhas = array_filter($textArteLinhas);
        $textRefLinhas = array_filter(array_unique($textRefLinhas));

        // sort($textDocLinhas);
        // sort($textArteLinhas);
        // sort($textRefLinhas);

        $textCompara = array();
        $textRefCompara = array();
        

        // Compara Mysgs com Finais
        foreach ($textDocLinhas as $docLinha) {
            foreach ($textArteLinhas as $arteLinha) {
                // if(preg_match('/' . $docLinha . '$/i',$arteLinha)){
                if (doublePreg(strtoupper($docLinha)) == doublePreg(strtoupper($arteLinha))) {
                    array_push($textCompara, $arteLinha);
                    array_splice($textDocLinhas, array_search($docLinha, $textDocLinhas, true), 1);
                    array_splice($textArteLinhas, array_search($arteLinha, $textArteLinhas, true), 1);
                }
            }
        }

        //compara Sobra do Mysgs com Refs
        // $textDocLinhas=array_filter(array_unique($textDocLinhas));
        foreach ($textDocLinhas as $docLinha) {
            foreach ($textRefLinhas as $refLinha) {
                // if(preg_match('/' . $docLinha . '$/i',$refLinha)){
                    if (doublePreg(strtoupper($docLinha)) == doublePreg(strtoupper($refLinha)))  {
                    array_push($textRefCompara, $docLinha);
                    array_splice($textDocLinhas, array_search($docLinha, $textDocLinhas, true), 1);
                    array_splice($textRefLinhas, array_search($refLinha, $textRefLinhas, true), 1);
                }
            }
        }

      
    }
    function doublePreg($palavra){
        $invalidChars = '/ +|\-+|\_+/';
        return preg_replace($invalidChars, '_', preg_replace($invalidChars, '_', $palavra));
    } 
    ?>

    <!-- echo '<br><br><h5>Os ' . count($textCompara) . ' arquivos iguais são:</h5><br>';
foreach($textCompara as $textResult){
    echo $textResult . '<br>';
}
-->
    <div class="container p-3 m-0">
        <?php if (isset($textCompara)) {
            echo '<h5>' . count($textCompara) . '/' . $totalArq . ' arquivos Mysgs correspondem com FINAIS.</h5><br>';
            echo '<h5>' . count($textRefCompara) . '/' . $totalArq . ' arquivos Mysgs correspondem com Referências.</h5><br>';
        }
        ?>
    </div>

    <div class="row p-3 m-0">
        <div class="col-md-6">
            <?php
            if (isset($textDocLinhas) && count($textDocLinhas) > 0) {
                echo '<h5>Os ' . count($textDocLinhas) . '/' . $totalArq . ' arquivos não correspondentes no MySGS são:</h5><br>';
                foreach ($textDocLinhas as $textResult) {
                    echo $textResult . '<br>';
                }
            }
            ?>
        </div>
        <div class="col-md-6">
            <?php
            if (isset($textArteLinhas) && count($textArteLinhas) > 0) {
                echo '<h5>Os ' . count($textArteLinhas) . '/' . $totalArq .  ' arquivos não correspondentes na pasta Finais são:</h5><br>';
                foreach ($textArteLinhas as $textResult) {
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