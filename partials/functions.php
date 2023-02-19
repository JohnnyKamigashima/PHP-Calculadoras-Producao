<?php

function doublePreg($palavra)
{
    $invalidChars = '/ +|\-+|\_+/';
    return preg_replace($invalidChars, '_', preg_replace($invalidChars, '_', $palavra));
}

function debug($array)
{

    if (gettype($array) == "array") {

        foreach ($array as $index => $arr) {
            echo "$index -> ";
            if (gettype($arr) == 'array') {
                foreach ($arr as $x) {
                    echo str_replace('/</', '&lt;', $x) . ' ';
                }
            } else {
                echo $arr . ' ';
                echo '<br>';
            }
        }
    } else {
        var_dump(str_replace('/</', '&lt;', $array));
    }
}

function countValid($array)
{
    $conta = 0;
    $array = array_filter($array);
    foreach ($array as $arr) {
        if (gettype($arr) == 'array') {
            foreach ($arr as $x) {
                if ($x != "") {
                    $conta++;
                    break;
                }
            }
        } elseif ($arr != "") {
            $conta++;
        }
    }
    return $conta;
}

function comparaArrays($arr1, $arr2, $case)
{
    $result  = array();
    $resTemp = '';
    foreach ($arr1 as $uniq1) {
        $resTemp = $uniq1;
        foreach ($arr2 as $ind2 => $uniq2) {
            $doIt = false;
            if (
                $case && mb_strtoupper($uniq1, ENCODING) == mb_strtoupper($uniq2, ENCODING) ||
                !$case && $uniq1 == $uniq2
            ) {
                $doIt = true;
            }
            if ($doIt) {
                unset($arr2[$ind2]);
                $resTemp = '';
                break;
            }
        }
        if ($resTemp != '') {
            array_push($result, $resTemp);
        }
    }
    return $result;
}

function descomparaArrays($arr1, $arr2, $case)
{
    $result = array();
    foreach ($arr1 as $uniq1) {
        foreach ($arr2 as $ind2 => $uniq2) {
            if (
                $case && mb_strtoupper($uniq1, ENCODING) == mb_strtoupper($uniq2, ENCODING) ||
                (!$case && $uniq1 == $uniq2)
            ) {
                unset($arr2[$ind2]);
                if ($uniq1 != '') {
                    array_push($result, $uniq1);
                }
                break;
            }
        }
    }
    return $result;
}

function frasesDiff($master, $copy, $caixa, $corDif, $corAtencao)
{
    $corDif     = (ctype_xdigit($corDif)) ? $corDif : 'FF0000';
    $corAtencao = (ctype_xdigit($corAtencao)) ? $corAtencao : '880000';
    $caixa      = (gettype($caixa) == 'boolean') ? $caixa : true;
    $mArea      = array();
    $cArea      = array();
    $mArea      = diffuse($master);
    $cArea      = diffuse($copy);
    return hilight($mArea, $cArea, $caixa, $corDif, $corAtencao);
}

function hilight($frase1, $frase2, $case, $corDif, $corAtencao) //verifica duas arrays de pelavras e marca as diferencas

{
    $result     = array();
    $caracteres = '/(\.|\,|\)|\(|\;|\:|\?|\!|\#|\$|\@|\&|\+|\-| )/';
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
                if (
                    preg_replace($caracteres, '', $palavra1Comp) ==
                    preg_replace($caracteres, '', $palavra2Comp) && $index == 1
                ) {
                    $match = $match + 10; //10 is most important word match
                } elseif (
                    preg_replace($caracteres, '', $palavra1Comp) ==
                    preg_replace($caracteres, '', $palavra2Comp)
                ) {
                    $match++; //10-11 is partial match / 12 is perfect match
                }
            }
            array_push($indMatch, [$match, $indice]);
        }
        rsort($indMatch);
        if ($indMatch[0][0] == 12) {
            array_push($result, "$palavra1[1]");
        } elseif ($indMatch[0][0] >= 10) {
            array_push($result, "<text style='color:#$corAtencao'>$palavra1[1]</text>");
        } else {
            array_push($result, "<text style='color:#$corDif'>$palavra1[1]</text>");
        }
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
            if ($wIndex == 0) {
                array_push($wArea, ['', $wPal, $wordArray[$wIndex + 1]]);
            } else {
                array_push($wArea, [$wordArray[$wIndex - 1], $wPal, '']);
            }
        } elseif (count($wordArray) > 2) {
            if ($wIndex == 0) {
                array_push($wArea, ['', $wPal, $wordArray[$wIndex + 1]]);
            } elseif ($wIndex < count($wordArray) - 1) {
                array_push($wArea, [$wordArray[$wIndex - 1], $wPal, $wordArray[$wIndex + 1]]);
            } else {
                array_push($wArea, [$wordArray[$wIndex - 1], $wPal, '']);
            }
        }
    }
    return $wArea;
}

function removeTags($str)
{
    if (($str === null) || ($str === '')) {
        return false;
    }

    $cleantext = preg_replace(
        "/(<td.*>(\s+)?<p>|<\/p>(\s+)?<\/td>|\h|\xc2\xa0)/iU",
        ' ',
        $str
    ); // converte colunas td para espaço
    $cleantext = preg_replace(
        "/[ \x{A0}\x{1680}\x{180e}\x{2000}\x{200a}\x{202f}\x{205f}\x{3000}]+/iuU",
        ' ',
        $cleantext
    ); // remove unicode espaco em branco
    $cleantext = preg_replace(
        '/((\s| ?\&nbsp;|\n|\r|\h|\xc2\xa0)+|(<(\/?(span|table|code|col|td|colgroup|ul|li|form|label|img|input).*?)>))/i',
        ' ',
        $cleantext
    ); //Converte caracteres de espaço para espaço e remove tags
    $cleantext = preg_replace(
        '/((<(\/?(p|div|h|a|style|tr|tbody).*?)>)|(( ?(\n)?<br ?\/?> ?)+))/i',
        '<br>',
        $cleantext
    ); //Transforma tags para quebras de linhas

    return $cleantext;
}

function isNotTagged($start, $end, $tag, $string)
{
    $result = array();
    $string = html_entity_decode($string);

    // Limpa texto entre tag
    $semTag = preg_replace("/(<$tag.*>(.*|.*\n.*)<\/$tag>)/imU", '', $string, PREG_SET_ORDER);

    // Adiciona resultados na array
    preg_match("/($start.*?$end)/imU", $semTag, $result);
    if ($result != null) {
        return $result[1];
    }
}

function isCaixa($start, $end, $string)
{
    $start         = mb_strtoupper($start, ENCODING);
    $end           = mb_strtoupper($end, ENCODING);
    $removeCorreto = preg_replace("/($start.*?$end)/m", '', $string);
    preg_match("/($start.*?$end)/im", $removeCorreto, $result);
    return array_filter($result) != null ? $result[1] : false;
}
function mostraHTML($str)
{
    echo "<br>" . str_replace("/\</", "&lt;", $str);
}
function removeBold($str)
{
    return preg_replace('/(?:<(?:\/?(?:strong).*?)>)/i', "", $str);
}
function limpaSimbolos($str)
{
    return preg_replace("/(\"|\'|\*|\;|\,|\?|\!|\&|\%|\#|\+|\.|\©|\®|\™|\\\|([[:alnum:]]| +)\/|\:|\-)/", " ", $str);
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
    $strong = preg_replace("/(\t+|<\/strong>(\h|\xc2\xa0| +)?<strong>)/u", " ", $str);
    return preg_replace("/(<(\/?(p|br).*?)>)/i", "\n", $strong);
} // Troca tab por espacos e quebras por \n
function limpaPontofinal($str)
{
    return preg_replace("/\.(\s+)?\|/", "|", preg_replace("/\.( +)?<\/strong\>(\s)?\|/i", "</strong>|", $str));
} //Limpa pontos finais antes de quebra de linha
function limpaSujeiraHtml($str)
{
    // troca quebras de linha, e limpeza de tags com espaços antes ou depois ou bolds italicos de espaços vazios
    $replaceChars    = array();
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
    $str             = preg_replace($replaceChars[0], $replaceChars[1], $str);
    $str             = preg_replace("/<em>((\.|\?|\!|\,|\;|\:)+)<\/em>/", "$1", $str); //limpa estilos italico de pontuaçao
    $str             = preg_replace("/<strong>((\.|\?|\!|\,|\;|\:)+)<\/strong>/", "$1", $str); //limpa estilos bold de pontuaçao
    $str             = str_replace("/\|\<\/strong>/", "</strong>", $str);
    $str             = preg_replace("/\|+ ?\|+/", "|", $str);
    $str             = preg_replace("/<strong>((?:(?!<\/strong>).)*)(?:\s+)?\|/mUi", "<strong>$1</strong>|<strong>", $str);
    return $str;
}

function frasesMaisSemelhantes($arr1, $arr2, $intHit)
{
    //Compara duas arrays 2D (linha e palavra) e retorna
    //uma array ordenada com [Quantidade de semelhancas, array1, array2]
    $result   = array();
    $frasetmp = '';

    foreach ($arr1 as $ind1 => $a1) {
        $ftemp  = array();
        $indHit = $hits = 0;

        foreach ($a1 as $pal1) {
            foreach ($arr2 as $ind2 => $a2) {
                foreach ($a2 as $pal2) {
                    if (
                        removeBold(removeItalico(limpaSimbolos($pal1))) ==
                        removeBold(removeItalico(limpaSimbolos($pal2))) && $pal1 != '' && $pal2 != ''
                    ) {
                        $hits++;
                        $indHit   = $ind2;
                        $frasetmp = '';
                        foreach ($a2 as $pal) {
                            $frasetmp = $frasetmp . ' ' . $pal;
                        } //constroi frase com array de palavras
                        break;
                    }
                }
            }
            array_push($ftemp, [$hits, $indHit, $frasetmp]);
        }
        rsort($ftemp);
        $frasetmp = '';
        if ($ftemp[0][0] > 0) {
            unset($arr2[$ftemp[0][1]]);
            foreach ($arr1[$ind1] as $frase) {
                $frasetmp = $frasetmp . ' ' . $frase;
            }
        }
        if ($ftemp[0][0] == $intHit && $intHit > 0) {
            array_push($result, [$frasetmp, $ftemp[0][2]]);
        } elseif ($ftemp[0][0] == 0 && $intHit == 0) {
            array_push($result, [$frasetmp, '']);
        } // adiciona resultados do aray 1 que não tiveram hits
    }
    if ($intHit == 0) { // adiciona sobras do array 2
        foreach ($arr2 as $sobra) {
            $frasetmp = '';
            foreach ($sobra as $frase) {
                $frasetmp = $frasetmp . ' ' . $frase;
            }
            array_push($result, ['', $frasetmp]);
        }
    }
    return $result;
}

function uploadFile($targetDir, $fileType, $tamanhoMaximo, $fileToUpload)
{
    $resposta       = '';
    $targetFile     = $targetDir . basename($_FILES[$fileToUpload]["name"]);
    $uploadOk       = 1;
    $uploadFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if image file is a actual XML or fake image
    if (isset($_POST["submit"])) {

        // Check file size
        if ($_FILES[$fileToUpload]["size"] > $tamanhoMaximo) {
            $resposta = "Desculpe-me mas o arquivo ultrapassa $tamanhoMaximo.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if (
            $uploadFileType != $fileType
        ) {
            $resposta = "Desculpe-me mas somente aceito arquivos " . $fileType;
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $resposta = "Desculpe-me mas seu arquivo não foi subido.";
        } else {
            if (move_uploaded_file($_FILES[$fileToUpload]["tmp_name"], $targetFile)) {
                $resposta = "O arquivo " . htmlspecialchars(basename($_FILES[$fileToUpload]["name"])) .
                    " subiu corretamente.";

            } else {
                $resposta = "Desculpe-me mas houve algum erro ao subir o arquivo.";
            }
        }
    }
    return [$resposta, $targetFile];
}

function readAndCleanupReportFile($targetFile)
{
    $texto = file_get_contents($targetFile);
    if ($texto != '') {
        $texto = preg_replace("/(<ul id=\"tree\">)\n?.*\n?(Process finished with exit code)/iU", '$1<br>$2', $texto);
        file_put_contents($targetFile, $texto);
        $resposta = '<br><a href="' . $targetFile . '" target="_blank">Veja o arquivo em uma nova aba</a>';
    }
    return $resposta;
}

function limpaXFDFTexto($texto)
{
    $texto = htmlDecode($texto);
    $texto = str_replace('/\n/Umi', ' ', $texto);
    $texto = preg_replace('/(<\/span.*>)/Umi', '$1', $texto);
    $texto = preg_replace('/(\n)/Umi', ' ', $texto);
    $texto = preg_replace('/(<\/.*?>)/mi', '$1', $texto);
    $texto = preg_replace(
        '/(<(span.*font-weight:bold.*|strong)>)(.*)(<\/(span|strong).*>)/Umi',
        '[strong]$3[/strong]',
        $texto
    );
    $texto = preg_replace(
        '/(<(span.*font-weight:italic.*|em)>)(.*)(<\/(span|em).*>)/Umi',
        '[em]$3[/em]',
        $texto
    );
    $texto = preg_replace(
        '/\[(strong|em)\]/imU',
        '[$1]',
        $texto
    );
    $texto = preg_replace('/(<.*>|&#xD;)/mU', ' ', $texto);
    $texto = preg_replace('/\[(\/)?(strong|em)\]/Um', '<$1$2>', $texto);
    $texto = preg_replace('/(\t| |\r)+/Um', ' ', $texto);
    $texto = str_replace('/\n/i', '<br>', $texto);
    $texto = preg_replace('/  +/i', '<br>', $texto);
    $texto = preg_replace('/(<br>)+/i', '<br>', $texto);
    return $texto;
}
;

function htmlDecode($entrada)
{
    $caracteres = [
        ["À", "&Agrave;"],
        ["Á", "&Aacute;"],
        ["Â", "&Acirc;"],
        ["Ã", "&Atilde;"],
        ["Ä", "&Auml;"],
        ["Å", "&Aring;"],
        ["Æ", "&AElig;"],
        ["Ç", "&Ccedil;"],
        ["È", "&Egrave;"],
        ["É", "&Eacute;"],
        ["Ê", "&Ecirc;"],
        ["Ë", "&Euml;"],
        ["Ì", "&Igrave;"],
        ["Í", "&Iacute;"],
        ["Î", "&Icirc;"],
        ["Ï", "&Iuml;"],
        ["Ñ", "&Ntilde;"],
        ["Ò", "&Ograve;"],
        ["Ó", "&Oacute;"],
        ["Ô", "&Ocirc;"],
        ["Õ", "&Otilde;"],
        ["Ö", "&Ouml;"],
        ["Ø", "&Oslash;"],
        ["Ù", "&Ugrave;"],
        ["Ú", "&Uacute;"],
        ["Û", "&Ucirc;"],
        ["Ü", "&Uuml;"],
        ["Ý", "&Yacute;"],
        ["ß", "&szlig;"],
        ["à", "&agrave;"],
        ["á", "&aacute;"],
        ["â", "&acirc;"],
        ["ã", "&atilde;"],
        ["ä", "&auml;"],
        ["å", "&aring;"],
        ["æ", "&aelig;"],
        ["ç", "&ccedil;"],
        ["è", "&egrave;"],
        ["é", "&eacute;"],
        ["ê", "&ecirc;"],
        ["ë", "&euml;"],
        ["ì", "&igrave;"],
        ["í", "&iacute;"],
        ["î", "&icirc;"],
        ["ï", "&iuml;"],
        ["ð", "&eth;"],
        ["ñ", "&ntilde;"],
        ["ò", "&ograve;"],
        ["ó", "&oacute;"],
        ["ô", "&ocirc;"],
        ["õ", "&otilde;"],
        ["ö", "&ouml;"],
        ["ù", "&ugrave;"],
        ["ú", "&uacute;"],
        ["û", "&ucirc;"],
        ["ü", "&uuml;"],
        ["ý", "&yacute;"],
        ["ÿ", "&yuml;"],
        [">", "&gt;"],
        ["<", "&lt;"],
        ["&", "&amp;"],
        ["&ndash;", "-"]

    ];
    foreach ($caracteres as $char) {
        $entrada = preg_replace('/(${element[1]})/im', $char[0], $entrada);
    }
    return $entrada;
}