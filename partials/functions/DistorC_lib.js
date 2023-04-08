function distorC(medidaCliche, medidaCilindro, repeticoes) {
    return isNaN((medidaCilindro * 100) / (medidaCliche * repeticoes))
        ? '0.000'
        : ((medidaCilindro * 100) / (medidaCliche * repeticoes)).toFixed(3);
}
module.exports = distorC;
