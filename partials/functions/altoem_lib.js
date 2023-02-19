module.exports = function altoEm(altura, largura, area, nutrientes, tipo, area_FOP, alto_em_a) {

    let larguraFinal = 0,
        areaPDP = Number(area);

    altura = Number(altura);
    largura = Number(largura);
    area = Number(area);
    nutrientes = Number(nutrientes);
    tipo = tipo;
    let blocos = 0, blocos_hor = 0, fonte = 0, larguramax = 0;

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
            larguraFinal = this.ladoGrid(areaNutri1, blocos, tipo) * blocos;
            fonte = this.altoEmLpF(larguraFinal, blocos_hor);

        } else if (tipo == "I" && nutrientes == 1) {
            blocos = 2;
            blocos_hor = 1;
            larguraFinal = this.ladoGrid(areaNutri1, blocos, tipo);
            fonte = this.altoEmLpF(larguraFinal, blocos_hor);

        } else if (tipo == "--" && nutrientes == 2) {
            blocos = 3;
            blocos_hor = 3;
            larguraFinal = this.ladoGrid(areaNutri2, blocos, tipo) * blocos;
            fonte = this.altoEmLpF(larguraFinal, blocos_hor);

        } else if (tipo == "I" && nutrientes == 2) {
            blocos = 3;
            blocos_hor = 1;
            larguraFinal = this.ladoGrid(areaNutri2, blocos, tipo);
            fonte = this.altoEmLpF(larguraFinal, blocos_hor);

        } else if (tipo == "L" && nutrientes == 2) {
            blocos = 3;
            blocos_hor = 2;
            larguraFinal = this.ladoGrid(areaNutri2, blocos, tipo) * blocos_hor;
            fonte = this.altoEmLpF(larguraFinal, blocos_hor);

        } else if (tipo == "r" && nutrientes == 2) {
            blocos = 3;
            blocos_hor = 2;
            larguraFinal = this.ladoGrid(areaNutri2, blocos, tipo) * blocos;
            fonte = this.altoEmLpF(larguraFinal, blocos_hor);

        } else if (tipo == "q" && nutrientes == 2) {
            blocos = 3;
            blocos_hor = 2;
            larguraFinal = this.ladoGrid(areaNutri2, blocos, tipo) * blocos_hor;
            fonte = this.altoEmLpF(larguraFinal, blocos_hor);

        } else if (tipo == "r" && nutrientes == 2) {
            blocos = 3;
            blocos_hor = 2;
            larguraFinal = this.ladoGrid(areaNutri2, blocos, tipo) * blocos_hor;
            fonte = this.altoEmLpF(larguraFinal, blocos_hor);

        } else if (tipo == "r" && nutrientes == 3) {
            blocos = 4;
            blocos_hor = 2;
            larguraFinal = this.ladoGrid(areaNutri3, blocos, tipo) * blocos_hor;
            fonte = this.altoEmLpF(larguraFinal, blocos_hor);

        } else if (tipo == "0" && nutrientes == 3) {
            blocos = 4;
            blocos_hor = 2;
            larguraFinal = this.ladoGrid(areaNutri3, blocos, tipo) * blocos_hor;
            fonte = this.altoEmLpF(larguraFinal, blocos_hor);

        } else if (tipo == "I" && nutrientes == 3) {
            blocos = 4;
            blocos_hor = 1;
            larguraFinal = this.ladoGrid(areaNutri3, blocos, tipo);
            fonte = this.altoEmLpF(larguraFinal, blocos_hor);

        } else if (tipo == "--" && nutrientes == 3) {
            blocos = 4;
            blocos_hor = 4;
            larguraFinal = this.ladoGrid(areaNutri3, blocos, tipo) * blocos_hor;
            fonte = this.altoEmLpF(larguraFinal, blocos_hor);

        } else if (tipo == "q" && nutrientes == 3) {
            blocos = 4;
            blocos_hor = 2;
            larguraFinal = this.ladoGrid(areaNutri3, blocos, tipo) * blocos_hor;
            fonte = this.altoEmLpF(larguraFinal, blocos_hor);

        } else if (tipo == "L" && nutrientes == 3) {
            blocos = 4;
            blocos_hor = 3;
            larguraFinal = this.ladoGrid(areaNutri3, blocos, tipo) * blocos;
            fonte = this.altoEmLpF(larguraFinal, blocos_hor);

        } else {
            larguraFinal = 0;
        }

        // Verifica se a largura não está impondo fonte acima ou abaixo da legislação
        if (larguraFinal != 0) {
            if (fonte < minFont) larguraFinal = this.altoemFpL(larguraFinal, blocos_hor, minFont)
            else if (fonte > maxFont) larguraFinal = this.altoemFpL(larguraFinal, blocos_hor, maxFont)
            larguramax = this.altoemFpL(larguraFinal, blocos_hor, maxFont)
            larguraFinal = larguraFinal.toFixed(2);
        }

        return [larguraFinal, larguramax];
    }
}