module.exports = function htmlDecode(entrada) {
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