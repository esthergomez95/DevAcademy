function filterCourses() {
    var input = document.getElementById('searchInput').value.toUpperCase();
    var category = document.getElementById('categoryFilter').value;
    var cards = document.getElementsByClassName('course-card');

    Array.from(cards).forEach(card => {
        var name = card.querySelector('.course-name').textContent.toUpperCase();
        var cat = card.getAttribute('data-category');

        if (name.includes(input) && (category === '' || category === cat)) {
            card.style.display = '';
        } else {
            card.style.display = 'none';
        }
    });
}
