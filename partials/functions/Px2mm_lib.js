function px2mm(resolucao, px) {
    return isNaN(px / (resolucao / 25.4))
        ? '0.000'
        : (px / (resolucao / 25.4)).toFixed(2);
};

if (typeof module === "object") { module.exports = px2mm };



