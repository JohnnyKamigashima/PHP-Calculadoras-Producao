function copyToClipboard(text) {
    text = text.replace(".", ",");
    navigator.clipboard.writeText(text);
}


if (typeof module === "object") { module.exports = copyToClipboard }