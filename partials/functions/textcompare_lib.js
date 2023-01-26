class TextCompare {

    decodeHTMLEntities(text) {
        var element = document.createElement('div');
        element.innerHTML = text;
        return element.textContent;
    }

    async carregaPalavrasQuebra(file) {
        var palavras = await this.getFileContent(file);
        palavras = palavras.substring(1, palavras.length);
        return palavras;
    }

    async getFileContent(file) {
        let timestamp = new Date().getTime();
        let response = await fetch(file);
        let fileContent = await response.text();
        return fileContent;
    }

    htmlDecode(entrada) {
        let caracteres = [
            ["À", "&Agrave;"],
            ["Á", "&Aacute;"],
            ["Â", "&Acirc;"],
            ["Ã", "&Atilde;"],
            ["Ä", "&Auml;"],
            ["Å", "&Aring;"],
            ["Æ", "&AElig;"],
            ["Ç", "&Ccedil;"],
            ["È", "&Egrave;"],
            ["É", "&Eacute;"],
            ["Ê", "&Ecirc;"],
            ["Ë", "&Euml;"],
            ["Ì", "&Igrave;"],
            ["Í", "&Iacute;"],
            ["Î", "&Icirc;"],
            ["Ï", "&Iuml;"],
            ["Ñ", "&Ntilde;"],
            ["Ò", "&Ograve;"],
            ["Ó", "&Oacute;"],
            ["Ô", "&Ocirc;"],
            ["Õ", "&Otilde;"],
            ["Ö", "&Ouml;"],
            ["Ø", "&Oslash;"],
            ["Ù", "&Ugrave;"],
            ["Ú", "&Uacute;"],
            ["Û", "&Ucirc;"],
            ["Ü", "&Uuml;"],
            ["Ý", "&Yacute;"],
            ["ß", "&szlig;"],
            ["à", "&agrave;"],
            ["á", "&aacute;"],
            ["â", "&acirc;"],
            ["ã", "&atilde;"],
            ["ä", "&auml;"],
            ["å", "&aring;"],
            ["æ", "&aelig;"],
            ["ç", "&ccedil;"],
            ["è", "&egrave;"],
            ["é", "&eacute;"],
            ["ê", "&ecirc;"],
            ["ë", "&euml;"],
            ["ì", "&igrave;"],
            ["í", "&iacute;"],
            ["î", "&icirc;"],
            ["ï", "&iuml;"],
            ["ð", "&eth;"],
            ["ñ", "&ntilde;"],
            ["ò", "&ograve;"],
            ["ó", "&oacute;"],
            ["ô", "&ocirc;"],
            ["õ", "&otilde;"],
            ["ö", "&ouml;"],
            ["ù", "&ugrave;"],
            ["ú", "&uacute;"],
            ["û", "&ucirc;"],
            ["ü", "&uuml;"],
            ["ý", "&yacute;"],
            ["ÿ", "&yuml;"],
            [">", "&gt;"],
            ["<", "&lt;"],
            ["&", "&amp;"],
            ["-", "&ndash;"]

        ];
        caracteres.forEach((element) => {
            let reg = new RegExp(`(${element[1]})`, "g");
            entrada = entrada.replace(reg, element[0]);
        });
        return entrada;
    }

    quebraLinhas(id) {
        let texto = tinymce.get(id).getContent();
        texto = this.htmlDecode(texto);
        let textoQuebraPontos = texto;
        this.carregaPalavrasQuebra("Abreviacoes.txt").then(naoQuebrarPalavras => {
            textoQuebraPontos = textoQuebraPontos.replace(new RegExp(`((?<!(${naoQuebrarPalavras}))\\.|;)`, 'gim'), '$1<br>');
            textoQuebraPontos = textoQuebraPontos.replace(/(<br>)+/gim, '<br>');
        })
        this.carregaPalavrasQuebra("QuebraLinhas.txt").then(quebrarPalavras => {
            let textoQuebraPalavras = textoQuebraPontos.replace(new RegExp(`(${quebrarPalavras})`, `gi`), '<br>$1');
            textoQuebraPalavras = textoQuebraPalavras.replace(`/(<p class="p2">&nbsp;<\\/p >| (<br>)+|<p>&nbsp;<\\/p>|<p>&nbsp;<br><\\/p>|\n)/gim`, ' ');
            textoQuebraPalavras = textoQuebraPalavras.replace(/<br>(.*?)<br>/gi, '<br>$1<br>');
            textoQuebraPalavras = textoQuebraPalavras.replace(/(<br>)/gim, '\n$1');
            textoQuebraPalavras = textoQuebraPalavras.replace(/(<(strong|em)>)(.*?)(<br>)/gim, '$1$3<\/$2>$4$1');
            textoQuebraPalavras = textoQuebraPalavras.replace(/(<\/p>)(.+)(<\/(strong|em)>)/gim, '$1$3$2$3<\/$4>');
            textoQuebraPalavras = textoQuebraPalavras.replace(/\n/gim, '');
            textoQuebraPalavras = textoQuebraPalavras.replace(/^ +/gim, '^');
            textoQuebraPalavras = textoQuebraPalavras.replace(/(<br>)+/gim, '<br>');
            tinymce.get(id).setContent(textoQuebraPalavras);
        });

    }

    limpaXFDF(id) {
        let texto = tinymce.get(id).getContent();
        texto = this.htmlDecode(texto);
        let regexTextBR = new RegExp(`<br>`, "gui");
        texto = texto.replace(regexTextBR, '\n');
        regexTextBR = new RegExp(`(\n>|\n\/>)`, "gui");
        texto = texto.replace(regexTextBR, '>');

        let regexTextBold = new RegExp(`<span.*?bold.*?>(.*?)<\/.*?>`, "gui");
        texto = texto.replace(regexTextBold, '[strong]$1[/strong]');

        let regexTextItalico = new RegExp(`<span.*?italic.*?>(.*?)<\/.*?>`, "gui");
        texto = texto.replace(regexTextItalico, '[en]$1[/en]');

        let regexTextHTML = new RegExp(`<.*?>`, "gm");
        texto = texto.replace(regexTextHTML, '\n');

        let regexTextReturn = new RegExp(`(&#xD;)`, "gim");
        texto = texto.replace(regexTextReturn, '\n');

        let regexTextBoldHTML = new RegExp(`\\[(\/)?(strong|en)\\]`, "gm");
        texto = texto.replace(regexTextBoldHTML, '<$1$2>');

        let regexTextDoubleReturn = new RegExp(`\n+`, "gui");
        texto = texto.replace(regexTextDoubleReturn, '<br>');

        tinymce.get(id).setContent(texto);
    }

};