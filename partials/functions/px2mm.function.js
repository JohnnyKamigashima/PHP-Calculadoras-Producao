var module = module || {};


function px2mm(resolucao, px) {
    return isNaN(px / (resolucao / 25.4))
        ? 0
        : (px / (resolucao / 25.4)).toFixed(2);
};
module.exports = px2mm;