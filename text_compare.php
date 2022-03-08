<div class="row">
    <?php
    include_once 'partials/header.php';
    ?>
</div>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
    
    $sessionEDuplo = (isset($_POST['espacoDuplo'])) ? $_POST['espacoDuplo'] : 'checked';
    $sessionEArte = (isset($_POST['caixaAlta'])) ? $_POST['caixaAlta'] : 'checked';
    $sessionDoc = (isset($_POST['textDoc']))?$_POST['textDoc']:'';
    $sessionArte = (isset($_POST['textArte']))?$_POST['textArte']:'';

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
            Compara Textos
        </div>
        <form action="text_compare.php" method="post">
            <div class="input-group">
                <div class="col-md-6">
                    <span class="input-group-text textwrapper" id="inputGroup-sizing-default">
                        Textos do Documento:
                    </span>
                    <div class="textwrapper">
                        <textarea rows="30" cols="50" name="textDoc" style="width:100%"><?php echo $sessionDoc; ?></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <span class="input-group-text textwrapper" id="inputGroup-sizing-default">
                        Textos da Arte:
                    </span>
                    <div class="textwrapper">
                        <textarea rows="30" cols="50" name="textArte" style="width:100%"><?php echo $sessionArte; ?></textarea>
                    </div>
                </div>

                <div class="form-check ml-3">

                    <input class="form-check-input" type="checkbox" id="espacoDuplo" name="espacoDuplo" value="checked" <?php echo $sessionEDuplo; ?>>
                    <label class="form-check-label" for="espacoDuplo">Ignorar espaços duplos</label>
                </div>
                <div class="form-check ml-3">

                    <input class="form-check-input" type="checkbox" id="caixaAlta" name="caixaAlta" value="checked" <?php echo $sessionEArte; ?>>
                    <label class="form-check-label" for="caixaAlta">Ignorar Maiúsculas</label>
                </div>
                <!-- <div class="form-check ml-3">

            <input class="form-check-input" type="checkbox" id="espacoDuplo" name="espacoDuplo" value="" checked>
            <label class="form-check-label" for="espacoDuplo">Ignorar espaços duplos</label>
        </div>
        <div class="form-check ml-3">

            <input class="form-check-input" type="checkbox" id="espacoDuplo" name="espacoDuplo" value="" checked>
            <label class="form-check-label" for="espacoDuplo">Ignorar espaços duplos</label>
        </div>
        </div> -->

            </div>
            <div class="container p-3">

                <input type="submit" value="Comparar" class="btn btn-success" />
            </div>
        </form>
        <?php

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $textDoc = $_POST['textDoc'];
            $textArte = $_POST['textArte'];
            $textDoc = preg_replace("/\t/", " ", $textDoc);
            $textArte = preg_replace("/\t/", " ", $textArte);

            if (isset($_POST['espacoDuplo'])) $espacoDuplo = ($_POST['espacoDuplo'] == 'checked') ? true : false;
            else $espacoDuplo = false;
            if (isset($_POST['caixaAlta'])) $caixaAlta = ($_POST['caixaAlta'] == 'checked') ? true : false;
            else $caixaAlta = false;

            // Substitui espaços duplos por espaços simples
            if ($espacoDuplo) {
                $textDoc = preg_replace("/ +/", " ", $textDoc);
                $textArte = preg_replace("/ +/", " ", $textArte);
            }

            // troca quebras de linha, quebras de linha dupla e espaço no final da linha por pipes
            $replaceChars = array();
            $replaceChars[0] = [
                "/(\r+|\n+| \n+|\|+)/",
                "/\|+/",
                "/\//", "/\*/", "/\(/", "/\)/"
            ];
            $replaceChars[1] = [
                "|",
                "|",
                "\/", "\*", "\(", "\)"
            ];
            $replaceChars[2] = [
                "\n",
                "\n",
                "/", "*", "(", ")"
            ];
            $textDoc = preg_replace($replaceChars[0], $replaceChars[1], $textDoc);
            $textArte = preg_replace($replaceChars[0], $replaceChars[1], $textArte);

            // converte texto para array dividido por linhas
            $textDocLinhas = explode('|', $textDoc);
            $textArteLinhas = explode('|', $textArte);

            // Verifica possiveis erros
            $unidadeMedida = '/\d+(cm|m|km|mcg|mg|g|kg|ml|l|cal|kcal)/i';
            $termosInvalidos = '/(\d+ |\d+)(CM|cM|Cm|mt|M|Mt|mT|KM|kM|MCG|Mcg|McG|mcG|MGc|MG|Mg|mG|G|GR|Gr|KG|Kg|kG|ML|Ml|CAL|Cal|CaL|cAL|caL|KCAL|Kcal|kCAL|kcAL|kcaL|KcaL|KCal|KcAL) /';
            $unidadeMedidaEspaco = preg_grep($unidadeMedida, $textArteLinhas);
            $unidadeMedidaCaixa = preg_grep($termosInvalidos, $textArteLinhas);


            // remove sapaço em branco antes e depois de cada linha
            $textDocLinhas = array_map('trim', $textDocLinhas);
            $textArteLinhas = array_map('trim', $textArteLinhas);

            // remove linhas vazias no array
            $textDocLinhas = array_filter($textDocLinhas);
            $textArteLinhas = array_filter($textArteLinhas);

            $textCompara = array();
            $atencao = 'color:#880000';
            $alerta = 'color:#FF0000';

            // Compara linha por linha
            foreach ($textDocLinhas as $docLinha) {
                foreach ($textArteLinhas as $arteLinha) {
                    $pattern = ($caixaAlta) ? '/i' : '/';

                    // if (preg_match('/' . $docLinha . $pattern, $arteLinha)) {
                    // if (($caixaAlta) ? strpos(strtoupper($arteLinha),  strtoupper($docLinha)) > -1 : strpos($arteLinha, $docLinha) > -1 ) {
                        
                    if (strpos(strtoupper($arteLinha),  strtoupper($docLinha)) > -1 && strpos(strtoupper($docLinha), strtoupper($arteLinha)) > -1) {
                        // echo '<br>' . $arteLinha . ' = ' . $docLinha;
                        if ($docLinha != '') array_push($textCompara, $arteLinha);
                            array_splice($textDocLinhas, array_search($docLinha, $textDocLinhas), 1);
                            array_splice($textArteLinhas, array_search($arteLinha, $textArteLinhas), 1);
                    }
                }
            }
            // compara palavra por palavra
            $textDocPalavras = array();
            $textArtePalavras = array();
            $textArteLinhasNovo = array();
            $textDocLinhasNovo = array();

            foreach ($textDocLinhas as $cadalinha)      array_push($textDocPalavras, explode(' ', $cadalinha));
            foreach ($textArteLinhas as $cadalinha)        array_push($textArtePalavras, explode(' ', $cadalinha));


            foreach ($textDocPalavras as $indicePalavraDoc => $palavrasDoc) {
                foreach ($textArtePalavras as $indicePalavraArte => $palavrasArte) {

                    $repeticoes = 0;
                    foreach ($palavrasDoc as $palDoc) {
                        foreach ($palavrasArte as $palArte) {

                            if (strtolower($palDoc) == strtolower($palArte)) {
                                $repeticoes++;
                                break;
                            }
                        }
                    }

                    if ($repeticoes >= count($palavrasDoc) * 0.66) {
                        if ($caixaAlta) {
                            $difDoc = array_diff(array_map('strtoupper', $textDocPalavras[$indicePalavraDoc]), array_map('strtoupper', $textArtePalavras[$indicePalavraArte]));
                            $difArte = array_diff(array_map('strtoupper', $textArtePalavras[$indicePalavraArte]), array_map('strtoupper', $textDocPalavras[$indicePalavraDoc]));
                        } else {
                            $difDoc = array_diff($textDocPalavras[$indicePalavraDoc], $textArtePalavras[$indicePalavraArte]);
                            $difArte = array_diff($textArtePalavras[$indicePalavraArte], $textDocPalavras[$indicePalavraDoc]);
                        }
                        if ($caixaAlta) {
                            $indiceTemp = -1;
                            foreach ($difDoc as $keyDifDoc => $difDocPalavra) {
                                $ultimoElemento = count($textDocLinhasNovo) - 1;
                                $textPalAntDoc = isset($textDocPalavras[$indicePalavraDoc][$keyDifDoc - 1]) ? $textDocPalavras[$indicePalavraDoc][$keyDifDoc - 1] : '';
                                $textPalProxDoc = isset($textDocPalavras[$indicePalavraDoc][$keyDifDoc + 1]) ? $textDocPalavras[$indicePalavraDoc][$keyDifDoc + 1] : '';
                                $textPalAntArte = isset($textArtePalavras[$indicePalavraArte][$keyDifDoc - 1]) ? $textArtePalavras[$indicePalavraArte][$keyDifDoc - 1] : '';
                                $textPalProxArte = isset($textArtePalavras[$indicePalavraArte][$keyDifDoc + 1]) ? $textArtePalavras[$indicePalavraArte][$keyDifDoc + 1] : '';
                                if ($indiceTemp == $indicePalavraDoc) {
                                    if ($textPalAntDoc == $textPalAntArte && $textPalProxDoc == $textPalProxArte)
                                        $textDocLinhasNovo[$ultimoElemento] = str_ireplace($textPalAntDoc . ' ' . $difDocPalavra . ' ' . $textPalProxDoc, "<text style=$atencao>" . $textPalAntDoc . "</text> <strong style=$alerta>" . $difDocPalavra . "</strong> <text style=$atencao>" . $textPalProxDoc . '</text>', $textDocLinhasNovo[$ultimoElemento]);
                                    elseif ($textPalAntDoc == $textPalAntArte)
                                        $textDocLinhasNovo[$ultimoElemento] = str_ireplace($textPalAntDoc . ' ' . $difDocPalavra, "<text style=$atencao>" . $textPalAntDoc . "</text> <strong style=$alerta>" . $difDocPalavra . '</strong>', $textDocLinhasNovo[$ultimoElemento]);
                                    elseif ($textPalProxDoc == $textPalProxArte)
                                        $textDocLinhasNovo[$ultimoElemento] = str_ireplace($difDocPalavra . ' ' . $textPalProxDoc, "<strong style=$alerta>" . $difDocPalavra . "</strong> <text style=$atencao>" . $textPalProxDoc . '</text>', $textDocLinhasNovo[$ultimoElemento]);
                                    else
                                        $textDocLinhasNovo[$ultimoElemento] = str_ireplace($textPalAntDoc . ' ' . $difDocPalavra . ' ' . $textPalProxDoc, "<strong style=$alerta>" . $textPalAntDoc . " " . $difDocPalavra . " " . $textPalProxDoc . '</strong>', $textDocLinhasNovo[$ultimoElemento]);
                                } else {
                                    if ($textPalAntDoc == $textPalAntArte && $textPalProxDoc == $textPalProxArte) {
                                        array_push($textDocLinhasNovo, str_ireplace($textPalAntDoc . ' ' . $difDocPalavra . ' ' . $textPalProxDoc, "<text style=$atencao>" . $textPalAntDoc . "</text> <strong style=$alerta>" . $difDocPalavra . "</strong> <text style=$atencao>" . $textPalProxDoc . '</text>', $textDocLinhas[$indicePalavraDoc]));
                                        unset($textDocLinhas[$indicePalavraDoc]);
                                    } elseif ($textPalAntDoc == $textPalAntArte) {
                                        array_push($textDocLinhasNovo, str_ireplace($textPalAntDoc . ' ' . $difDocPalavra, "<text style=$atencao>" . $textPalAntDoc . "</text> <strong style=$alerta>" . $difDocPalavra . '</strong>', $textDocLinhas[$indicePalavraDoc]));
                                        unset($textDocLinhas[$indicePalavraDoc]);
                                    } elseif ($textPalProxDoc == $textPalProxArte) {
                                        array_push($textDocLinhasNovo, str_ireplace($difDocPalavra . ' ' . $textPalProxDoc, "<strong style=$alerta>" . $difDocPalavra . "</strong> <text style=$atencao>" . $textPalProxDoc . '</text>', $textDocLinhas[$indicePalavraDoc]));
                                        unset($textDocLinhas[$indicePalavraDoc]);
                                    } else {
                                        array_push($textDocLinhasNovo, str_ireplace($textPalAntDoc . ' ' . $difDocPalavra . ' ' . $textPalProxDoc, "<strong style=$alerta>" . $textPalAntDoc . " " . $difDocPalavra . " " . $textPalProxDoc . '</strong>', $textDocLinhas[$indicePalavraDoc]));
                                        unset($textDocLinhas[$indicePalavraDoc]);
                                    }
                                    $indiceTemp = $indicePalavraDoc;
                                }
                            }
                            $indiceTemp = -1;
                            foreach ($difArte as $keyDifArte => $difArtePalavra) {
                                $ultimoElemento = count($textArteLinhasNovo) - 1;
                                $textPalAntDoc = isset($textDocPalavras[$indicePalavraDoc][$keyDifArte - 1]) ? $textDocPalavras[$indicePalavraDoc][$keyDifArte - 1] : '';
                                $textPalProxDoc = isset($textDocPalavras[$indicePalavraDoc][$keyDifArte + 1]) ? $textDocPalavras[$indicePalavraDoc][$keyDifArte + 1] : '';
                                $textPalAntArte = isset($textArtePalavras[$indicePalavraArte][$keyDifArte - 1]) ? $textArtePalavras[$indicePalavraArte][$keyDifArte - 1] : '';
                                $textPalProxArte = isset($textArtePalavras[$indicePalavraArte][$keyDifArte + 1]) ? $textArtePalavras[$indicePalavraArte][$keyDifArte + 1] : '';
                                if ($indiceTemp == $indicePalavraArte) {
                                    if ($textPalAntDoc == $textPalAntArte && $textPalProxDoc == $textPalProxArte)
                                        $textArteLinhasNovo[$ultimoElemento] = str_ireplace($textPalAntArte . ' ' . $difArtePalavra . ' ' . $textPalProxArte, "<text style=$atencao>" . $textPalAntArte . "</text> <strong style=$alerta>" . $difArtePalavra . "</strong> <text style=$atencao>" . $textPalProxArte . '</text>', $textArteLinhasNovo[$ultimoElemento]);
                                    elseif ($textPalAntArte == $textPalAntDoc)
                                        $textArteLinhasNovo[$ultimoElemento] = str_ireplace($textPalAntArte . ' ' . $difArtePalavra, "<text style=$atencao>" . $textPalAntArte . "</text> <strong style=$alerta>" . $difArtePalavra . '</strong>', $textArteLinhasNovo[$ultimoElemento]);
                                    elseif ($textPalProxArte == $textPalProxDoc)
                                        $textArteLinhasNovo[$ultimoElemento] = str_ireplace($difArtePalavra . ' ' . $textPalProxArte, "<strong style=$alerta>" . $difArtePalavra . "</strong> <text style=$atencao>" . $textPalProxArte . '</text>', $textArteLinhasNovo[$ultimoElemento]);
                                    else
                                        $textArteLinhasNovo[$ultimoElemento] = str_ireplace($textPalAntArte . ' ' . $difArtePalavra . ' ' . $textPalProxArte, "<strong style=$alerta>" . $textPalAntArte . " " . $difArtePalavra . " " . $textPalProxArte . '</strong>', $textArteLinhasNovo[$ultimoElemento]);
                                } else {
                                    if ($textPalAntArte == $textPalAntDoc && $textPalProxArte == $textPalProxDoc && isset($textArteLinhas[$indicePalavraArte])) {
                                        array_push($textArteLinhasNovo, str_ireplace($textPalAntArte . ' ' . $difArtePalavra . ' ' . $textPalProxArte, "<text style=$atencao>" . $textPalAntArte . "</text> <strong style=$alerta>" . $difArtePalavra . "</strong> <text style=$atencao>" . $textPalProxArte . '</text>', $textArteLinhas[$indicePalavraArte]));
                                        unset($textArteLinhas[$indicePalavraArte]);
                                    } elseif ($textPalAntArte == $textPalAntDoc &&  isset($textArteLinhas[$indicePalavraArte])) {
                                        array_push($textArteLinhasNovo, str_ireplace($textPalAntArte . ' ' . $difArtePalavra, "<text style=$atencao>" . $textPalAntArte . "</text> <strong style=$alerta>" . $difArtePalavra . '</strong>', $textArteLinhas[$indicePalavraArte]));
                                        unset($textArteLinhas[$indicePalavraArte]);
                                    } elseif ($textPalProxArte == $textPalProxDoc && isset($textArteLinhas[$indicePalavraArte])) {
                                        array_push($textArteLinhasNovo, str_ireplace($difArtePalavra . ' ' . $textPalProxArte, "<strong style=$alerta>" . $difArtePalavra . "</strong> <text style=$atencao>" . $textPalProxArte . '</text>', $textArteLinhas[$indicePalavraArte]));
                                        unset($textArteLinhas[$indicePalavraArte]);
                                    } else {
                                        array_push($textArteLinhasNovo, str_ireplace($textPalAntArte . ' ' . $difArtePalavra . ' ' . $textPalProxArte, "<strong style=$alerta>" . $textPalAntArte . " " . $difArtePalavra . " " . $textPalProxArte . '</strong>', $textArteLinhas[$indicePalavraArte]));
                                        unset($textArteLinhas[$indicePalavraArte]);
                                    }
                                    $indiceTemp = $indicePalavraArte;
                                }
                            }
                        } else {
                            $indiceTemp = -1;
                            foreach ($difDoc as $keyDifDoc => $difDocPalavra) {
                                $ultimoElemento = count($textDocLinhasNovo) - 1;
                                $textPalAntDoc = isset($textDocPalavras[$indicePalavraDoc][$keyDifDoc - 1]) ? $textDocPalavras[$indicePalavraDoc][$keyDifDoc - 1] : '';
                                $textPalProxDoc = isset($textDocPalavras[$indicePalavraDoc][$keyDifDoc + 1]) ? $textDocPalavras[$indicePalavraDoc][$keyDifDoc + 1] : '';
                                $textPalAntArte = isset($textArtePalavras[$indicePalavraArte][$keyDifDoc - 1]) ? $textArtePalavras[$indicePalavraArte][$keyDifDoc - 1] : '';
                                $textPalProxArte = isset($textArtePalavras[$indicePalavraArte][$keyDifDoc + 1]) ? $textArtePalavras[$indicePalavraArte][$keyDifDoc + 1] : '';
                                if ($indiceTemp == $indicePalavraDoc) {
                                    if ($textPalAntDoc == $textPalAntArte && $textPalProxDoc == $textPalProxArte)
                                        $textDocLinhasNovo[$ultimoElemento] = str_replace($textPalAntDoc . ' ' . $difDocPalavra . ' ' . $textPalProxDoc, "<text style=$atencao>" . $textPalAntDoc . "</text> <strong style=$alerta>" . $difDocPalavra . "</strong> <text style=$atencao>" . $textPalProxDoc . '</text>', $textDocLinhasNovo[$ultimoElemento]);
                                    elseif ($textPalAntDoc == $textPalAntArte)
                                        $textDocLinhasNovo[$ultimoElemento] = str_replace($textPalAntDoc . ' ' . $difDocPalavra, "<text style=$atencao>" . $textPalAntDoc . "</text> <strong style=$alerta>" . $difDocPalavra . '</strong>', $textDocLinhasNovo[$ultimoElemento]);
                                    elseif ($textPalProxDoc == $textPalProxArte)
                                        $textDocLinhasNovo[$ultimoElemento] = str_replace($difDocPalavra . ' ' . $textPalProxDoc, "<strong style=$alerta>" . $difDocPalavra . "</strong> <text style=$atencao>" . $textPalProxDoc . '</text>', $textDocLinhasNovo[$ultimoElemento]);
                                    else
                                        $textDocLinhasNovo[$ultimoElemento] = str_replace($textPalAntDoc . ' ' . $difDocPalavra . ' ' . $textPalProxDoc, "<strong style=$alerta>" . $textPalAntDoc . " " . $difDocPalavra . " " . $textPalProxDoc . '</strong>', $textDocLinhasNovo[$ultimoElemento]);
                                } else {
                                    if ($textPalAntDoc == $textPalAntArte && $textPalProxDoc == $textPalProxArte) {
                                        array_push($textDocLinhasNovo, str_replace($textPalAntDoc . ' ' . $difDocPalavra . ' ' . $textPalProxDoc, "<text style=$atencao>" . $textPalAntDoc . "</text> <strong style=$alerta>" . $difDocPalavra . "</strong> <text style=$atencao>" . $textPalProxDoc . '</text>', $textDocLinhas[$indicePalavraDoc]));
                                        unset($textDocLinhas[$indicePalavraDoc]);
                                    } elseif ($textPalAntDoc == $textPalAntArte) {
                                        array_push($textDocLinhasNovo, str_replace($textPalAntDoc . ' ' . $difDocPalavra, "<text style=$atencao>" . $textPalAntDoc . "</text> <strong style=$alerta>" . $difDocPalavra . '</strong>', $textDocLinhas[$indicePalavraDoc]));
                                        unset($textDocLinhas[$indicePalavraDoc]);
                                    } elseif ($textPalProxDoc == $textPalProxArte) {
                                        array_push($textDocLinhasNovo, str_replace($difDocPalavra . ' ' . $textPalProxDoc, "<strong style=$alerta>" . $difDocPalavra . "</strong> <text style=$atencao>" . $textPalProxDoc . '</text>', $textDocLinhas[$indicePalavraDoc]));
                                        unset($textDocLinhas[$indicePalavraDoc]);
                                    } else {
                                        array_push($textDocLinhasNovo, str_replace($textPalAntDoc . ' ' . $difDocPalavra . ' ' . $textPalProxDoc, "<strong style=$alerta>" . $textPalAntDoc . " " . $difDocPalavra . " " . $textPalProxDoc . '</strong>', $textDocLinhas[$indicePalavraDoc]));
                                        unset($textDocLinhas[$indicePalavraDoc]);
                                    }
                                    $indiceTemp = $indicePalavraDoc;
                                }
                            }
                            $indiceTemp = -1;
                            foreach ($difArte as $keyDifArte => $difArtePalavra) {
                                $ultimoElemento = count($textArteLinhasNovo) - 1;
                                $textPalAntDoc = isset($textDocPalavras[$indicePalavraDoc][$keyDifArte - 1]) ? $textDocPalavras[$indicePalavraDoc][$keyDifArte - 1] : '';
                                $textPalProxDoc = isset($textDocPalavras[$indicePalavraDoc][$keyDifArte + 1]) ? $textDocPalavras[$indicePalavraDoc][$keyDifArte + 1] : '';
                                $textPalAntArte = isset($textArtePalavras[$indicePalavraArte][$keyDifArte - 1]) ? $textArtePalavras[$indicePalavraArte][$keyDifArte - 1] : '';
                                $textPalProxArte = isset($textArtePalavras[$indicePalavraArte][$keyDifArte + 1]) ? $textArtePalavras[$indicePalavraArte][$keyDifArte + 1] : '';
                                if ($indiceTemp == $indicePalavraArte) {
                                    if ($textPalAntDoc == $textPalAntArte && $textPalProxDoc == $textPalProxArte)
                                        $textArteLinhasNovo[$ultimoElemento] = str_replace($textPalAntArte . ' ' . $difArtePalavra . ' ' . $textPalProxArte, "<text style=$atencao>" . $textPalAntArte . "</text> <strong style=$alerta>" . $difArtePalavra . "</strong> <text style=$atencao>" . $textPalProxArte . '</text>', $textArteLinhasNovo[$ultimoElemento]);
                                    elseif ($textPalAntArte == $textPalAntDoc)
                                        $textArteLinhasNovo[$ultimoElemento] = str_replace($textPalAntArte . ' ' . $difArtePalavra, "<text style=$atencao>" . $textPalAntArte . "</text> <strong style=$alerta>" . $difArtePalavra . '</strong>', $textArteLinhasNovo[$ultimoElemento]);
                                    elseif ($textPalProxArte == $textPalProxDoc)
                                        $textArteLinhasNovo[$ultimoElemento] = str_replace($difArtePalavra . ' ' . $textPalProxArte, "<strong style=$alerta>" . $difArtePalavra . "</strong> <text style=$atencao>" . $textPalProxArte . '</text>', $textArteLinhasNovo[$ultimoElemento]);
                                    else
                                        $textArteLinhasNovo[$ultimoElemento] = str_replace($textPalAntArte . ' ' . $difArtePalavra . ' ' . $textPalProxArte, "<strong style=$alerta>" . $textPalAntArte . " " . $difArtePalavra . " " . $textPalProxArte . '</strong>', $textArteLinhasNovo[$ultimoElemento]);
                                } else {
                                    if ($textPalAntArte == $textPalAntDoc && $textPalProxArte == $textPalProxDoc) {
                                        array_push($textArteLinhasNovo, str_replace($textPalAntArte . ' ' . $difArtePalavra . ' ' . $textPalProxArte, "<text style=$atencao>" . $textPalAntArte . "</text> <strong style=$alerta>" . $difArtePalavra . "</strong> <text style=$atencao>" . $textPalProxArte . '</text>', $textArteLinhas[$indicePalavraArte]));
                                        unset($textArteLinhas[$indicePalavraArte]);
                                    } elseif ($textPalAntArte == $textPalAntDoc) {
                                        array_push($textArteLinhasNovo, str_replace($textPalAntArte . ' ' . $difArtePalavra, "<text style=$atencao>" . $textPalAntArte . "</text> <strong style=$alerta>" . $difArtePalavra . '</strong>', $textArteLinhas[$indicePalavraArte]));
                                        unset($textArteLinhas[$indicePalavraArte]);
                                    } elseif ($textPalProxArte == $textPalProxDoc) {
                                        array_push($textArteLinhasNovo, str_replace($difArtePalavra . ' ' . $textPalProxArte, "<strong style=$alerta>" . $difArtePalavra . "</strong> <text style=$atencao>" . $textPalProxArte . '</text>', $textArteLinhas[$indicePalavraArte]));
                                        unset($textArteLinhas[$indicePalavraArte]);
                                    } else {
                                        array_push($textArteLinhasNovo, str_replace($textPalAntArte . ' ' . $difArtePalavra . ' ' . $textPalProxArte, "<strong style=$alerta>" . $textPalAntArte . " " . $difArtePalavra . " " . $textPalProxArte . '</strong>', $textArteLinhas[$indicePalavraArte]));
                                        unset($textArteLinhas[$indicePalavraArte]);
                                    }
                                    $indiceTemp = $indicePalavraArte;
                                }
                            }
                        }
                    }
                }
            }
            foreach ($textDocLinhas as $sobra) array_push($textDocLinhasNovo, $sobra);
        }

        ?>


        <div class="container p-3 m-0">
            <?php
            if (isset($unidadeMedidaEspaco) && count($unidadeMedidaEspaco) > 0) {
                echo "<h6>Unidades de medida sem espaço: </h6>";
                foreach ($unidadeMedidaEspaco as $erro) echo "<br><h7>" . str_replace($replaceChars[1], $replaceChars[2], $erro) . "</h7><br>";
            }
            if (isset($unidadeMedidaCaixa) && count($unidadeMedidaCaixa) > 0) {
                echo "<br><h6>Unidades de medida com escrita errada: </h6>";
                foreach ($unidadeMedidaCaixa as $erro) echo "<br><h7>" . str_replace($replaceChars[1], $replaceChars[2], $erro) . "</h7><br>";
            }
            if (isset($textCompara)) echo '<br><h5>' . count($textCompara) . ' parágrafos correspondem.</h5><br>';
            ?>
        </div>

        <div class="row p-3 m-0">

            <div class="col-md-6">
                <?php
                if (isset($textDocLinhasNovo) && count($textDocLinhasNovo) > 0) {
                    echo '<h5>Os ' . count($textDocLinhasNovo) . '/' . (count($textDocLinhasNovo) + count($textCompara)) . ' parágrafos não correspondentes<br>no Documento são:</h5><br>';
                    sort($textDocLinhasNovo);
                    foreach ($textDocLinhasNovo as $textResult) {
                        echo "<div class='col'>" . str_replace($replaceChars[1], $replaceChars[2], $textResult) . '</div><br><br>';
                    }
                }
                ?>
            </div>
            <div class="col-6">
                <?php
                if (isset($textArteLinhasNovo) && count($textArteLinhasNovo) > 0) {
                    echo '<h5>Os ' . count($textArteLinhasNovo) . '/' . (count($textArteLinhasNovo) + count($textCompara)) .  ' parágrafos não correspondentes<br>na Arte são:</h5><br>';
                    sort($textArteLinhasNovo);
                    foreach ($textArteLinhasNovo as $textResult) {
                        echo "<div class='col'>" . str_replace($replaceChars[1], $replaceChars[2], $textResult) . '</div><br><br>';
                    }
                }

                ?>
            </div>
        </div>
        <div class="row p-3"></div>

    </div>
</div>
    <?php include_once 'partials/footer.php'; ?>
</html>