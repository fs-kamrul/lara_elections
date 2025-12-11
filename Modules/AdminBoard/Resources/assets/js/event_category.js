document.addEventListener("DOMContentLoaded", function () {
    const categoryButtons = document.querySelectorAll("#event-category-filters button");
    const typeButtons = document.querySelectorAll("#event-type-filters button");
    const categorySelect = document.querySelector("#category-select");
    const typeSelect = document.querySelector("#type-select");
    const eventsGrid = document.querySelector("#all-events-grid");

    let activeCategory = "All";
    let activeType = "All";

    function loadEvents(category, type) {
        let url = "event"; // Or use route('events') if named route exists
        let params = new URLSearchParams();

        if (category !== "All") {
            params.append("category_ids[]", category);
        }
        if (type !== "All") {
            params.append("admin_types_id", type); // ✅ better to keep consistent naming
        }

        fetch(url + "?" + params.toString(), {
            headers: { "X-Requested-With": "XMLHttpRequest" }
        })
            .then(res => res.json())
            .then(data => {
                if (data.data) {
                    eventsGrid.innerHTML = data.data;
                }
            });
    }

    // Category buttons (desktop)
    categoryButtons.forEach(button => {
        button.addEventListener("click", function () {
            categoryButtons.forEach(btn => btn.classList.remove("btn-brand-violet", "shadow-sm"));
            categoryButtons.forEach(btn => btn.classList.add("btn-outline-secondary"));

            this.classList.remove("btn-outline-secondary");
            this.classList.add("btn-brand-violet", "shadow-sm");

            activeCategory = this.dataset.category;
            loadEvents(activeCategory, activeType);
        });
    });

    // Type buttons (desktop)
    typeButtons.forEach(button => {
        button.addEventListener("click", function () {
            typeButtons.forEach(btn => btn.classList.remove("btn-brand-violet", "shadow-sm"));
            typeButtons.forEach(btn => btn.classList.add("btn-outline-secondary"));

            this.classList.remove("btn-outline-secondary");
            this.classList.add("btn-brand-violet", "shadow-sm");

            activeType = this.dataset.type;
            loadEvents(activeCategory, activeType);
        });
    });

    // Mobile category select
    categorySelect.addEventListener("change", function () {
        activeCategory = this.value;
        loadEvents(activeCategory, activeType);
    });

    // Mobile type select
    typeSelect.addEventListener("change", function () {
        activeType = this.value;
        loadEvents(activeCategory, activeType);
    });
});
