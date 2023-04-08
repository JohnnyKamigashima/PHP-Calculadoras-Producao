const altoEm = require('../AltoEm_lib');
describe('Verifica altura mínima do Alto Em', () => {
    it.each([
        [300, 150, 0, 1, "I", "33.34", 34.05, 900.00],
        [300, 150, 0, 2, "--", "93.16", 97.20, 1350.00],
        [127, 180, 0, 2, "r", "46.51", 65.70, 685.80]
    ])('Altura mínima do Alto Em altura %i, largura %i', (altura, largura, area, nutrientes, tipo, largMax, largMin, areaMin) => {
        expect(altoEm(altura, largura, area, nutrientes, tipo)[0]).toBe(largMax);
        expect(altoEm(altura, largura, area, nutrientes, tipo)[1].toFixed(2)).toBe(largMin.toFixed(2));
        expect(altoEm(altura, largura, area, nutrientes, tipo)[2].toFixed(2)).toBe(areaMin.toFixed(2));
    });
});