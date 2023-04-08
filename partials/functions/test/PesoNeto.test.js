const pesoNeto = require("../PesoNeto_lib");
describe("Verifica altura mínima do Peso Neto", () => {
    it.each([
        [120, 25, 50, "EC", 1.6, "Tamanho do conteúdo pode ser baseado no peso ou no tamanho do FOP."],
    ])("Altura mínima do Peso Neto: %i", (altura, largura, peso, pais, resultado, mensagem) => {
        expect(pesoNeto(altura, largura, peso, pais)[0]).toBe(resultado);
        expect(pesoNeto(altura, largura, peso, pais)[1]).toBe(mensagem);
    })
});