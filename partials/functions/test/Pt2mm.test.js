const pt2mm = require("../Pt2mm_lib")

describe("Converte pontos para milimetros", () => {
    it.each([
        [2, "0.71"],
        [-6, "-2.12"],
        [1000, "352.73"]
    ])("Converte %i pontos para %s milimetros", (pontos, resultado) => {
        expect(pt2mm(pontos)).toBe(resultado)
    })
})