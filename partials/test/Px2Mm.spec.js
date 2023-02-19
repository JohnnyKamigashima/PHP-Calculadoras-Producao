const px2mm = require("../functions/Px2mm_lib")

test("Testa conversão de pixel para mm", () => {
    const pixel = 300
    const milimetro = 2
    resultado = "0.17"
    expect(px2mm(pixel, milimetro)).toBe(resultado)
})