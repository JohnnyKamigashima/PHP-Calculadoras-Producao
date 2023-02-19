module.exports = function altoemFpL(larg, blocos, pontos) {
    let coeficiente = 0;
    if (blocos == 1) coeficiente = 2.27;
    else if (blocos == 2) coeficiente = 2.19;
    else if (blocos == 3) coeficiente = 2.16;
    else coeficiente = 2.15;
    return (pontos * coeficiente) * blocos; // retorna largura necessaria para obter esses pontos
}