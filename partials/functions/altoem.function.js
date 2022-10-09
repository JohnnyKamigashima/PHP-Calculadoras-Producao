var module = module || {};
function altoEm(altura, largura, area, nutrientes, tipo, area_FOP, alto_em_a) {

    let larguraFinal = 0,
        areaPDP = Number(area);

    altura = Number(altura);
    largura = Number(largura);
    area = Number(area);
    nutrientes = Number(nutrientes);
    tipo = tipo;

    if (area == 0) areaPDP = altura * largura;

    // verifica tabela legal
    if ((altura > 0 && largura > 0 && nutrientes != undefined && tipo != undefined) || areaPDP > 0) {
        $(area_FOP).val(altura * largura);
        if (areaPDP < 10000) {
            var areaNutri1 = areaPDP * 0.035,
                areaNutri2 = areaPDP * 0.0525,
                areaNutri3 = areaPDP * 0.07,
                minFont = 4,
                maxFont = 9;
        } else {
            var areaNutri1 = areaPDP * 0.02,
                areaNutri2 = areaPDP * 0.03,
                areaNutri3 = areaPDP * 0.04,
                minFont = 9,
                maxFont = 15;
        }
        if (nutrientes == 1) $(alto_em_a).val(areaNutri1);
        else if (nutrientes == 2) $(alto_em_a).val(areaNutri2);
        else if (nutrientes == 3) $(alto_em_a).val(areaNutri3);

        if (tipo == "--" && nutrientes == 1) {
            blocos = 2;
            blocos_hor = 2;
            larguraFinal = ladoGrid(areaNutri1, blocos, tipo) * blocos;
            fonte = altoEmLpF(larguraFinal, blocos_hor);

        } else if (tipo == "I" && nutrientes == 1) {
            blocos = 2;
            blocos_hor = 1;
            larguraFinal = ladoGrid(areaNutri1, blocos, tipo);
            fonte = altoEmLpF(larguraFinal, blocos_hor);

        } else if (tipo == "--" && nutrientes == 2) {
            blocos = 3;
            blocos_hor = 3;
            larguraFinal = ladoGrid(areaNutri2, blocos, tipo) * blocos;
            fonte = altoEmLpF(larguraFinal, blocos_hor);

        } else if (tipo == "I" && nutrientes == 2) {
            blocos = 3;
            blocos_hor = 1;
            larguraFinal = ladoGrid(areaNutri2, blocos, tipo);
            fonte = altoEmLpF(larguraFinal, blocos_hor);

        } else if (tipo == "L" && nutrientes == 2) {
            blocos = 3;
            blocos_hor = 2;
            larguraFinal = ladoGrid(areaNutri2, blocos, tipo) * blocos_hor;
            fonte = altoEmLpF(larguraFinal, blocos_hor);

        } else if (tipo == "r" && nutrientes == 2) {
            blocos = 3;
            blocos_hor = 2;
            larguraFinal = ladoGrid(areaNutri2, blocos, tipo) * blocos;
            fonte = altoEmLpF(larguraFinal, blocos_hor);

        } else if (tipo == "q" && nutrientes == 2) {
            blocos = 3;
            blocos_hor = 2;
            larguraFinal = ladoGrid(areaNutri2, blocos, tipo) * blocos_hor;
            fonte = altoEmLpF(larguraFinal, blocos_hor);

        } else if (tipo == "r" && nutrientes == 2) {
            blocos = 3;
            blocos_hor = 2;
            larguraFinal = ladoGrid(areaNutri2, blocos, tipo) * blocos_hor;
            fonte = altoEmLpF(larguraFinal, blocos_hor);

        } else if (tipo == "r" && nutrientes == 3) {
            blocos = 4;
            blocos_hor = 2;
            larguraFinal = ladoGrid(areaNutri3, blocos, tipo) * blocos_hor;
            fonte = altoEmLpF(larguraFinal, blocos_hor);

        } else if (tipo == "0" && nutrientes == 3) {
            blocos = 4;
            blocos_hor = 2;
            larguraFinal = ladoGrid(areaNutri3, blocos, tipo) * blocos_hor;
            fonte = altoEmLpF(larguraFinal, blocos_hor);

        } else if (tipo == "I" && nutrientes == 3) {
            blocos = 4;
            blocos_hor = 1;
            larguraFinal = ladoGrid(areaNutri3, blocos, tipo);
            fonte = altoEmLpF(larguraFinal, blocos_hor);

        } else if (tipo == "--" && nutrientes == 3) {
            blocos = 4;
            blocos_hor = 4;
            larguraFinal = ladoGrid(areaNutri3, blocos, tipo) * blocos_hor;
            fonte = altoEmLpF(larguraFinal, blocos_hor);

        } else if (tipo == "q" && nutrientes == 3) {
            blocos = 4;
            blocos_hor = 2;
            larguraFinal = ladoGrid(areaNutri3, blocos, tipo) * blocos_hor;
            fonte = altoEmLpF(larguraFinal, blocos_hor);

        } else if (tipo == "L" && nutrientes == 3) {
            blocos = 4;
            blocos_hor = 3;
            larguraFinal = ladoGrid(areaNutri3, blocos, tipo) * blocos;
            fonte = altoEmLpF(larguraFinal, blocos_hor);

        } else {
            larguraFinal = 0;
        }

        // Verifica se a largura não está impondo fonte acima ou abaixo da legislação
        if (larguraFinal != 0) {
            if (fonte < minFont) larguraFinal = altoemFpL(larguraFinal, blocos_hor, minFont)
            else if (fonte > maxFont) larguraFinal = altoemFpL(larguraFinal, blocos_hor, maxFont)
            larguramax = altoemFpL(larguraFinal, blocos_hor, maxFont)
            larguraFinal = larguraFinal.toFixed(2);
        }

        return [larguraFinal, larguramax];
    }
}

function ladoGrid(area, blocos, tipo) {
    // retorna lado maior de um  bloco
    // return (Math.sqrt((area / blocos) / 126)) * 18;
    // return Math.sqrt(2.38099584 * (area / blocos));
    var escala = 2.5;
    if (blocos == 4 && tipo == "I") escala = 2.5705;
    else if (blocos == 3 && tipo == "I") escala = 2.5323;
    else if (blocos == 2 && tipo == "I") escala = 2.4701;
    else if (blocos == 4 && tipo == "0") escala = 2.3660;
    else if (blocos == 3 && tipo == "q") escala = 2.3660;
    else if (blocos == 3 && tipo == "q") escala = 2.3660;
    else if (blocos == 4 && tipo == "q") escala = 2.4393;
    else if (blocos == 3 && tipo == "r") escala = 2.3660;
    else if (blocos == 3 && tipo == "L") escala = 2.3660;
    else if (blocos == 4 && tipo == "L") escala = 2.3360;
    else if (blocos == 4 && tipo == "--") escala = 2.1289;
    else if (blocos == 3 && tipo == "--") escala = 2.1427;
    else if (blocos == 2 && tipo == "--") escala = 2.1703;
    return Math.sqrt(escala * (area / blocos));
}

function altoemFpL(larg, blocos, pontos) {
    let coeficiente = 0;
    if (blocos == 1) coeficiente = 2.27;
    else if (blocos == 2) coeficiente = 2.19;
    else if (blocos == 3) coeficiente = 2.16;
    else coeficiente = 2.15;
    return (pontos * coeficiente) * blocos; // retorna largura necessaria para obter esses pontos
}
function altoEmLpF(largura, blocos) {

    let coeficiente = 0;

    if (blocos == 1) coeficiente = 2.27;
    else if (blocos == 2) coeficiente = 2.19;
    else if (blocos == 3) coeficiente = 2.16;
    else coeficiente = 2.15;

    return ((largura / blocos) / coeficiente); // retorna qtos pontos tem essa largura
}
module.exports = altoEm;
