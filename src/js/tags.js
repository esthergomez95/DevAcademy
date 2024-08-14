document.addEventListener('DOMContentLoaded', () => {
    const inputTags = document.querySelector('#tags_input');
    if (inputTags) {
        const tagsContainer = document.querySelector('#tags');
        const hiddenInputTags = document.querySelector('[name="tags"]');

        let tagList = [];

        // Retrieve values from the hidden input
        if (hiddenInputTags.value !== '') {
            tagList = hiddenInputTags.value.split(',');
            renderTags();
        }

        // Listen for changes in the input
        inputTags.addEventListener('keypress', handleKeyPress);

        function handleKeyPress(event) {
            if (event.key === ',') {
                if (event.target.value.trim() === '' || event.target.value.length < 1) {
                    return;
                }
                event.preventDefault();
                tagList = [...tagList, event.target.value.trim()];
                inputTags.value = '';
                renderTags();
            }
        }

        function renderTags() {
            tagsContainer.innerHTML = '';
            tagList.forEach(tag => {
                console.log("Displaying tag");

                const listItem = document.createElement('LI');
                listItem.classList.add('form__tag');
                listItem.textContent = tag;
                listItem.onclick = handleTagRemoval;
                tagsContainer.appendChild(listItem);
            });
            updateHiddenInput();
        }

        function handleTagRemoval(event) {
            event.target.remove();
            tagList = tagList.filter(tag => tag !== event.target.textContent);
            updateHiddenInput();
        }

        function updateHiddenInput() {
            hiddenInputTags.value = tagList.join(',');
        }
    }
});
