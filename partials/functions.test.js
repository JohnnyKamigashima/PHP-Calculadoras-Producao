
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
