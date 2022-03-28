

function removeTags(str) {
    if ((str === null) || (str === ''))
        return false;
    else
        str = str.toString();

    // Regular expression to identify HTML tags in
    // the input string. Replacing the identified
    // HTML tag with a null string.
    cleantext = str.replace(/((<(\/?(p|div|h|a|style|span|code|table|tr|td|tbody).*?)>)| ?\&nbsp\;?|\n|\r)/ig, '<br>');
    cleantext = cleantext.replace(/( ?(\n)?<br ?\/?> ?)+/gmi, '<br>');
    // cleantext = cleantext.replace(/( ?\&nbsp;|\n|\r)+/i, ' ');
    cleantext = cleantext.replace(/(\ +)/, ' ');
    return cleantext;
}