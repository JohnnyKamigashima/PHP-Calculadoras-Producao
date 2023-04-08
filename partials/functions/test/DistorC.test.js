const distorC = require('../DistorC_lib');
describe('Testa distorção de cilindro', () => {
    it.each([
        [550, 540, 2, "49.091"]
    ])(`Distorção de cilindro: %i`, (medidaCliche, medidaCilindro, repeticoes, resultado) => {
        expect(distorC(medidaCliche, medidaCilindro, repeticoes)).toBe(resultado);
    })
});