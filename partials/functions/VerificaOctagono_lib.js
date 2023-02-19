module.exports = function verifica_octagono(array, valor) {
    let x;
    for (x = 0; x <= array.length - 1; x++) {
        if (x < array.length - 1) {
            if (valor <= array[x][0] && x == 0) {
                return x;
            } else if (x > 0 && array[x - 1][0] < valor && valor <= array[x][0]) {
                return x;
            }
        } else {
            return x;
        }
    }
}