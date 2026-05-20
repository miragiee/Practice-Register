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
    companies: `
        <tr>
            <th>ID</th>
            <th>Название</th>
            <th>Почта</th>
        </tr>
    `,

    universities: `
        <tr>
            <th>ID</th>
            <th>Название</th>
            <th>Город</th>
            <th>Почта</th>
        </tr>
    `,

    students: `
        <tr>
            <th>ID</th>
            <th>ФИО</th>
            <th>Курс</th>
            <th>Email</th>
        </tr>
    `,

    directions: `
        <tr>
            <th>ID</th>
            <th>Название</th>
            <th>Описание</th>
        </tr>
    `,

    internships: `
        <tr>
            <th>ID</th>
            <th>University ID</th>
            <th>Start</th>
            <th>End</th>
            <th>Description</th>
        </tr>
    `,

    reservations: `
        <tr>
            <th>ID</th>
            <th>Company</th>
            <th>Student</th>
            <th>Internship</th>
            <th>Status</th>
        </tr>
    `,

    contracts: `
        <tr>
            <th>ID</th>
            <th>University</th>
            <th>Company</th>
            <th>Start</th>
            <th>End</th>
            <th>Status</th>
        </tr>
    `,

    documents: `
        <tr>
            <th>ID</th>
            <th>Student Internship</th>
            <th>File Path</th>
            <th>Type</th>
        </tr>
    `,

    student_internships: `
        <tr>
            <th>ID</th>
            <th>Student</th>
            <th>Company</th>
            <th>Internship</th>
            <th>Status</th>
        </tr>
    `,
};

function initFormAction(selectId, formId, baseUrl) {
    const select = document.getElementById(selectId);

    const form = document.getElementById(formId);

    if (!select || !form) {
        return;
    }

    select.addEventListener("change", function () {
        const id = this.value;

        form.action = id ? `${baseUrl.replace(/\/$/, "")}/${id}` : "";
    });
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

        const data = await response.json();

        if (!data.length) {
            container.innerHTML = `
                <div class="alert-warning">
                    Данных пока нет.
                </div>
            `;

            return;
        }

        const rows = data.map(templates[templateKey]).join("");

        container.innerHTML = `
            <table>

                <thead>
                    ${tableHeaders[templateKey]}
                </thead>

                <tbody>
                    ${rows}
                </tbody>

            </table>
        `;
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
        fetchAndRender("/companies", "companies-list", "companies");

        initFormAction("update-company-select", "update-form", "/companies");

        initFormAction("delete-company-select", "delete-form", "/companies");
    }

    if (document.getElementById("universities-list")) {
        fetchAndRender("/universities", "universities-list", "universities");

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
        fetchAndRender("/students", "students-list", "students");

        initFormAction("update-student-select", "update-form", "/students");

        initFormAction("delete-student-select", "delete-form", "/students");
    }

    if (document.getElementById("directions-list")) {
        fetchAndRender("/directions", "directions-list", "directions");

        initFormAction("update-direction-select", "update-form", "/directions");

        initFormAction("delete-direction-select", "delete-form", "/directions");
    }

    if (document.getElementById("internships-list")) {
        fetchAndRender("/internships", "internships-list", "internships");

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
        fetchAndRender("/reservations", "reservations-list", "reservations");

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
        fetchAndRender("/contracts", "contracts-list", "contracts");

        initFormAction("update-contract-select", "update-form", "/contracts");

        initFormAction("delete-contract-select", "delete-form", "/contracts");
    }

    if (document.getElementById("documents-list")) {
        fetchAndRender("/documents", "documents-list", "documents");

        initFormAction("update-document-select", "update-form", "/documents");

        initFormAction("delete-document-select", "delete-form", "/documents");
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
