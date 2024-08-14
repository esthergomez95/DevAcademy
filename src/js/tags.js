(function() {

    const tagsInput = document.querySelector('#tags_input');
    console.log("Hola")
    if(tagsInput) {

        const tagsDiv = document.querySelector('#tags');
        const tagsInputHidden = document.querySelector('[name="tags"]');

        let tags = [];

        // Retrieve from hidden input
        if(tagsInputHidden.value !== '') {
            tags = tagsInputHidden.value.split(',');
            displayTags();
        }

        // Listen for changes in the input
        tagsInput.addEventListener('keypress', saveTag);

        function saveTag(e) {
            if(e.keyCode === 44) {
                if(e.target.value.trim() === '' || e.target.value.length < 1) {
                    return;
                }
                e.preventDefault();
                tags = [...tags, e.target.value.trim()];
                tagsInput.value = '';
                displayTags();
            }
        }

        function displayTags() {
            tagsDiv.textContent = '';
            tags.forEach(tag => {
                console.log("displauy")

                const tagElement = document.createElement('LI');
                tagElement.classList.add('form__tag');
                tagElement.textContent = tag;
                tagElement.ondblclick = removeTag;
                tagsDiv.appendChild(tagElement);
            });
            updateHiddenInput();
        }

        function removeTag(e) {
            e.target.remove();
            tags = tags.filter(tag => tag !== e.target.textContent);
            updateHiddenInput();

        }

        function updateHiddenInput() {
            tagsInputHidden.value = tags.toString();
        }
    }

})();