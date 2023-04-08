function Transgenico(altPDP, largPDP) {
    let Nlargura = largPDP,
        Naltura = altPDP;

    if (Nlargura > 0 && Naltura > 0) {
        let Narea = Nlargura * Naltura * 0.004;
        let Nresult = Math.sqrt((4 * Narea) / Math.sqrt(3));
        if (Nresult < 5) {
            return '5';
        } else {
            return Nresult.toFixed(2);
        }
    }
}

if (typeof module === "object") { module.exports = Transgenico }