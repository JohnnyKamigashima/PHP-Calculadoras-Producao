class Convert_mm {

    pt2mm(pt) {
        return (pt / 2.835).toFixed(2);
    };

    mm2pt(mm) {
        return (2.835 * mm).toFixed(2);
    };

    mm2px(resolucao, mm) {
        mm = Number(mm.replace(",", "."));
        return isNaN(Math.ceil((resolucao / 25.4) * mm)) ? 0 : Math.ceil((resolucao / 25.4) * mm);
    };

    px2mm(resolucao, px) {
        return isNaN(px / (resolucao / 25.4)) ? 0 : (px / (resolucao / 25.4)).toFixed(2);
    };
}
