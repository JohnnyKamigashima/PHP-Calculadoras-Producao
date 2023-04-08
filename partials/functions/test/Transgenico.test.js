const Transgenico = require('../Transgenico_lib');
describe('Verifica se o produto é transgênico', () => {
    it.each([
        [150, 200, "16.65"],
        [300, 150, "20.39"]
    ])(`Altura: %i, Largura: %i, Resultado: %s`, (altura, largura, resultado) => {
        expect(Transgenico(altura, largura)).toBe(resultado);
    })
});