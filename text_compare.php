<!-- List compare versao 1.0 Por Johnny H. Kamigashima -->
<!-- Copyright 2021 -->
<!DOCTYPE html>

<html lang="pt-br">
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sessionEDuplo = (isset($_POST['espacoDuplo'])) ? 'checked' : '';
    $sessionECaixa =  (isset($_POST['caixaAlta'])) ? 'checked' : '';
    $sessionEbold =  (isset($_POST['bold'])) ? 'checked' : '';
    $sessionEponto =  (isset($_POST['pontofinal'])) ? 'checked' : '';
    $sessionESimbolos =  (isset($_POST['simbolos'])) ? 'checked' : '';
    $sessionDebug =  (isset($_POST['debug'])) ? 'checked' : '';
    $sessionEitalico =  (isset($_POST['italico'])) ? 'checked' : '';
    $sessionDoc = (isset($_POST['textDoc'])) ? $_POST['textDoc'] : '';
    $sessionArte = (isset($_POST['textArte'])) ? $_POST['textArte'] : '';
    $sessionRascunho = (isset($_POST['rascunho'])) ? $_POST['rascunho'] : '';
} else {
    $sessionDoc = $sessionArte = $sessionDebug = $sessionRascunho = $sessionEbold = $sessionEitalico = '';
    $sessionEDuplo = $sessionECaixa = $sessionEponto = $sessionESimbolos= 'checked';
}
?>

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8">
    <link rel="icon" type="image/png" href="./images/favicon.svg" />
    <!-- Latest compiled and minified CSS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.tiny.cloud/1/1hwzefvhux0zaed3wgjhtj8xrid32be83jl71noha1gb803t/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script type='text/javascript' src='partials/functions.js'></script>
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
            <div class="titulo p-2 m-2">
                Compara Textos
            </div>
            <form action="text_compare.php" method="post">
                <div class="row p-2">
                    <div class="col-md-6">
                        <span class="input-group-text textwrapper" id="inputGroup-sizing-default">
                            Textos do Documento:
                        </span>
                        <div class="textwrapper">
                            <textarea id='textDoc' name='textDoc'
                                style="width:100%"><?php echo $sessionDoc; ?></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <span class="input-group-text textwrapper" id="inputGroup-sizing-default">
                            Textos da Arte:
                        </span>
                        <div class="textwrapper">
                            <textarea id="textArte" name='textArte'
                                style="width:100%"><?php echo $sessionArte; ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="row p-2">
                    <div class="col-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="espacoDuplo" name="espacoDuplo"
                                value="<?php echo $sessionEDuplo; ?>" <?php echo $sessionEDuplo; ?>>
                            <label class="form-check-label" for="espacoDuplo">Ignorar espaços duplos</label>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="caixaAlta" name="caixaAlta"
                                value="<?php echo $sessionECaixa; ?>" <?php echo $sessionECaixa; ?>>
                            <label class="form-check-label" for="caixaAlta">Ignorar Maiúsculas</label>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="bold" name="bold"
                                value="<?php echo $sessionEbold; ?>" <?php echo $sessionEbold; ?>>
                            <label class="form-check-label" for="bold">Ignorar Bold</label>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="italico" name="italico"
                                value="<?php echo $sessionEitalico; ?>" <?php echo $sessionEitalico; ?>>
                            <label class="form-check-label" for="italico">Ignorar Itálico</label>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="pontofinal" name="pontofinal"
                                value="<?php echo $sessionEponto; ?>" <?php echo $sessionEponto; ?>>
                            <label class="form-check-label" for="pontofinal">Ignorar Pontos Finais</label>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="simbolos" name="simbolos"
                                value="<?php echo $sessionESimbolos; ?>" <?php echo $sessionESimbolos; ?>>
                            <label class="form-check-label" for="simbolos">Ignorar Símbolos</label>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="debug" name="debug"
                                value="<?php echo $sessionDebug; ?>" <?php echo $sessionDebug; ?>>
                            <label class="form-check-label" for="debug">Modo debug (dev)</label>
                        </div>
                    </div>
                </div>
                <div class="row p-3">
                    <input type="submit" id="comparar" value="Comparar (F5)" class="btn btn-success" />
                </div>
            </form>

            <script>
            // Roda a comparação com Ctrl-Enter ou F5
            document.addEventListener("keydown", comparar => {
                if ((comparar.key.toLowerCase() === "enter" && comparar.ctrlKey) || comparar.key
                    .toLowerCase() === "f5") {
                    document.getElementById("comparar").click();
                }
            })

            // inicia o pkugin TinyMCE Documento
            tinymce.init({
                selector: 'textarea#textDoc',
                plugins: 'searchreplace fullscreen wordcount visualchars autosave paste save table textpattern visualblocks',
                menubar: false,
                toolbar: 'bold italic fontsizeselect  paste pastetext searchreplace visualchars visualblocks spellchecker fullscreen table tabledelete | tableprops tablerowprops tablecellprops | tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol',
                toolbar_mode: 'floating',
                tinycomments_mode: 'embedded',
                tinycomments_author: 'Author name',
                height: 300,
                init_instance_callback: function(editor) {}
            });
            // Inicia o plugin TinyMCE da Arte
            tinymce.init({
                selector: 'textarea#textArte',
                plugins: 'searchreplace fullscreen wordcount visualchars autosave paste save table textpattern visualblocks',
                menubar: false,
                toolbar: 'bold italic fontsizeselect  paste pastetext searchreplace visualchars visualblocks spellchecker fullscreen table tabledelete | tableprops tablerowprops tablecellprops | tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol',
                toolbar_mode: 'floating',
                tinycomments_mode: 'embedded',
                tinycomments_author: 'Author name',
                height: 300,
                init_instance_callback: function(editor) {}
            });

            function updateValues() {
                <?php
                $sessionDoc = "<script>master.html.get()            
            </script>";
            $sessionArte = "<script>
            copy.html.get()
            </script>";
            ?>
            }
            </script>

            <?php

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                require('partials/functions.php');
                
                

                //Variables
                // var_dump($_POST['textDoc']);
                $textDoc = removeTags($_POST['textDoc']);
                $textArte = removeTags($_POST['textArte']);
                $faltaBOLD = $faltaItalic = $faltaCAIXA = array();
                $textCompara =
                    $textDocPalavras =
                    $textArtePalavras =
                    $textArteLinhasNovo =
                    $textDocLinhasNovo = array();
                $alterna = true;

                //Constants
                define('ENCODING',        'UTF-8');
                define("ATENCAO",         '880000');
                define("ALERTA",          'FF0000');
                define('UNIDADEMEDIDA',   '/\d+(cm|m|km|mcg|mg|g|kg|ml|l|cal|kcal)/i');
                define('TERMOSINVALIDOS', '/(\d+ |\d+)(CM|cM|Cm|mt|M|Mt|mT|KM|kM|MCG|Mcg|McG|mcG|MGc|MG|Mg|mG|G|GR|Gr|KG|Kg|kG|ML|Ml|CAL|Cal|CaL|cAL|caL|KCAL|Kcal|kCAL|kcAL|kcaL|KcaL|KCal|KcAL) /');
                define('BGCOLOR1',        '#faebd7');
                define('BGCOLOR2',        '#eddcc5');

                //Checa opçoes selecionadas
                if (isset($sessionEDuplo)) $espacoDuplo = ($sessionEDuplo == 'checked') ? true : false;
                else $espacoDuplo = false;
                if (isset($sessionECaixa)) $caixaAlta = ($sessionECaixa == 'checked') ? true : false;
                else $caixaAlta = false;
                if (isset($sessionEbold)) $bold = ($sessionEbold == 'checked') ? true : false;
                else $bold = false;
                if (isset($sessionEitalico)) $italico = ($sessionEitalico == 'checked') ? true : false;
                else $italico = false;
                if (isset($sessionEponto)) $pontoFinal = ($sessionEponto == 'checked') ? true : false;
                else $pontoFinal = false;
                if (isset($sessionESimbolos)) $simbolos = ($sessionESimbolos == 'checked') ? true : false;
                else $simbolos = false;
                if (isset($sessionDebug)) $debugMode = ($sessionDebug == 'checked') ? true : false;
                else $debugMode = false;

                // Limpeza inicial de Tags HTML
                $textDoc = limpaHtmlSpaceBreak($textDoc);
                $textArte = limpaHtmlSpaceBreak($textArte);

                //converte para Decodifica HTML
                require_once('partials/Encoding.php');
            
                $textDoc = html_entity_decode($textDoc);
                $textArte = html_entity_decode($textArte);
 
                //Verifica textos obrigatorios BOLD/Italic/Caixa alta
                if (!$bold) array_push($faltaBOLD, isNotTagged('fabricado', 'ltda', 'strong', $textArte));
                if (!$bold) array_push($faltaBOLD, isNotTagged('fabricado', 's.a.', 'strong', $textArte));
                if (!$bold) array_push($faltaBOLD, isNotTagged('importado', 'ltda', 'strong', $textArte));
                if (!$bold) array_push($faltaBOLD, isNotTagged('importado', 's.a.', 'strong', $textArte));
                if (!$bold) array_push($faltaBOLD, isNotTagged('(contém lactose|contém glúten|^ingredientes|^ingred|^ingr)', '', 'strong', $textArte));
                if (!$italico) array_push($faltaItalic, isNotTagged('trans', '', 'em', $textArte));
                array_push($faltaCAIXA, isCaixa('contém', '(glúten|lactose)', $textArte));

                // Limpa arrays vazios
                $faltaBOLD = array_filter($faltaBOLD);
                $faltaItalic = array_filter($faltaItalic);
                $faltaCAIXA = array_filter($faltaCAIXA);

                
                // Limpa sobras de formatação Html
                $textDoc = limpaSujeiraHtml($textDoc);
                $textArte = limpaSujeiraHtml($textArte);
                
                //ignora pontos finais
                $textDoc = ($pontoFinal) ? limpaPontofinal($textDoc) : $textDoc;
                $textArte = ($pontoFinal) ? limpaPontofinal($textArte) : $textArte;
                
                //ignora simbolos
                $textDoc = ($simbolos) ? limpaSimbolos($textDoc) : $textDoc;
                $textArte= ($simbolos) ? limpaSimbolos($textArte):$textArte;
                
                // Remove Bolds antes de checar
                $textDoc = ($bold) ? removeBold($textDoc) : $textDoc;
                $textArte = ($bold) ? removebold($textArte) : $textArte;

                // Remove Italico antes de checar
                $textDoc = ($italico) ? removeItalico($textDoc) : $textDoc;
                $textArte = ($italico) ? removeItalico($textArte) : $textArte;

                // Substitui espaços duplos por espaços simples
                $textDoc = ($espacoDuplo) ? removeEspacoduplo($textDoc) : $textDoc;
                $textArte = ($espacoDuplo) ? removeEspacoduplo($textArte) : $textArte;

                $textDoc = \ForceUTF8\Encoding::fixUTF8($textDoc);
                $textArte = \ForceUTF8\Encoding::fixUTF8($textArte);


                // converte texto para array dividido por linhas
                $textDocLinhas = explode('|', $textDoc);
                $textArteLinhas = explode('|', $textArte);

                // Verifica possiveis erros
                $unidadeMedidaEspaco = preg_grep(UNIDADEMEDIDA, $textArteLinhas);
                $unidadeMedidaCaixa = preg_grep(TERMOSINVALIDOS, $textArteLinhas);

                // remove sapaço em branco antes e depois de cada linha
                $textDocLinhas = array_map('trim', $textDocLinhas);
                $textArteLinhas = array_map('trim', $textArteLinhas);

                // remove linhas vazias no array
                $textDocLinhas = array_filter($textDocLinhas);
                $textArteLinhas = array_filter($textArteLinhas);

                // remove linhas repetidas no array
                $textDocLinhas = array_unique($textDocLinhas);
                $textArteLinhas = array_unique($textArteLinhas);

                // Mostra no Console os textos para encontrar falhas na conversao
                if ($debugMode) {
                    echo 'Texto documento:<br>';
                    debug($textDoc);
                    echo '<br><br>Texto arte:<br>';
                    debug($textArte);
                }

                // Compara linha por linha
                foreach ($textDocLinhas as $indiceDoc => $docLinha) {
                    foreach ($textArteLinhas as $indiceArte => $arteLinha) {
                        if ($caixaAlta) {
                            $caixaArte = mb_strtoupper($arteLinha, ENCODING);
                            $caixaDoc = mb_strtoupper($docLinha, ENCODING);
                        } else {
                            $caixaArte = $arteLinha;
                            $caixaDoc = $docLinha;
                        }
                        if ($caixaArte == $caixaDoc) {
                            if ($caixaDoc != '') array_push($textCompara, $arteLinha);
                            unset($textDocLinhas[$indiceDoc]);
                            unset($textArteLinhas[$indiceArte]);
                            break;
                        }
                    }
                }

                // compara palavra por palavra
                foreach ($textDocLinhas as $cadalinha) array_push($textDocPalavras, explode(' ', $cadalinha));
                foreach ($textArteLinhas as $cadalinha) array_push($textArtePalavras, explode(' ', $cadalinha));
                foreach ($textDocPalavras as $indicePalavraDoc => $palavrasDoc) {
                    $palavrasIguais = array();

                    // joga palavras iguais numa array para ver qual linha tem mais repeticoes
                    foreach ($textArtePalavras as $indicePalavraArte => $palavrasArte) {
                        $difNumPalavras = 9999 - abs(count($palavrasDoc) - count($palavrasArte));
                        $correspond = true;
                        if (abs(count($palavrasDoc) - count($palavrasArte)) > (count($palavrasDoc) / 3)) $correspond = false;
                        if ($caixaAlta) array_push($palavrasIguais, [$difNumPalavras, count(descomparaArrays($palavrasDoc, $palavrasArte, $caixaAlta)), $indicePalavraDoc, $indicePalavraArte, $correspond]);
                        else array_push($palavrasIguais, [$difNumPalavras, count(descomparaArrays($palavrasDoc, $palavrasArte, $caixaAlta)), $indicePalavraDoc, $indicePalavraArte, $correspond]);
                    }
                    rsort($palavrasIguais); //coloca em ordem decrescente para que a linha com mais repeticoes seja a primeira

                    if (isset($palavrasIguais[0][1]) && $palavrasIguais[0][1] > 1 && $palavrasIguais[0][4] == true) {
                        $difdeDoc = comparaArrays($textDocPalavras[$palavrasIguais[0][2]], $textArtePalavras[$palavrasIguais[0][3]], $caixaAlta);
                        $difdeArte = comparaArrays($textArtePalavras[$palavrasIguais[0][3]], $textDocPalavras[$palavrasIguais[0][2]], $caixaAlta);
                        array_push($textDocLinhasNovo, frasesDiff($textDocPalavras[$palavrasIguais[0][2]], $textArtePalavras[$palavrasIguais[0][3]], $caixaAlta, ALERTA, ATENCAO));
                        array_push($textArteLinhasNovo, frasesDiff($textArtePalavras[$palavrasIguais[0][3]], $textDocPalavras[$palavrasIguais[0][2]], $caixaAlta, ALERTA, ATENCAO));
                        unset($textDocPalavras[$palavrasIguais[0][2]]);
                        unset($textArtePalavras[$palavrasIguais[0][3]]);
                    }
                }

                while (count($textDocLinhasNovo) < count($textArteLinhasNovo)) {
                    array_push($textDocLinhasNovo, array(''));
                }

                // Mostra Resultados de textos legais
                echo ' <div class="container p-6 m-0">';
                if (isset($unidadeMedidaEspaco) && count($unidadeMedidaEspaco) > 0) {
                    echo '<hr>';
                    echo "<h5 style='width: 100%;display: flex;margin: auto;justify-content: center'>Unidades de medida sem espaço: </h5>";
                    echo "<strong style='color:#" . ATENCAO . "'>";
                    foreach ($unidadeMedidaEspaco as $erro) echo "<br><h7>" .  $erro . "</h7><br>";
                    echo "</strong>";
                }
                if (isset($unidadeMedidaCaixa) && count($unidadeMedidaCaixa) > 0) {
                    echo "<br><h6 style='width: 100%;display: flex;margin: auto;justify-content: center'>Unidades de medida com escrita errada: </h6>";
                    echo "<strong style='color:#" . ATENCAO . "'>";
                    foreach ($unidadeMedidaCaixa as $erro) echo "<br><h7>" .  $erro . "</h7><br>";
                    echo "</strong>";
                }
                if (count($faltaBOLD) > 0) {
                    echo '<hr style="width:100%;text-align:center;margin-left:auto">';
                    echo '<h5 style="width: 100%;display: flex;margin: auto;justify-content: center">Atenção a estas frases que não estão em BOLD:</h5><br>';
                    foreach ($faltaBOLD as $lin) echo "<br><h7>$lin</h7>";
                }
                if (count($faltaItalic) > 0) {
                    echo '<hr style="width:100%;text-align:center;margin-left:auto">';
                    echo '<h5 style="width: 100%;display: flex;margin: auto;justify-content: center">Atenção a estas palavras que não estão em Itálico:</h5><br>';
                    foreach ($faltaItalic as $lin) echo "<br><h7>$lin</h7>";
                }
                if (count($faltaCAIXA) > 0) {
                    echo '<hr style="width:100%;text-align:center;margin-left:auto">';
                    echo '<h5 style="width: 100%;display: flex;margin: auto;justify-content: center">Atenção a estas palavras que não estão em CAIXA ALTA:</h5><br>';
                    foreach ($faltaCAIXA as $lin) echo "<br><h7>$lin</h7>";
                }

                // Mostra resultados da comparação de paragrafos
                echo '<hr>';
                if (isset($textCompara)) {
                    echo '<br><h5 style="width: 100%;display: flex;margin: auto;justify-content: center">' . count($textCompara) . ' parágrafos correspondem.</h5><br>';
                    echo '</div>';
                    echo '<div class="row p-3 m-0">';
                    echo '<div class="col-md-12 m-0">';
                    foreach ($textCompara as $showtextOK) echo "<br>$showtextOK";
                    echo '</div></div>';
                }

                //Mostra resultados que parecem que estão errados
                if ((isset($textDocLinhasNovo) && count($textDocLinhasNovo) > 0) || (isset($textArteLinhasNovo) && count($textArteLinhasNovo) > 0) || max(count($textDocPalavras), count($textArtePalavras)) > 0) {
                    echo '<div class="row p-3 m-0">';
                    echo '<div class="col-md-6">';
                    echo '<h5>Os ' . (count_valid($textDocLinhasNovo) + count_valid($textDocPalavras)) . '/' . (count_valid($textDocLinhasNovo) + count_valid($textCompara) + count_valid($textDocPalavras)) . ' parágrafos não correspondentes<br>no Documento são:</h5><br>';
                    echo '</div>';
                    echo '<div class="col-md-6">';
                    echo '<h5>Os ' . (count_valid($textArteLinhasNovo) + count_valid($textArtePalavras))  . '/' . (count_valid($textArteLinhasNovo) + count_valid($textCompara) + count_valid($textArtePalavras)) .  ' parágrafos não correspondentes<br>na Arte são:</h5><br>';
                    echo '</div>';
                    echo '</div>';
                    echo '<br>';

                    for ($item = 0; $item < max(count_valid($textDocLinhasNovo), count_valid($textArteLinhasNovo)); $item++) { {
                            if ($alterna) echo '<div class="row p-3 m-0" style="background-color:' . BGCOLOR1 . '">';
                            else echo '<div class="row p-3 m-0" style="background-color:' . BGCOLOR2 . '">';
                            $alterna = !$alterna;
                            echo '<div class="col-md-6">';
                            foreach ($textDocLinhasNovo[$item] as $textResult) echo $textResult . ' ';
                            echo '</div>';
                            echo '<div class="col-md-6">';
                            foreach ($textArteLinhasNovo[$item] as $textResult) echo $textResult . ' ';
                            echo '</div></div>';
                        }
                    }
                }
                // Mostra resultados não encontrados
                for ($coincidencias = 100; $coincidencias >= 0; $coincidencias--) {

                    foreach (frasesMaisSemelhantes($textDocPalavras, $textArtePalavras, $coincidencias) as $result) {
                        if ($alterna) echo '<div class="row p-3 m-0" style="background-color:' . BGCOLOR1 . '">';
                        else echo '<div class="row p-3 m-0" style="background-color:' . BGCOLOR2 . '">';
                        $alterna = !$alterna;
                        echo '<div class="col-md-6">';
                        echo "<text style='color:#" . ALERTA . "'>";
                        echo $result[0] . ' ';
                        echo "</text>";
                        echo '</div>';
                        echo '<div class="col-md-6">';
                        echo "<text style='color:#" . ALERTA . "'>";
                        echo $result[1] . ' ';
                        echo "</text>";
                        echo '</div>';
                        echo '</div>';
                    }
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