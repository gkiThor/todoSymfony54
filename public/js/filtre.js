document.addEventListener("DOMContentLoaded", function () {
    const filterAll = document.getElementById("filterAll");
    const filterDone = document.getElementById("filterDone");
    const filterNotDone = document.getElementById("filterNotDone");
    const checkboxes = document.querySelectorAll(".task-checkbox");

    function updateFilter() {
        const showAll = filterAll.checked;
        const showDone = filterDone.checked;
        const showNotDone = filterNotDone.checked;

        checkboxes.forEach(checkbox => {
            const row = checkbox.closest(".todo-row");
            const isChecked = checkbox.checked;

            if (showAll || (showDone && isChecked) || (showNotDone && !isChecked)) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    }

    filterAll.addEventListener("change", function () {
        if (filterAll.checked) {
            filterDone.checked = false;
            filterNotDone.checked = false;
        }
        updateFilter();
    });

    filterDone.addEventListener("change", function () {
        if (filterDone.checked) {
            filterAll.checked = false;
        }
        updateFilter();
    });

    filterNotDone.addEventListener("change", function () {
        if (filterNotDone.checked) {
            filterAll.checked = false;
        }
        updateFilter();
    });

    updateFilter();
});
