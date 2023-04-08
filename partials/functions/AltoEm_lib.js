function altoEm(altura, largura, area, nutrientes, tipo) {

    let larguraFinal = 0;

    altura = Number(altura);
    largura = Number(largura);
    nutrientes = Number(nutrientes);
    let blocos = 0;
    let blocos_hor = 0;
    let fonte = 0;
    let larguramax = 0;
    let areaNutri1 = 0;
    let areaNutri2 = 0;
    let areaNutri3 = 0;
    let areaNutriFinal = 0;
    let minFont = 0;
    let maxFont = 0;
    let areaPDP = Number(area) == 0 ? altura * largura : Number(area);


    // verifica tabela legal
    if ((altura <= 0 || largura <= 0 || nutrientes == undefined || tipo == undefined) || areaPDP <= 0) {
        return [0, 0];
    }

    // $(area_FOP).val(altura * largura);
    if (areaPDP < 10000) {
        areaNutri1 = areaPDP * 0.035;
        areaNutri2 = areaPDP * 0.0525;
        areaNutri3 = areaPDP * 0.07;
        minFont = 4;
        maxFont = 9;
    } else {
        areaNutri1 = areaPDP * 0.02;
        areaNutri2 = areaPDP * 0.03;
        areaNutri3 = areaPDP * 0.04;
        minFont = 9;
        maxFont = 15;
    }
    switch (nutrientes) {
        case 1:
            // $(alto_em_a).val(areaNutri1);
            altoEmA = areaNutri1;
            break;
        case 2:
            // $(alto_em_a).val(areaNutri2);
            altoEmA = areaNutri2;
            break;
        case 3:
            // $(alto_em_a).val(areaNutri3);
            altoEmA = areaNutri3;
            break;
    }

    switch (nutrientes) {
        case 1:
            switch (tipo) {
                case "--":
                    blocos = 2;
                    blocos_hor = 2;
                    areaNutriFinal = areaNutri1;
                    break;
                case "I":
                    blocos = 2;
                    blocos_hor = 1;
                    areaNutriFinal = areaNutri1;
                    break;
            }
            break;
        case 2:
            switch (tipo) {
                case "--":
                    blocos = 3;
                    blocos_hor = 3;
                    areaNutriFinal = areaNutri2;
                    break;
                case "I":
                    blocos = 3;
                    blocos_hor = 1;
                    areaNutriFinal = areaNutri2;
                    break;
                case "L":
                    blocos = 3;
                    blocos_hor = 2;
                    areaNutriFinal = areaNutri2;
                    break;
                case "q":
                    blocos = 3;
                    blocos_hor = 2;
                    areaNutriFinal = areaNutri2;
                    break;
                case "r":
                    blocos = 3;
                    blocos_hor = 2;
                    areaNutriFinal = areaNutri2;
                    break;
            }
            break;
        case 3:
            switch (tipo) {
                case "--":
                    blocos = 4;
                    blocos_hor = 4;
                    areaNutriFinal = areaNutri3;
                    break;
                case "I":
                    blocos = 4;
                    blocos_hor = 1;
                    areaNutriFinal = areaNutri3;
                    break;
                case "L":
                    blocos = 4;
                    blocos_hor = 3;
                    areaNutriFinal = areaNutri3;
                    break;
                case "r":
                    blocos = 4;
                    blocos_hor = 2;
                    areaNutriFinal = areaNutri3;
                    break;
                case "0":
                    blocos = 4;
                    blocos_hor = 2;
                    areaNutriFinal = areaNutri3;
                    break;
                case "q":
                    blocos = 4;
                    blocos_hor = 2;
                    areaNutriFinal = areaNutri3;
                    break;
            }
            break;
    }
    larguraFinal = ladoMaior(areaNutriFinal, blocos, tipo) * blocos_hor;
    fonte = altoEmLpF(larguraFinal, blocos_hor);
    // Verifica se a largura não está impondo fonte acima ou abaixo da legislação

    if (fonte < minFont) larguraFinal = altoemFpL(blocos_hor, minFont)

    larguramax = altoemFpL(blocos_hor, maxFont)
    larguraFinal = larguraFinal.toFixed(2);
    return [larguraFinal, larguramax, altoEmA];
}




function ladoMaior(area, blocos, tipo) {
    let escala = 2.5;
    switch (blocos) {
        case 4:
            switch (tipo) {
                case "I":
                    escala = 2.5705;
                    break;
                case "0":
                    escala = 2.3660;
                    break;
                case "q":
                    escala = 2.4393;
                    break;
                case "L":
                    escala = 2.3360;
                    break;
                case "--":
                    escala = 2.1289;
                    break;
            }
            break;
        case 3:
            switch (tipo) {
                case "I":
                    escala = 2.5323;
                    break;
                case "q":
                    escala = 2.3660;
                    break;
                case "r":
                    escala = 2.3660;
                    break;
                case "L":
                    escala = 2.3660;
                    break;
                case "--":
                    escala = 2.1427;
                    break;
            } break;
        case 2:
            switch (tipo) {
                case "I":
                    escala = 2.4701;
                    break;
                case "--":
                    escala = 2.1703;
                    break;
            }
    }

    return Math.sqrt(escala * (area / blocos));
}


function altoEmLpF(largura, blocos) {
    let coeficiente = 0;
    if (blocos == 1) coeficiente = 2.27;
    else if (blocos == 2) coeficiente = 2.19;
    else if (blocos == 3) coeficiente = 2.16;
    else coeficiente = 2.15;

    return ((largura / blocos) / coeficiente); // retorna qtos pontos tem essa largura
}


function altoemFpL(blocos, pontos) {
    let coeficiente = 0;
    if (blocos == 1) coeficiente = 2.27;
    else if (blocos == 2) coeficiente = 2.19;
    else if (blocos == 3) coeficiente = 2.16;
    else coeficiente = 2.15;
    return (pontos * coeficiente) * blocos; // retorna largura necessaria para obter esses pontos
}

if (typeof module === 'object') {
    module.exports = altoEm;
}