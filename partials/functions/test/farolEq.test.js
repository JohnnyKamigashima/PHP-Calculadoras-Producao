const farolEq = require('../FarolEq_lib.js');
describe('Verifica altura mínima do Farol', () => {
    it.each([
        [150, 200, 0, "false", "67.08"],
        [0, 0, 30000, "false", "67.08"],
        [150, 200, 0, "true", "48.99"],
        [0, 0, 30000, "true", "48.99"]
    ])(`Altura: %i, Largura: %i, Resultado: %s`, (altura, largura, area, eCilindro, resultado) => {
        expect(farolEq(altura, largura, area, eCilindro)).toBe(resultado);
    })
});