const px2mm = require("../Px2mm_lib")

describe("Testa conversão de pixel para mm", () => {
    it.each([
        [300, 2, "0.17"],
        [100, 2, "0.51"],
        [1000, 2, "0.05"]
    ])("Converte %i pixels para %i mm", (pixel, milimetro, resultado) => {
        expect(px2mm(pixel, milimetro)).toBe(resultado)
    })
})