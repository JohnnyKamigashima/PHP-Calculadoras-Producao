const mm2cm = require("../functions/Mm2Cm_lib")
test("Testa se a conversao de 100 mm para 10 cm esta correta", () => {
    const mm = 100
    const result = 10
    expect(mm2cm(mm)).toBe(result)
})

test("Testa se a conversao de 255 mm para 25,5 cm esta correta", () => {
    const mm = 255
    const result = 25.5
    expect(mm2cm(mm)).toBe(result)
})