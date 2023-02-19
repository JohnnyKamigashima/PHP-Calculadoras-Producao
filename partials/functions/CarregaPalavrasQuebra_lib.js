export async function carregaPalavrasQuebra(file) {
    var palavras = await this.getFileContent(file);
    palavras = palavras.substring(1, palavras.length);
    return palavras;
}