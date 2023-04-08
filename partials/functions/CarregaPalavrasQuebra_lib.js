export async function carregaPalavrasQuebra(file) {
    let palavras = await this.getFileContent(file);
    palavras = palavras.substring(1, palavras.length);
    return palavras;
}
if (typeof module === "object") { module.exports = carregaPalavrasQuebra }