

function pesoNeto(alt, larg, peso, pais, elemento) {
    console.log("Peso Neto: " + peso + "g");
    console.log("Altura: " + alt + "cm");
    console.log("Largura: " + larg + "cm");
    let PE_NET = [[1, 1]];
    let IC_NET = [[1, 1.6]];
    let EC_NET = [
        [50, 2],
        [200, 3],
        [1000, 4],
        [1001, 6],
    ]
    let EC_FOP = [
        [3200, 1.6],
        [16100, 3.2],
        [64500, 4.8],
        [258100, 6.2],
        [258200, 12.7],
    ]
    let CO_NET = [
        [200, 3],
        [1000, 4],
        [1001, 6],
    ]
    let CO_FOP = [
        [1600, 2],
        [10000, 3],
        [22500, 4],
        [40000, 5],
        [62500, 7],
        [90000, 9],
        [90100, 10],
    ]
    let PR_FOP = [
        [3225.8, 1.59],
        [16129, 3.17],
        [64516, 4.76],
        [258064, 6.35],
        [258065, 12.7],
    ]
    let MC_NET = [
        [50, 2],
        [200, 3],
        [1000, 4],
        [1001, 6],
    ]
    let MC_FOP = [
        [4000, 2],
        [17000, 3],
        [65000, 4.5],
        [260000, 6],
        [260001, 10],
    ]
    let MX_NET = [
        [3200, 1.5],
        [16100, 3],
        [64500, 4.5],
        [258000, 6],
        [258001, 12],
    ]
    let MX_FOP = [
        [50, 1.5],
        [200, 2],
        [750, 3],
        [1000, 4.5],
        [5000, 5],
        [5001, 6],
    ];
    let mensagemPE_BO_CAM_RD = "Tamanho do conteúdo independente.";
    let areaFOP = area(alt, larg);

    switch (pais) {
        case "PE" == "BO" == "CAM" == "RD":
            pesoNetoMensagem(mensagemPE_BO_CAM_RD, elemento);
            return PE_NET[0][1];
        case "EC":
            pesoNetoMensagem("Tamanho do conteúdo pode ser baseado no peso ou no tamanho do FOP.", elemento);
            return (areaFOP > 0)
                ? verifica(EC_FOP, areaFOP)
                : verifica(EC_NET, peso);
        case "CL":
            pesoNetoMensagem("Tamanho do conteúdo baseado na altura do FOP.", elemento);
            return (alt / 36 >= 2)
                ? alt / 36
                : 2;
        case "CO":
            pesoNetoMensagem("Tamanho do conteúdo pode ser baseado no peso ou no tamanho do FOP.", elemento);
            return (areaFOP > 0)
                ? verifica(CO_FOP, areaFOP)
                : verifica(CO_NET, peso);
        case "PR":
            pesoNetoMensagem("Tamanho do conteúdo baseado na área do FOP.", elemento);
            return (areaFOP > 0)
                ? verifica(PR_FOP, areaFOP)
                : 0;
        case "IC":
            pesoNetoMensagem("Tamanho do conteúdo independente.", elemento);
            return IC_NET[0][0];
        case "MC":
            pesoNetoMensagem("Tamanho do conteúdo pode ser baseado no peso ou no tamanho do FOP.", elemento);
            return (areaFOP > 0)
                ? verifica(MC_FOP, areaFOP)
                : verifica(MC_NET, peso);
        case "MX":
            pesoNetoMensagem("Tamanho do conteúdo pode ser baseado no peso ou no tamanho do FOP.", elemento);
            return (areaFOP > 0)
                ? verifica(MX_FOP, areaFOP)
                : verifica(MX_NET, peso);
        default:
            pesoNetoMensagem("Tamanho do conteúdo pode ser baseado no peso ou no tamanho do FOP.", elemento);
            return 0;
    }
}
function pesoNetoMensagem(mensagem, elemento) {
    document.getElementById(elemento).innerHTML = mensagem;
}

function verifica(array, valor) {
    let x;
    console.log(valor)
    for (x = 0; x <= array.length - 1; x++) {
        if (valor <= array[x][0]) {
            return array[x][1];
        }
    }
}


function area(altura, largura) {
    if (altura != 0 && largura != 0) {
        let area = altura * largura;
        console.log("Área do FOP: " + area + "cm²");
        return area;
    }
}

module.exports = pesoNeto;