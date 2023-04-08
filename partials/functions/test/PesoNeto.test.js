const pesoNeto = require("../PesoNeto_lib");
describe.skip("Verifica altura mínima do Peso Neto", () => {
    it.each([
        [120, 25, 50, "EC", "elemento", 4.5]
    ])("Altura mínima do Peso Neto: %i", (altura, largura, peso, pais, elemento, resultado) => {
        expect(pesoNeto(altura, largura, peso, pais, elemento)).toBe(resultado);
    })

});