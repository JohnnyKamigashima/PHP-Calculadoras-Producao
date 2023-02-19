export async function getFileContent(file) {
    let timestamp = new Date().getTime();
    let response = await fetch(file);
    let fileContent = await response.text();
    return fileContent;
}