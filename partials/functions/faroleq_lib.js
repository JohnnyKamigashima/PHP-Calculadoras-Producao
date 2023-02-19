module.exports = function farolEq(largura, altura, area, cilindro) {
    let Naltura = Number(altura),
        Nlargura = Number(largura),
        Narea = Number(area),
        Nareacm = 0,
        Ntier = 0,
        Nresultado = 0,
        Nareasemaforo = 0;

    if (Nlargura > 0 && Naltura > 0) {
        Narea = Nlargura * Naltura;

    }

    if (Narea > 0) {
        if (cilindro == "true") {
            Narea = Narea * 0.4;
        } else {
            Narea = Narea;
        }

        Nareacm = Narea / 100;

        if (Nareacm > 19.5 && Nareacm < 32) {
            Ntier = 1;
            Nareasemaforo = 6.25;
        } else if (Nareacm > 32 && Nareacm < 161) {
            Ntier = 2;
            Nareasemaforo = Nareacm * 0.2;
        } else {
            Ntier = 3;
            Nareasemaforo = Nareacm * 0.15;
        }
        Nresultado = Math.sqrt(Nareasemaforo);
        Nresultado = Nresultado * 10;
        Nresultado = Nresultado.toFixed(2);

        return Nresultado;
    }
}
