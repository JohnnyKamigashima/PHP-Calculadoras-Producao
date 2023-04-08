function faroloctagono(alt, larg, area, pais, elemento) {
    let menorX = Math.sqrt(
        (0.15 * mmarea2cm(parseFloat(alt * larg))) / 4680
    ),
        MX = [
            [5, menorX, 65, 72, "SECRETARÌA DE SALUD", 3.07],
            [30, 0.016, 65, 72, "SECRETARÌA DE SALUD", 3.07],
            [60, 0.023, 65, 72, "SECRETARÌA DE SALUD", 3.07],
            [100, 0.031, 65, 72, "SECRETARÌA DE SALUD", 3.07],
            [200, 0.039, 65, 72, "SECRETARÌA DE SALUD", 3.07],
            [300, 0.047, 65, 72, "SECRETARÌA DE SALUD", 3.07],
            [301, 0.055, 65, 72, "SECRETARÌA DE SALUD", 3.07],
        ],
        PE = [
            [
                50,
                0.1,
                30,
                30,
                "Não é necessário estar na embalagem mas é obrigatório na caixa externa.<br>EVITAR SU CONSUMO EXCESIVO",
                2,
            ],
            [100, 0.067, 30, 30, "EVITAR SU CONSUMO EXCESIVO", 2],
            [200, 0.083, 30, 30, "EVITAR SU CONSUMO EXCESIVO", 2],
            [201, 0.1, 30, 30, "EVITAR SU CONSUMO EXCESIVO", 2],
        ],
        UY = [
            [30, 0, 0, 0, "Não é necessário ter, deverá estar na caixa externa", 0],
            [60, 1.5, 1, 1, ""],
            [100, 2, 1, 1, ""],
            [200, 2.5, 1, 1, ""],
            [300, 3, 1, 1, ""],
            [301, 3.5, 1, 1, ""],
        ],
        CH = [
            [
                30,
                0.12,
                0,
                0,
                "Não é necessário ter, deverá estar na caixa externa",
                1,
            ],
            [60, 1.5, 1, 1, "Pode estar em outra face da embalagem <br>MINSAL", 0.08],
            [100, 2, 1, 1, "Ministerio de Salud", 0.06],
            [200, 2.5, 1, 1, "Ministerio de Salud", 0.048],
            [300, 3, 1, 1, "Ministerio de Salud", 0.04],
            [301, 3.5, 1, 1, "Ministerio de Salud", 0.034],
        ];

    alt = mm2cm(parseFloat(alt));
    larg = mm2cm(parseFloat(larg));

    let areaFOP5 = alt * larg;

    console.log("altura: " + alt + " largura: " + larg);
    console.log("Area = " + areaFOP5);
    console.log("menorx = " + menorX);
    if (pais == "MX") {
        document.getElementById(elemento).innerHTML =
            MX[verifica_octagono(MX, areaFOP5)][4] +
            " altura mínima de " +
            cm2mm(
                MX[verifica_octagono(MX, areaFOP5)][5] *
                MX[verifica_octagono(MX, areaFOP5)][1]
            ).toFixed(2) +
            " mm";
        console.log(
            MX[verifica_octagono(MX, areaFOP5)][4] +
            " altura mínima de " +
            cm2mm(
                MX[verifica_octagono(MX, areaFOP5)][5] *
                MX[verifica_octagono(MX, areaFOP5)][1]
            ) +
            " mm"
        );
        return cm2mm(
            MX[verifica_octagono(MX, areaFOP5)][1] *
            MX[verifica_octagono(MX, areaFOP5)][2]
        ).toFixed(2);
    } else if (pais == "PE") {
        document.getElementById(elemento).innerHTML =
            PE[verifica_octagono(PE, areaFOP5)][4] +
            " altura mínima de " +
            cm2mm(
                PE[verifica_octagono(PE, areaFOP5)][5] *
                PE[verifica_octagono(PE, areaFOP5)][1]
            ).toFixed(2) +
            " mm";
        return cm2mm(
            PE[verifica_octagono(PE, areaFOP5)][1] *
            PE[verifica_octagono(PE, areaFOP5)][2]
        ).toFixed(2);
    } else if (pais == "UY") {
        document.getElementById(elemento).innerHTML =
            UY[verifica_octagono(UY, areaFOP5)][4];
        return cm2mm(
            UY[verifica_octagono(UY, areaFOP5)][1] *
            UY[verifica_octagono(UY, areaFOP5)][2]
        ).toFixed(2);
    } else if (pais == "CH") {
        document.getElementById(elemento).innerHTML =
            CH[verifica_octagono(CH, areaFOP5)][4] +
            " altura mínima de " +
            cm2mm(
                CH[verifica_octagono(CH, areaFOP5)][5] *
                CH[verifica_octagono(CH, areaFOP5)][1]
            ).toFixed(2) +
            " mm";
        return cm2mm(
            CH[verifica_octagono(CH, areaFOP5)][1] *
            CH[verifica_octagono(CH, areaFOP5)][2]
        ).toFixed(2);
    }
}

function mmarea2cm(valor) {
    if (typeof valor == "number") {
        return valor / 100;
    }
};

function cm2mm(valor) {
    if (typeof valor == "number") {
        return valor * 10;
    }
}


function cmarea2mm(valor) {
    if (typeof valor == "number") {
        return valor * 100;
    }
};

function mm2cm(valor) {
    if (typeof valor == "number") {
        return valor / 10;
    }
};
function verifica_octagono(array, valor) {
    let x;
    for (x = 0; x <= array.length - 1; x++) {
        if (x < array.length - 1) {
            return x;
        }
    }
}

if (typeof module !== 'undefined') {
    module.exports = {
        verifica_octagono,
        mmarea2cm,
        cm2mm,
        cmarea2mm,
        mm2cm
    }
}