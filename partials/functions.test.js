
test("Converts milimeter to pixel", () => {

    // Define variables
    const mm2px = require('./functions/mm2px.function');
    const milimeter = 100;
    const resolution = 300;
    const inch_2_mm = 25.4;
    const result = Math.ceil((resolution / inch_2_mm) * milimeter);

    //run
    expect(mm2px(resolution, milimeter)).toBe(result);
});

test("Converts centimeter to milimeter", () => {
    // Define variables
    const cm2mm = require('./functions/cm2mm.function');
    const centimeter = 5;
    const result = 10 * centimeter;

    //test
    expect(cm2mm(centimeter)).toBe(result);
});

test("Converts mm to cm", () => {
    const mm2cm = require('./functions/mm2cm.function');
    const mm = 10;
    const result = mm / 10;

    expect(mm2cm(mm)).toBe(result);

})

test("Converts cm2 to mm2", () => {
    const cmarea2mm = require('./functions/cmarea2mm.function');
    const cm = 20;
    const result = cm * 100;

    expect(cmarea2mm(cm)).toBe(result);
})

test("Calculate distortion", () => {
    const distorC = require('./functions/distorC.function');
    const x = 300;
    const y = 129;
    const rep = 3;
    const result = ((y * 100) / (x * rep)).toFixed(3);

    expect(distorC(x, y, rep)).toBe(result);
})

test("Calcula escala de plano", () => {
    const escala = require('./functions/escalaPlano.function');
    const x = 145;
    const y = 133;
    const result = ((y * 100) / x).toFixed(2);

    expect(escala(x, y)).toBe(result);
})

test("Converte mm2 para cm2", () => {
    const mmarea2cm = require('./functions/mmarea2cm.function');
    const mm = 300;
    const result = mm / 100;

    expect(mmarea2cm(mm)).toBe(result);
})

test("Converte pt para mm", () => {
    const pt2mm = require('./functions/pt2mm.function.js');
    const pt = 2;

    var result = (pt / 2.835).toFixed(2);
    expect(pt2mm(pt)).toBe(result);
})

test("Converte mm para pt", () => {
    const mm2pt = require('./functions/mm2pt.function.js');
    const mm = 3;

    var result = (2.835 * mm).toFixed(2);
    expect(mm2pt(mm)).toBe(result);
})

test("Converte pixel para mm", () => {
    const px2mm = require('./functions/px2mm.function');
    const resolucao = 300;
    const pixel = 2000;
    const result = (pixel / (resolucao / 25.4)).toFixed(2);

    expect(px2mm(resolucao, pixel)).toBe(result);
})

test("Calcula tamanho do icone de Altoem", () => {
    const altoEm = require('./functions/altoem.function');
    const altFOP = 200;
    const largFOP = 200;
    const nutrientes = 1;
    const areaFOP = 0;
    const tipo = "I";
    const result = [31.43, 34.05];

    expect(altoEm(altFOP, largFOP, areaFOP, nutrientes, tipo, "", "")).toBe(result);
})