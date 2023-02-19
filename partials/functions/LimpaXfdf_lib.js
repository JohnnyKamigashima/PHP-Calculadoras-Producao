
module.exports = function limpaXFDF(id) {
    let texto = tinymce.get(id).getContent();
    texto = this.htmlDecode(texto);
    texto = texto.replace(/<br>/gui, '\n');
    texto = texto.replace(/(\n >|\n\/>)/gui, '>');
    texto = texto.replace(/<span.*?bold.*?>(.*?)<\/.*?>/gui, '[strong]$1[/strong]');
    texto = texto.replace(/<span.*? italic.*?> (.*?) <\/.*?>/gui, '[em]$1[/em]');
    texto = texto.replace(/<.*?>/gm, '\n');
    texto = texto.replace(/(&#xD;)/gim, '\n');
    texto = texto.replace(/\[(\/)?(strong|en)\]/gui, '<$1$2>');
    texto = texto.replace(/\n+/gui, '<br>');
    tinymce.get(id).setContent(texto);
}
