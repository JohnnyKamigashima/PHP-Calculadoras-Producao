function copyToClipboard(text) {
    text = text.replace(".", ",");
    navigator.clipboard.writeText(text);
}
