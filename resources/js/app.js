const templates = {
    companies: (c) => `<li><strong>${c.name}</strong> — ${c.contact_info}</li>`,
    universities: (u) =>
        `<li><strong>${u.name}</strong> (${u.city}) — ${u.contact_info}</li>`,
    students: (s) =>
        `<li><strong>${s.full_name}</strong> (Курс: ${s.course}, Почта: ${s.email})</li>`,
    directions: (d) => `<li><strong>${d.name}</strong> (${d.description})</li>`,
    internships: (i) =>
        `<li><strong>ID:</strong> ${i.id} <br><strong>University:</strong> ${i.university_id} <br><strong>Start:</strong> ${i.start_date} <br><strong>End:</strong> ${i.end_date} <br><strong>Description:</strong> ${i.description}</li>`,
    reservations: (r) =>
        `<li><strong>ID:</strong> ${r.id} <br><strong>Company:</strong> ${r.company_id} <br> <strong>Student:</strong> ${r.student_id} <br> <strong>Internship:</strong> ${r.internship_id} <br><strong>Status:</strong> ${r.status}</li>`,
    contracts: (con) =>
        `<li><strong>Контракт №${con.id}</strong> (Унив. ID: ${con.university_id}, Комп. ID: ${con.company_id}) <br> Срок: ${con.start_date} — ${con.end_date} | Status: <strong>${con.status}</strong></li>`,
    documents: (doc) =>
        `<li><strong>Документ №${doc.id}</strong> (Стажировка студента ID: ${doc.student_internship_id}) <br> Путь: ${doc.file_path} | Тип: <strong>${doc.type}</strong></li>`,
    student_internships: (si) =>
        `<li><strong>Запись №${si.id}</strong> (Студент ID: ${si.student_id}, Компания ID: ${si.company_id}, Стажировка ID: ${si.internship_id}) <br> Статус: <strong>${si.status}</strong></li>`,
};

const registerButton = document.getElementById("register-button");

if (registerButton) {
    registerButton.onclick = function () {
        const url = this.getAttribute("data-url");
        window.location.href = url;
    };
}

const companyButton = document.getElementById("register-button-company");

if (companyButton) {
    companyButton.onclick = function () {
        const url = this.getAttribute("data-url");
        window.location.href = url;
    };
}

const universityButton = document.getElementById("register-button-univ");

if (universityButton) {
    universityButton.onclick = function () {
        const url = this.getAttribute("data-url");
        window.location.href = url;
    };
}

const regSubmitButton = document.getElementById("register-submit");

if (regSubmitButton) {
    regSubmitButton.onclick = function () {
        const url = this.getAttribute("data-url");
        if (url) {
            window.location.href = url;
        }
    };
}

function initFormAction(selectId, formId, baseUrl) {
    const select = document.getElementById(selectId);
    const form = document.getElementById(formId);

    if (select && form) {
        select.addEventListener("change", function () {
            const id = this.value;
            form.action = id ? `${baseUrl.replace(/\/$/, "")}/${id}` : "";
            console.log("Action изменен на:", form.action);
        });
    } else {
        console.error(`Элементы не найдены: ${selectId} или ${formId}`);
    }
}

async function fetchAndRender(url, containerId, templateKey) {
    const container = document.getElementById(containerId);
    if (!container) return;

    try {
        const response = await fetch(url, {
            headers: { Accept: "application/json" },
        });
        const data = await response.json();

        if (!data.length) {
            container.innerHTML = "<p>Данных пока нет.</p>";
            return;
        }

        const html = data.map(templates[templateKey]).join("");
        container.innerHTML = `<ul>${html}</ul>`;
    } catch (error) {
        console.error("Ошибка загрузки:", error);
        container.innerHTML = "<p>Ошибка при загрузке данных.</p>";
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
