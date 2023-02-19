module.exports = function mm2px(resolucao, mm) {
    mm = Number(mm.replace(",", "."));
    return isNaN(Math.ceil((resolucao / 25.4) * mm)) ? 0 : Math.ceil((resolucao / 25.4) * mm);
};