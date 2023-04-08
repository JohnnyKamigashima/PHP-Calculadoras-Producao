const escalaPlano = require("../EscalaPlano_lib.js")

describe('Testa a escala do Plano dado tamanho atual e cota', () => {
    it.each([
        [110, 50, "45.45"],
        [-15, 50, "-333.33"],
        [45.667, 1000, "2189.77"]
    ])("Escala do Plano: %i", (medidaAtual, medidaReferencia, resultado) => {
        expect(escalaPlano(medidaAtual, medidaReferencia)).toBe(resultado)
    })
})