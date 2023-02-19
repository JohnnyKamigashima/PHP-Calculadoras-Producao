module.exports = function escalaPlano(medA, medR) {
    return isNaN((medR * 100) / medA)
        ? 0
        : ((medR * 100) / medA).toFixed(2);
}