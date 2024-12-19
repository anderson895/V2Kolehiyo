document.querySelectorAll('.filter-btn').forEach((button) => {
    button.addEventListener('click', (e) => {
        const category = e.target.getAttribute('data-category');
        document.querySelectorAll('.portfolio-item').forEach((item) => {
            if (category === 'all' || item.getAttribute('data-category') === category) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
        document.querySelectorAll('.filter-btn').forEach((btn) => btn.classList.remove('active'));
        e.target.classList.add('active');
    });
});

const searchInput = document.getElementById('search');
searchInput.addEventListener('input', () => {
    const query = searchInput.value.toLowerCase();
    document.querySelectorAll('.portfolio-item').forEach((item) => {
        const title = item.querySelector('.item-details h3').textContent.toLowerCase();
        item.style.display = title.includes(query) ? 'block' : 'none';
    });
});