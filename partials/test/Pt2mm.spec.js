const pt2mm = require("../functions/Pt2mm_lib")

test("Converte pontos para milimetros", () => {
    const pontos = 2
    const resultado = "0.71"
    expect(pt2mm(pontos)).toBe(resultado)
})