<?php
function doublePreg($palavra)
{
    $invalidChars = '/ +|\-+|\_+/';
    return preg_replace($invalidChars, '_', preg_replace($invalidChars, '_', $palavra));
}

function debug($array)
{
    echo '<br>Debug: ';
    foreach ($array as $index => $arr) {
        echo "$index -> ";
        if (gettype($arr) == 'array') foreach ($arr as $x) echo $x . ' ';
        else echo $arr . ' ';
        echo '<br>';
    }
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
    // $frase1 = trim($frase1);
    // $frase2 = trim($frase2);
    // $master = explode(' ', $frase1);
    // $copy = explode(' ', $frase2);
    $mArea = array();
    $cArea = array();
    $mArea = diffuse($master);
    $cArea = diffuse($copy);
    // $cFim = '';
    // $mFim = '';
    return hilight($mArea, $cArea, $caixa, $corDif, $corAtencao);
    // $cFim = hilight($cArea, $mArea, $caixa, $corDif, $corAtencao);
}

function hilight($frase1, $frase2, $case, $corDif, $corAtencao)
{
    $result = array();

    foreach ($frase1 as $indice => $palavra1) {
        $indMatch = array();
        foreach ($frase2 as $cIndex => $palavra2) {
            $match = 0;
            for ($index = 0; $index < 3; $index++) {
                if ($case) {
                    $palavra1Comp = mb_strtoupper($palavra1[$index], ENCODING);
                    $palavra2Comp = mb_strtoupper($palavra2[$index], ENCODING);
                } else {
                    $palavra1Comp = $palavra1[$index];
                    $palavra2Comp = $palavra2[$index];
                }
                if ($palavra1Comp == $palavra2Comp && $index == 1) $match = $match + 10; //10 is most important word match
                elseif ($palavra1Comp == $palavra2Comp) $match++; //10-11 is partial match / 12 is perfect match
            }
            array_push($indMatch, [$match, $indice]);
        }
        rsort($indMatch);
        if ($indMatch[0][0] == 12) array_push($result, "$palavra1[1]");
        elseif ($indMatch[0][0] >= 10) array_push($result, "<text style='color:$corAtencao'>$palavra1[1]</text>");
        else array_push($result, "<text style='color:$corDif'>$palavra1[1]</text>");
    }
    return $result;
}

function diffuse($wordArray)
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
