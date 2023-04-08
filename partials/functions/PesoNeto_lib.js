

function pesoNeto(alt, larg, peso, pais) {
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
        [5000, 1.5],
        [20000, 2],
        [75000, 3],
        [100000, 4.5],
        [500000, 5],
        [500001, 6],
    ];
    let areaFOP = area(alt, larg);
    let mensagem;
    mensagem = "Tamanho do conteúdo pode ser baseado no peso ou no tamanho do FOP.";

    switch (pais) {
        case "PE" == "BO" == "CAM" == "RD":
            mensagem = "Tamanho do conteúdo independente.";
            return [PE_NET[0][1], mensagem];
        case "EC":
            return (areaFOP > 0)
                ? [verifica(EC_FOP, areaFOP), mensagem]
                : [verifica(EC_NET, peso), mensagem];
        case "CL":
            mensagem = "Tamanho do conteúdo baseado na altura do FOP.";
            return (alt / 36 >= 2)
                ? [alt / 36, mensagem]
                : [2, mensagem];
        case "CO":
            return (areaFOP > 0)
                ? [verifica(CO_FOP, areaFOP), mensagem]
                : [verifica(CO_NET, peso), mensagem];
        case "PR":
            mensagem = "Tamanho do conteúdo baseado na área do FOP.";
            return (areaFOP > 0)
                ? [verifica(PR_FOP, areaFOP), mensagem]
                : [0, mensagem];
        case "IC":
            mensagem = "Tamanho do conteúdo independente.";
            return [IC_NET[0][0], mensagem];
        case "MC":
            return (areaFOP > 0)
                ? [verifica(MC_FOP, areaFOP), mensagem]
                : [verifica(MC_NET, peso), mensagem];
        case "MX":
            return (areaFOP > 0)
                ? [verifica(MX_FOP, areaFOP), mensagem]
                : [verifica(MX_NET, peso), mensagem];
        default:
            return [0, mensagem];
    }
}

function verifica(array, valor) {
    let x;
    for (x = 0; x <= array.length - 1; x++) {
        if (valor <= array[x][0]) {
            return array[x][1];
        }
    }
}


function area(altura, largura) {
    if (altura != 0 && largura != 0) {
        let area = altura * largura;
        return area;
    }
}

if (typeof module === "object") { module.exports = pesoNeto; }