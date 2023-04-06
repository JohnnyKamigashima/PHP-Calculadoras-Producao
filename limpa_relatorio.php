<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="./images/favicon.svg" />
    <!-- Latest compiled and minified CSS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
        </script>
    <link rel="stylesheet" href="css/style.css">
    <title>Limpeza de relatório de teste</title>
    <div class="row">
        <?php include_once 'partials/header.php'; ?>
    </div>
</head>
<?php
include_once 'partials/functions.php';
$respostaArr = uploadFile('uploads/', 'html', 100000, 'fileToUpload');
$resposta    = strpos($respostaArr[0], "corretamente")
    ? $respostaArr[0] . "<br>" . readAndCleanupReportFile($respostaArr[1])
    : $respostaArr[0];
?>

<body>
    <div id="main" class="container-md">
        <div class="container p-3">
            <div class="titulo p-2 pt-3 m-2">
                <h2>Limpeza de html de relatórios de teste</h2>
            </div>
            <div class="row p-3">
                <div class="d-flex justify-content-center">
                    <p>
                        Escolha o relatorio gerado pelo IntelliJ, normalmente algo como "Test Results -
                        NomeDoTest.html", em
                        seguida clique em Subir, e, se tudo der certo vai aparecer um link para visualizar o arquivo
                        limpo.<br>
                        Para salvar na sua máquina aperte ctrl-s no PC ou cmd-s no Mac.
                    </p>
                </div>
            </div>
            <div class="row p-3">
                <div class="d-flex justify-content-center">
                    <form method="post" name="fileUpload" action="limpa_relatorio.php" enctype="multipart/form-data">
                        <input class="m-2" type="file" name="fileToUpload" id="fileToUpload"><input class="m-2"
                            type="submit" value="Subir" name="submit">
                    </form>
                </div>
                <div class="row">
                    <div class="d-flex justify-content-center">
                        <p class='h6 text-center'>
                            <?php
                            if ($resposta != '') {
                                echo $resposta;
                            }
                            ?>
                        </p>
                    </div>
                </div>

            </div>

        </div>
    </div>


    <script src="" async defer></script>

</body>
<footer>
    <?php include_once 'partials/footer.php'; ?>
</footer>

</html>