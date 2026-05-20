const templates = {
    companies: (c) => `
        <tr>
            <td>${c.id}</td>
            <td>${c.name}</td>
            <td>${c.contact_info}</td>
        </tr>
    `,

    universities: (u) => `
        <tr>
            <td>${u.id}</td>
            <td>${u.name}</td>
            <td>${u.city}</td>
            <td>${u.contact_info}</td>
        </tr>
    `,

    students: (s) => `
        <tr>
            <td>${s.id}</td>
            <td>${s.full_name}</td>
            <td>${s.course}</td>
            <td>${s.email}</td>
        </tr>
    `,

    directions: (d) => `
        <tr>
            <td>${d.id}</td>
            <td>${d.name}</td>
            <td>${d.description}</td>
        </tr>
    `,

    internships: (i) => `
        <tr>
            <td>${i.id}</td>
            <td>${i.university_id}</td>
            <td>${i.start_date}</td>
            <td>${i.end_date}</td>
            <td>${i.description}</td>
        </tr>
    `,

    reservations: (r) => `
        <tr>
            <td>${r.id}</td>
            <td>${r.company_id}</td>
            <td>${r.student_id}</td>
            <td>${r.internship_id}</td>
            <td>${r.status}</td>
        </tr>
    `,

    contracts: (con) => `
        <tr>
            <td>${con.id}</td>
            <td>${con.university_id}</td>
            <td>${con.company_id}</td>
            <td>${con.start_date}</td>
            <td>${con.end_date}</td>
            <td>${con.status}</td>
        </tr>
    `,

    documents: (doc) => `
        <tr>
            <td>${doc.id}</td>
            <td>${doc.student_internship_id}</td>
            <td>${doc.file_path}</td>
            <td>${doc.type}</td>
        </tr>
    `,

    student_internships: (si) => `
        <tr>
            <td>${si.id}</td>
            <td>${si.student_id}</td>
            <td>${si.company_id}</td>
            <td>${si.internship_id}</td>
            <td>${si.status}</td>
        </tr>
    `,
};

const tableHeaders = {
    companies: ["id", "name", "contact_info"],

    universities: ["id", "name", "city", "contact_info"],

    students: ["id", "full_name", "course", "email"],

    directions: ["id", "name", "description"],

    internships: [
        "id",
        "university_id",
        "start_date",
        "end_date",
        "description",
    ],

    reservations: [
        "id",
        "company_id",
        "student_id",
        "internship_id",
        "status",
    ],

    contracts: [
        "id",
        "university_id",
        "company_id",
        "start_date",
        "end_date",
        "status",
    ],

    documents: [
        "id",
        "student_internship_id",
        "file_path",
        "type",
    ],

    student_internships: [
        "id",
        "student_id",
        "company_id",
        "internship_id",
        "status",
    ],
};

function initFormAction(selectId, formId, baseUrl) {
    const select = document.getElementById(selectId);

    const form = document.getElementById(formId);

    if (!select || !form) {
        return;
    }

    select.addEventListener("change", function () {
        const id = this.value;

        form.action = id
            ? `${baseUrl.replace(/\/$/, "")}/${id}`
            : "";
    });
}

function createTableHeader(headers) {
    return `
        <tr>
            ${headers
                .map(
                    (header) => `
                        <th data-column="${header}">
                            ${header}
                        </th>
                    `,
                )
                .join("")}
        </tr>
    `;
}

/* ======================================================
   UNIVERSAL FILTER HELPERS
====================================================== */

function getUniqueValues(data, column) {
    return [
        ...new Set(
            data
                .map((item) => item[column])
                .filter((value) => value !== null && value !== undefined),
        ),
    ].sort();
}

function createColumnFilters(headers, data) {
    return headers
        .map((header) => {
            const values = getUniqueValues(data, header);

            return `
                <div class="filter-group">

                    <label>
                        ${header}
                    </label>

                    <select class="column-filter" data-column="${header}">

                        <option value="">
                            Все
                        </option>

                        ${values
                            .map(
                                (value) => `
                                    <option value="${value}">
                                        ${value}
                                    </option>
                                `,
                            )
                            .join("")}

                    </select>

                </div>
            `;
        })
        .join("");
}

function applyColumnFilters(data, filters) {
    return data.filter((item) => {
        return Object.entries(filters).every(([column, value]) => {
            if (!value) {
                return true;
            }

            return String(item[column]) === String(value);
        });
    });
}

function filterData(data, search) {
    if (!search) {
        return data;
    }

    return data.filter((item) =>
        Object.values(item)
            .join(" ")
            .toLowerCase()
            .includes(search.toLowerCase()),
    );
}

function sortData(data, column, direction) {
    return [...data].sort((a, b) => {
        const valueA = a[column];
        const valueB = b[column];

        if (valueA < valueB) {
            return direction === "asc" ? -1 : 1;
        }

        if (valueA > valueB) {
            return direction === "asc" ? 1 : -1;
        }

        return 0;
    });
}

function renderTable(container, data, templateKey) {
    const rows = data.map(templates[templateKey]).join("");

    container.querySelector(".table-wrapper").innerHTML = `
        <table>

            <thead>
                ${createTableHeader(tableHeaders[templateKey])}
            </thead>

            <tbody>
                ${rows}
            </tbody>

        </table>
    `;
}

async function fetchAndRender(url, containerId, templateKey) {
    const container = document.getElementById(containerId);

    if (!container) {
        return;
    }

    try {
        const response = await fetch(url, {
            headers: {
                Accept: "application/json",
            },
        });

        let data = await response.json();

        if (!data.length) {
            container.innerHTML = `
                <div class="alert-warning">
                    Данных пока нет.
                </div>
            `;

            return;
        }

        container.innerHTML = `
            <div class="table-controls">

                <input
                    type="text"
                    class="table-search"
                    placeholder="Поиск..."
                >

                <select class="sort-column">
                    ${tableHeaders[templateKey]
                        .map(
                            (column) => `
                                <option value="${column}">
                                    ${column}
                                </option>
                            `,
                        )
                        .join("")}
                </select>

                <select class="sort-direction">

                    <option value="asc">
                        По возрастанию
                    </option>

                    <option value="desc">
                        По убыванию
                    </option>

                </select>

                <button class="toggle-filters-btn">
                    Показать фильтры
                </button>

                <button class="toggle-table-btn">
                    Свернуть таблицу
                </button>

            </div>

            <div class="filters-wrapper hidden">

                ${createColumnFilters(
                    tableHeaders[templateKey],
                    data,
                )}

            </div>

            <div class="table-wrapper"></div>
        `;

        const searchInput =
            container.querySelector(".table-search");

        const sortColumn =
            container.querySelector(".sort-column");

        const sortDirection =
            container.querySelector(".sort-direction");

        const toggleButton =
            container.querySelector(".toggle-table-btn");

        const toggleFiltersButton =
            container.querySelector(".toggle-filters-btn");

        const tableWrapper =
            container.querySelector(".table-wrapper");

        const filtersWrapper =
            container.querySelector(".filters-wrapper");

        const filterSelects =
            container.querySelectorAll(".column-filter");

        function getCurrentFilters() {
            const filters = {};

            filterSelects.forEach((select) => {
                filters[select.dataset.column] = select.value;
            });

            return filters;
        }

        function updateTable() {
            let filtered = [...data];

            filtered = filterData(
                filtered,
                searchInput.value,
            );

            filtered = applyColumnFilters(
                filtered,
                getCurrentFilters(),
            );

            filtered = sortData(
                filtered,
                sortColumn.value,
                sortDirection.value,
            );

            renderTable(
                container,
                filtered,
                templateKey,
            );
        }

        toggleButton.addEventListener("click", () => {
            tableWrapper.classList.toggle("hidden");

            toggleButton.textContent =
                tableWrapper.classList.contains("hidden")
                    ? "Развернуть таблицу"
                    : "Свернуть таблицу";
        });

        toggleFiltersButton.addEventListener("click", () => {
            filtersWrapper.classList.toggle("hidden");

            toggleFiltersButton.textContent =
                filtersWrapper.classList.contains("hidden")
                    ? "Показать фильтры"
                    : "Скрыть фильтры";
        });

        searchInput.addEventListener(
            "input",
            updateTable,
        );

        sortColumn.addEventListener(
            "change",
            updateTable,
        );

        sortDirection.addEventListener(
            "change",
            updateTable,
        );

        filterSelects.forEach((select) => {
            select.addEventListener(
                "change",
                updateTable,
            );
        });

        updateTable();
    } catch (error) {
        console.error(error);

        container.innerHTML = `
            <div class="alert-error">
                Ошибка загрузки данных.
            </div>
        `;
    }
}

document.addEventListener("DOMContentLoaded", () => {
    if (document.getElementById("companies-list")) {
        fetchAndRender(
            "/companies",
            "companies-list",
            "companies",
        );

        initFormAction(
            "update-company-select",
            "update-form",
            "/companies",
        );

        initFormAction(
            "delete-company-select",
            "delete-form",
            "/companies",
        );
    }

    if (document.getElementById("universities-list")) {
        fetchAndRender(
            "/universities",
            "universities-list",
            "universities",
        );

        initFormAction(
            "update-univ-select",
            "update-univ-form",
            "/universities",
        );

        initFormAction(
            "delete-univ-select",
            "delete-univ-form",
            "/universities",
        );
    }

    if (document.getElementById("students-list")) {
        fetchAndRender(
            "/students",
            "students-list",
            "students",
        );

        initFormAction(
            "update-student-select",
            "update-form",
            "/students",
        );

        initFormAction(
            "delete-student-select",
            "delete-form",
            "/students",
        );
    }

    if (document.getElementById("directions-list")) {
        fetchAndRender(
            "/directions",
            "directions-list",
            "directions",
        );

        initFormAction(
            "update-direction-select",
            "update-form",
            "/directions",
        );

        initFormAction(
            "delete-direction-select",
            "delete-form",
            "/directions",
        );
    }

    if (document.getElementById("internships-list")) {
        fetchAndRender(
            "/internships",
            "internships-list",
            "internships",
        );

        initFormAction(
            "update-internship-select",
            "update-form",
            "/internships",
        );

        initFormAction(
            "delete-internship-select",
            "delete-form",
            "/internships",
        );
    }

    if (document.getElementById("reservations-list")) {
        fetchAndRender(
            "/reservations",
            "reservations-list",
            "reservations",
        );

        initFormAction(
            "update-reservation-select",
            "update-form",
            "/reservations",
        );

        initFormAction(
            "delete-reservation-select",
            "delete-form",
            "/reservations",
        );
    }

    if (document.getElementById("contracts-list")) {
        fetchAndRender(
            "/contracts",
            "contracts-list",
            "contracts",
        );

        initFormAction(
            "update-contract-select",
            "update-form",
            "/contracts",
        );

        initFormAction(
            "delete-contract-select",
            "delete-form",
            "/contracts",
        );
    }

    if (document.getElementById("documents-list")) {
        fetchAndRender(
            "/documents",
            "documents-list",
            "documents",
        );

        initFormAction(
            "update-document-select",
            "update-form",
            "/documents",
        );

        initFormAction(
            "delete-document-select",
            "delete-form",
            "/documents",
        );
    }

    if (document.getElementById("student-internships-list")) {
        fetchAndRender(
            "/student-internships",
            "student-internships-list",
            "student_internships",
        );

        initFormAction(
            "update-student-internship-select",
            "update-form",
            "/student-internships",
        );

        initFormAction(
            "delete-student-internship-select",
            "delete-form",
            "/student-internships",
        );
    }
});
