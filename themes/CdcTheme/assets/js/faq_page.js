document.addEventListener('DOMContentLoaded', () => {
    const faqQuestions = document.querySelectorAll('.faq-question');
    const searchInput = document.getElementById('searchInput');

    // Toggle FAQs
    faqQuestions.forEach(question => {
        question.addEventListener('click', () => {
            const faqItem = question.parentElement;
            const answer = faqItem.querySelector('.faq-answer');
            const icon = question.querySelector('.faq-icon');

            document.querySelectorAll('.faq-item').forEach(item => {
                if (item !== faqItem) {
                    item.querySelector('.faq-answer').classList.remove('max-h-96', 'opacity-100');
                    item.querySelector('.faq-answer').classList.add('max-h-0', 'opacity-0');
                    item.querySelector('.faq-icon').classList.remove('rotate-180');
                }
            });

            answer.classList.toggle('max-h-96');
            answer.classList.toggle('opacity-100');
            answer.classList.toggle('max-h-0');
            answer.classList.toggle('opacity-0');
            icon.classList.toggle('rotate-180');
        });
    });

    // Search functionality
    if (searchInput) {
        searchInput.addEventListener('input', (e) => {
            const searchTerm = e.target.value.toLowerCase();
            const categories = document.querySelectorAll('.faq-category');

            categories.forEach(category => {
                const items = category.querySelectorAll('.faq-item');
                let hasVisibleItems = false;

                items.forEach(item => {
                    const question = item.querySelector('.faq-question span')?.textContent.toLowerCase() || '';
                    const answer = item.querySelector('.faq-answer')?.textContent.toLowerCase() || '';

                    if (question.includes(searchTerm) || answer.includes(searchTerm)) {
                        item.style.display = 'block';
                        hasVisibleItems = true;
                    } else {
                        item.style.display = 'none';
                    }
                });

                category.style.display = hasVisibleItems ? 'block' : 'none';
            });
        });
    }
});
