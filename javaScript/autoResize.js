function autoResize() {
    const textarea = document.getElementById('autoHeightTextarea');
    const container = document.getElementById('dynamicContainer');
    textarea.style.height = 'auto';
    textarea.style.height = textarea.scrollHeight + 'px';
    container.style.height = textarea.scrollHeight + 'px';
}