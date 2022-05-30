<?php

use function PHPSTORM_META\type;

function doublePreg($palavra)
{
    $invalidChars = '/ +|\-+|\_+/';
    return preg_replace($invalidChars, '_', preg_replace($invalidChars, '_', $palavra));
}

function debug($array)
{
    echo '<br>Debug: ';
    if (gettype($array) == "array") {

        foreach ($array as $index => $arr) {
            echo "$index -> ";
            if (gettype($arr) == 'array') foreach ($arr as $x) echo preg_replace('/</', '&lt;', $x) . ' ';
            else echo $arr . ' ';
            echo '<br>';
        }
    } else var_dump(preg_replace('/</', '&lt;', $array));
}

function count_valid($array)
{
    $conta = 0;
    $array = array_filter($array);
    foreach ($array as $ind => $arr) {
        if (gettype($arr) == 'array') {
            foreach ($arr as $x) if ($x != "") {
                $conta++;
                break;
            }
        } else if ($arr != "") $conta++;
    }
    return $conta;
}

function comparaArrays($arr1, $arr2, $case)
{
    $result = array();
    $resTemp = '';
    $encoding = 'UTF-8';
    foreach ($arr1 as $ind1 => $uniq1) {
        $resTemp = $uniq1;
        foreach ($arr2 as $ind2 => $uniq2) {
            $doIt = false;
            if ($case && mb_strtoupper($uniq1, $encoding) == mb_strtoupper($uniq2, $encoding)) $doIt = true;
            else if (!$case && $uniq1 == $uniq2) $doIt = true;
            if ($doIt) {
                unset($arr2[$ind2]);
                $resTemp = '';
                break;
            }
        }
        if ($resTemp != '') array_push($result, $resTemp);
    }
    return $result;
}

function descomparaArrays($arr1, $arr2, $case)
{
    $result = array();
    $encoding = 'UTF-8';
    foreach ($arr1 as $ind1 => $uniq1) {
        foreach ($arr2 as $ind2 => $uniq2) {
            $doIt = false;
            if ($case && mb_strtoupper($uniq1, $encoding) == mb_strtoupper($uniq2, $encoding)) $doIt = true;
            else if (!$case && $uniq1 == $uniq2) $doIt = true;
            if ($doIt) {
                unset($arr2[$ind2]);
                if ($uniq1 != '') array_push($result, $uniq1);
                break;
            }
        }
    }
    return $result;
}

function frasesDiff($master, $copy, $caixa, $corDif, $corAtencao)
{
    $corDif = (ctype_xdigit($corDif)) ? $corDif : 'FF0000';
    $corAtencao = (ctype_xdigit($corAtencao)) ? $corAtencao : '880000';
    $caixa = (gettype($caixa) == 'boolean') ? $caixa : true;
    $mArea = array();
    $cArea = array();
    $mArea = diffuse($master);
    $cArea = diffuse($copy);
    return hilight($mArea, $cArea, $caixa, $corDif, $corAtencao);
}

function hilight($frase1, $frase2, $case, $corDif, $corAtencao) //verifica duas arrays de pelavras e marca as diferencas
{
    $result = array();
    foreach ($frase1 as $indice => $palavra1) {
        $indMatch = array();
        foreach ($frase2 as $palavra2) {
            $match = 0;
            for ($index = 0; $index < 3; $index++) {
                if ($case) {
                    $palavra1Comp = mb_strtoupper(($palavra1[$index]), ENCODING);
                    $palavra2Comp = mb_strtoupper(($palavra2[$index]), ENCODING);
                } else {
                    $palavra1Comp = ($palavra1[$index]);
                    $palavra2Comp = ($palavra2[$index]);
                }
                if (preg_replace('/(\.|\,|\)|\(|\;|\:|\?|\!|\#|\$|\@|\&|\+|\-| )/', '', $palavra1Comp) == preg_replace('/(\.|\,|\)|\(|\;|\:|\?|\!|\#|\$|\@|\&|\+|\-| )/', '', $palavra2Comp) && $index == 1) $match = $match + 10; //10 is most important word match
                elseif (preg_replace('/(\.|\,|\)|\(|\;|\:|\?|\!|\#|\$|\@|\&|\+|\-| )/', '', $palavra1Comp) == preg_replace('/(\.|\,|\)|\(|\;|\:|\?|\!|\#|\$|\@|\&|\+|\-| )/', '', $palavra2Comp)) $match++; //10-11 is partial match / 12 is perfect match
            }
            array_push($indMatch, [$match, $indice]);
        }
        rsort($indMatch);
        if ($indMatch[0][0] == 12) array_push($result, "$palavra1[1]");
        elseif ($indMatch[0][0] >= 10) array_push($result, "<text style='color:#$corAtencao'>$palavra1[1]</text>");
        else array_push($result, "<text style='color:#$corDif'>$palavra1[1]</text>");
    }
    return $result;
}

function diffuse($wordArray) //converte uma array de palavras para uma array de 3 elementos com [antes, palavra, depois]
{
    $wArea = array();

    foreach ($wordArray as $wIndex => $wPal) {
        if (count($wordArray) == 1) {
            array_push($wArea, ['', $wPal, '']);
        } elseif (count($wordArray) == 2) {
            if ($wIndex == 0) array_push($wArea, ['', $wPal, $wordArray[$wIndex + 1]]);
            else array_push($wArea, [$wordArray[$wIndex - 1], $wPal, '']);
        } elseif (count($wordArray) > 2) {
            if ($wIndex == 0) array_push($wArea, ['', $wPal, $wordArray[$wIndex + 1]]);
            elseif ($wIndex < count($wordArray) - 1) array_push($wArea, [$wordArray[$wIndex - 1], $wPal, $wordArray[$wIndex + 1]]);
            else array_push($wArea, [$wordArray[$wIndex - 1], $wPal, '']);
        }
    }
    return $wArea;
}

function removeTags($str)
{
    if (($str === null) || ($str === ''))  return false;

    // Regular expression to identify HTML tags in
    // the input string. Replacing the identified
    // HTML tag with a null string.
    $cleantext = preg_replace("/(<td.*>(\s+)?<p>|<\/p>(\s+)?<\/td>|\h|\xc2\xa0)/iU", ' ', $str); // converte colunas td para espaço
    $cleantext = preg_replace('/(\s| ?\&nbsp;|\n|\r|\h|\xc2\xa0)+/i', ' ', $cleantext);
    $cleantext = preg_replace('/(<(\/?(span|table|code|col|td|colgroup|ul|li).*?)>)/i', ' ', $cleantext);
    $cleantext = preg_replace('/(<(\/?(p|div|h|a|style|tr|tbody).*?)>)/i', '<br>', $cleantext);
    $cleantext = preg_replace('/(( ?(\n)?<br ?\/?> ?)+)/mi', "<br>", $cleantext); 
    
    return $cleantext;
}
function isBold($start, $end, $haystack)
{
    $correto = $geral = $geralN = $corretoN = $incorreto = array();
    $haystack =  html_entity_decode($haystack);
    preg_match_all("/(&lt;|<).*strong.*(>|&gt;).*\K$start\W.*$end\W/imU", $haystack, $correto, PREG_SET_ORDER);
    preg_match_all("/$start\W.*$end\W/imU", $haystack, $geral, PREG_SET_ORDER);
    foreach ($geral as $unitario) array_push($geralN, $unitario[0]);
    foreach ($correto as $unitario) array_push($corretoN, $unitario[0]);
    if ((count($corretoN) == 0)) return $geralN;
    if (count($geralN) === count($corretoN)) return array();
    else {
        foreach ($geralN as $g => $unG) {
            foreach ($corretoN as $c => $unN) {
                if (trim($unG) == trim($unN)) {
                    unset($corretoN[$c]);
                    unset($geralN[$g]);
                    break;
                } else $incorretoTEMP = $unN;
            }
        }
    }
    return $geralN;
}
function isItalic($start, $end, $haystack)
{
    $correto = $geral = $geralN = $corretoN  = $result = array();
    $haystack =  html_entity_decode($haystack);
    if ($end != '') preg_match_all("/<.*em.*>$start.*$end<\/?em.*>/imU", $haystack, $correto, PREG_SET_ORDER);
    else preg_match_all("/<.*em.*>$start<\/?em.*>/imU", $haystack, $correto, PREG_SET_ORDER);
    preg_match_all("/$start.*$end/imU", $haystack, $geral, PREG_SET_ORDER);
    foreach ($correto as $index => $corr) $correto[$index] = removeItalico($corr);
    if (count($geral) === count($correto)) return array();
    else {
        foreach ($geral as $g => $unG) {
            foreach ($correto as $c => $unN) {
                if (trim($unG[0]) == trim($unN[0])) {
                    unset($correto[$c]);
                    unset($geral[$g]);
                    break;
                }
            }
        }
    }
    foreach ($geral as $g) array_push($result, $g);
    return $g;
}
function isCaixa($start, $end, $haystack)
{
    $correto = $geral = $geralN = $corretoN  = array();
    $haystack =  html_entity_decode($haystack);
    $upperstart = mb_strtoupper($start);
    $upperend = mb_strtoupper($end);
    preg_match_all("/$upperstart\W.*$upperend\W/muU", $haystack, $correto, PREG_SET_ORDER);
    preg_match_all("/$start\W.*$end\W/imuU", $haystack, $geral, PREG_SET_ORDER);
    foreach ($geral as $unitario) array_push($geralN, $unitario[0]);
    foreach ($correto as $unitario) array_push($corretoN, $unitario[0]);
    if ((count($corretoN) == 0)) return $geralN;
    if (count($geralN) === count($corretoN)) return array();
    else {
        foreach ($geralN as $g => $unG) {
            foreach ($corretoN as $c => $unN) {
                if (trim($unG) == trim($unN)) {
                    unset($corretoN[$c]);
                    unset($geralN[$g]);
                    break;
                } else $incorretoTEMP = $unN;
            }
        }
    }
    return $geralN;
}
function mostraHTML($str)
{
    echo "<br>" . preg_replace("/\</", "&lt;", $str);
}
function removeBold($str)
{
    return preg_replace("/(?:<(?:\/?(?:strong).*?)>)/i", "", $str);
}
function removeSinais($str)
{
    return preg_replace("/(\(|\)|\"|\'|\;|\,|\?|\*|\&|\%|\#|\+|\.)/", "", $str);
}
function removeItalico($str)
{
    return preg_replace("/(<(\/?(em).*?)>)/i", "", $str);
}
function removeEspacoduplo($str)
{
    return preg_replace("/( +|\t+|\h+)/", " ", $str);
}
function limpaHtmlSpaceBreak($str)
{
    return preg_replace("/(<(\/?(p|br).*?)>)/i", "\n", preg_replace("/(\t+|<\/strong>(\h|\xc2\xa0| +)?<strong>)/u", " ", $str));
} // Troca tab por espacos e quebras por \n
function limpaPontofinal($str)
{
    return preg_replace("/\.(\s+)?\|/", "|", preg_replace("/\.( +)?<\/strong\>(\s)?\|/i", "</strong>|", $str));
} //Limpa pontos finais antes de quebra de linha
function limpaSujeiraHtml($str)
{
    // troca quebras de linha, e limpeza de tags com espaços antes ou depois ou bolds italicos de espaços vazios
    $replaceChars = array();
    $replaceChars[0] = [
        "/(\r+|<br>|\n+| \n+|\|+)/",
        "/\s?<em>\s+/",
        "/\s+<\/em>\s?/",
        "/\s?<strong>\s+/",
        "/\s+<\/strong>\s?/",
        "/(<strong>(\s?)+<\/strong>|<em>(\s?)+<\/em>|<\/strong>(\s?)+<strong>|<\/em>(\s?)+<em>)/"
    ];
    $replaceChars[1] = [
        "|",
        " <em>",
        "</em> ",
        " <strong>",
        "</strong> ",
        " "
    ];
    $replaceChars[2] = [
        "\n",
        " <em>",
        "</em> ",
        " <strong>",
        "</strong> ",
        " "

    ];
    $str = preg_replace($replaceChars[0], $replaceChars[1], $str);
    $str = preg_replace("/<em>((\.|\?|\!|\,|\;|\:)+)<\/em>/", "$1", $str); //limpa estilos italico de pontuaçao
    $str = preg_replace("/<strong>((\.|\?|\!|\,|\;|\:)+)<\/strong>/", "$1", $str); //limpa estilos bold de pontuaçao
    $str = preg_replace("/\|\<\/strong>/", "</strong>", $str);
    $str = preg_replace("/\|+ ?\|+/", "|", $str);
    $str = preg_replace("/<strong>((?:(?!<\/strong>).)*)(?:\s+)?\|/mUi", "<strong>$1</strong>|<strong>", $str);
    return $str;
}

function frasesMaisSemelhantes($arr1, $arr2, $intHit)
{ //Compara duas arrays 2D (linha e palavra) e retorna uma array ordenada com [Quantidade de semelhancas, array1, array2] 
    $result = array();
    $frasetmp = '';

    foreach ($arr1 as $ind1 => $a1) {
        $ftemp = array();
        $indHit = $hits = 0;

        foreach ($a1 as $pal1) {
            foreach ($arr2 as $ind2 => $a2) {
                foreach ($a2 as $indpal2 => $pal2) {
                    if (removeBold(removeItalico(removeSinais($pal1))) == removeBold(removeItalico(removeSinais($pal2))) && $pal1 != '' && $pal2 != '') {
                        $hits++;
                        $indHit = $ind2;
                        $frasetmp = '';
                        foreach ($a2 as $pal) $frasetmp = $frasetmp . ' ' . $pal; //constroi frase com array de palavras
                        break;
                    }
                }
            }
            array_push($ftemp, [$hits, $indHit, $frasetmp]);
        }
        rsort($ftemp);
        $frasetmp = '';
        if ($ftemp[0][0] > 0) unset($arr2[$ftemp[0][1]]);
        foreach ($arr1[$ind1] as $frase) $frasetmp = $frasetmp . ' ' . $frase;
        if ($ftemp[0][0] == $intHit && $intHit > 0) array_push($result, [$frasetmp, $ftemp[0][2]]);
        elseif ($ftemp[0][0] == 0 && $intHit == 0)  array_push($result, [$frasetmp, '']); // adiciona resultados do aray 1 que não tiveram hits
    }
    if ($intHit == 0) // adiciona sobras do array 2
    {
        foreach ($arr2 as $sobra) {
            $frasetmp = '';
            foreach ($sobra as $frase) $frasetmp = $frasetmp . ' ' . $frase;
            array_push($result, ['', $frasetmp]);
        }
    }
    return $result;
}
