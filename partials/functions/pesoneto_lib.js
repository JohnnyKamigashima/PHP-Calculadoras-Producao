class Peso {
    pesoNeto(alt, larg, peso, pais, elemento) {
        let PE_NET = [[1, 1]],
            IC_NET = [[1, 1.6]],
            EC_NET = [
                [50, 2],
                [200, 3],
                [1000, 4],
                [1001, 6],
            ],
            EC_FOP = [
                [3200, 1.6],
                [16100, 3.2],
                [64500, 4.8],
                [258100, 6.2],
                [258200, 12.7],
            ],
            CO_NET = [
                [200, 3],
                [1000, 4],
                [1001, 6],
            ],
            CO_FOP = [
                [1600, 2],
                [10000, 3],
                [22500, 4],
                [40000, 5],
                [62500, 7],
                [90000, 9],
                [90100, 10],
            ],
            PR_FOP = [
                [3225.8, 1.59],
                [16129, 3.17],
                [64516, 4.76],
                [258064, 6.35],
                [258065, 12.7],
            ],
            MC_NET = [
                [50, 2],
                [200, 3],
                [1000, 4],
                [1001, 6],
            ],
            MC_FOP = [
                [4000, 2],
                [17000, 3],
                [65000, 4.5],
                [260000, 6],
                [260001, 10],
            ],
            MX_NET = [
                [3200, 1.5],
                [16100, 3],
                [64500, 4.5],
                [258000, 6],
                [258001, 12],
            ],
            MX_FOP = [
                [50, 1.5],
                [200, 2],
                [750, 3],
                [1000, 4.5],
                [5000, 5],
                [5001, 6],
            ];

        alt = alt;
        larg = larg;
        peso = peso;
        pais = pais;

        let areaFOP = alt * larg;

        if (pais == "PE" || pais == "BO" || pais == "CAM" || pais == "RD") {
            document.getElementById(elemento).innerHTML =
                "Tamanho do conteúdo independente.";
            return PE_NET[0][1];
        } else if (pais == "EC") {
            document.getElementById(elemento).innerHTML =
                "Tamanho do conteúdo pode ser baseado no peso ou no tamanho do FOP.";
            return areaFOP > 0 ? this.verifica(EC_FOP, areaFOP) : this.verifica(EC_NET, peso);
        } else if (pais == "CL") {
            document.getElementById(elemento).innerHTML =
                "Tamanho do conteúdo baseado na altura do FOP.";
            return alt / 36 >= 2 ? alt / 36 : 2;
        } else if (pais == "CO") {
            document.getElementById(elemento).innerHTML =
                "Tamanho do conteúdo pode ser baseado no peso ou no tamanho do FOP.";
            return areaFOP > 0 ? this.verifica(CO_FOP, areaFOP) : this.verifica(CO_NET, peso);
        } else if (pais == "PR") {
            document.getElementById(elemento).innerHTML =
                "Tamanho do conteúdo baseado na área do FOP.";
            return areaFOP != 0 ? this.verifica(PR_FOP, areaFOP) : 0;
        } else if (pais == "IC") {
            document.getElementById(elemento).innerHTML =
                "Tamanho do conteúdo independente.";
            return IC_NET[0][0];
        } else if (pais == "MC") {
            document.getElementById(elemento).innerHTML =
                "Tamanho do conteúdo pode ser baseado no peso ou no tamanho do FOP.";
            return areaFOP > 0 ? this.verifica(MC_FOP, areaFOP) : this.verifica(MC_NET, peso);
        } else if (pais == "MX") {
            document.getElementById(elemento).innerHTML =
                "Tamanho do conteúdo pode ser baseado no peso ou no tamanho do FOP.";
            return areaFOP > 0 ? this.verifica(MX_FOP, areaFOP) : this.verifica(MX_NET, peso);
        }
    }

    verifica(array, valor) {
        let x;
        for (x = 0; x <= array.length - 1; x++) {

            if (x < array.length - 1) {
                if (valor <= array[x][0] && x == 0) {
                    return array[x][1];
                } else if (x > 0 && array[x - 1][0] < valor && valor <= array[x][0]) {
                    return array[x][1];
                }
            } else {
                return array[x][1];
            }
        }
    }
}