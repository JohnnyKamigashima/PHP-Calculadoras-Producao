module.exports = function quebraLinhas(id) {
    let texto = tinymce.get(id).getContent();
    texto = this.htmlDecode(texto);
    let textoQuebraPontos = texto;
    this.carregaPalavrasQuebra("Abreviacoes.txt").then(naoQuebrarPalavras => {
        let abreviacoesRegex = new RegExp(`(((?<!(${naoQuebrarPalavras}))\\.)|(;))`, 'gim');
        textoQuebraPontos = textoQuebraPontos.replace(abreviacoesRegex, '$2<br>');
    })
    this.carregaPalavrasQuebra("QuebraLinhas.txt").then(textoQuebraLinhas => {
        let estiloRegex = RegExp('(<(strong|em)>.*)(<br>)(.*<\\/(strong|em)>)', 'gim');
        let textoQuebraLinhaRegex = new RegExp(`(${textoQuebraLinhas})`, 'gim');
        textoQuebraPontos = textoQuebraPontos.replace(textoQuebraLinhaRegex, '<br>$1');
        textoQuebraPontos = textoQuebraPontos.replace(/(<\/(strong|em)>)/gim, '$1\n');
        textoQuebraPontos = textoQuebraPontos.replace(/(<(strong|em)>)/gim, '\n$1');
        textoQuebraPontos = textoQuebraPontos.replace(/(<(?:strong|em)>.*)(<br>)(.*<\/(?:strong|em)>)/gim, '$1 $3');
        while (textoQuebraPontos.match(estiloRegex) != null) {
            textoQuebraPontos = textoQuebraPontos.replace(estiloRegex, '$1</$2>\n<$5>$4');
        }
        textoQuebraPontos = textoQuebraPontos.replace(/(<br>|<\/?p>|^ +)/gim, '\n');
        textoQuebraPontos = textoQuebraPontos.replace(/<(strong|em)>( +)?<\/(strong|em)>/gim, '');
        textoQuebraPontos = textoQuebraPontos.replace(/ +/gim, ' ');
        textoQuebraPontos = textoQuebraPontos.replace(/\n+/gim, '\n');
        textoQuebraPontos = textoQuebraPontos.replace(/^ ?(.*)$/gim, '<p>$1</p>');
        textoQuebraPontos = textoQuebraPontos.replace(/<p><\/p>/gim, '');
        tinymce.get(id).setContent(textoQuebraPontos);
    });

}