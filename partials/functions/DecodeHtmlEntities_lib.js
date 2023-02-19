module.exports = function decodeHTMLEntities(text) {
    var element = document.createElement('div');
    element.innerHTML = text;
    return element.textContent;
}