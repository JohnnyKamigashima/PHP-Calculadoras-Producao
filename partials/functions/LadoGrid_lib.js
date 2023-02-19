


module.exports = function ladoGrid(area, blocos, tipo) {
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



