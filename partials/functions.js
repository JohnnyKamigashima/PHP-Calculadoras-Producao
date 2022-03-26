

function removeTags(str) {
    if ((str === null) || (str === ''))
        return false;
    else
        str = str.toString();

    // Regular expression to identify HTML tags in
    // the input string. Replacing the identified
    // HTML tag with a null string.
    cleantext = str.replace(/(<(\/?(p|div|h|a|style|span|table|tr|td|tbody).*?)>)/ig, '<br>');
    cleantext = cleantext.replace(/(\ +)/, ' ');
    cleantext = cleantext.replace(/( |<br>)*/gmi, "$1");
    console.log(cleantext);
    return cleantext;
}