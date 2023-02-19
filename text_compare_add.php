<!-- List compare versao 1.0 Por Johnny H. Kamigashima -->
<!-- Copyright 2021 -->
<!DOCTYPE html>

<html lang="pt-br">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8">
    <script type="text/javascript" src="partials/functions/textcompare_lib.js"></script>
    <link rel="icon" type="image/png" href="./images/favicon.svg" />
    <!-- Latest compiled and minified CSS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
        </script>

    <link rel="stylesheet" href="css/style.css">
    <title>QC Text Compare</title>

    <div class="row">
        <?php include_once 'partials/header.php'; ?>
    </div>
</head>

<body>
    <!--  List compare HTML-->
    <div id="main" class="container-md">
        <div class="container p-3">
            <div class="titulo p-2 pt-3 m-2">
                <h2> Adiciona Palavras para quebra de linha</h2>
            </div>
            <div class="row p-3">
                <form action="text_compare_add.php" method="post">
                    <div class="row"> <label for="novaPalavra" class="p-1">Insira a palavra a ser iniciada em nova
                            linha:</label>
                        <input name="novaPalavra" id="novaPalavra"></input>
                    </div>
                    <div class="row">
                        <label for="abreviacao" class="p-1">Insira a abreviação a ser adicionada:</label>
                        <input name="abreviacao" id="abreviacao"></input>
                    </div>
                    <input type="submit" value="Enviar">
                </form>
            </div>

            <?php
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);
            session_start();
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if ($_POST['novaPalavra'] != '') {
                    $palavraNova = "|" . $_POST['novaPalavra'];
                    file_put_contents('QuebraLinhas.txt', str_replace(" ", " ", trim($palavraNova)), FILE_APPEND);
                    echo $palavraNova . " adicionado com sucesso!";
                }

                if ($_POST['abreviacao'] != '') {
                    $palavraAbreviacao = "|" . $_POST['abreviacao'];
                    file_put_contents('Abreviacoes.txt', str_replace(" ", " ", trim($palavraAbreviacao)), FILE_APPEND);
                    echo $palavraAbreviacao . " adicionado com sucesso!";
                }
            }
            ?>
        </div>
    </div>
    </div>
</body>
<footer>
    <?php include_once 'partials/footer.php'; ?>
</footer>

</html>