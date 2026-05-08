// Объект с шаблонами для разных типов данных
const templates = {
    companies: (c) => `<li><strong>${c.name}</strong> — ${c.contact_info}</li>`,
    universities: (u) => `<li><strong>${u.name}</strong> (${u.city}) — ${u.contact_info}</li>`,
    students: (s) => `<li><strong>${s.full_name}</strong> (Курс: ${s.course}, Почта: ${s.email})</li>`,
    directions: (d) => `<li><strong>${d.name}</strong> (${d.description})</li>`
};

// Универсальная функция смены Action у формы
function initFormAction(selectId, formId, baseUrl) {
    const select = document.getElementById(selectId);
    const form = document.getElementById(formId);

    if (select && form) {
        select.addEventListener('change', function() {
            const id = this.value;
            form.action = id ? `${baseUrl.replace(/\/$/, '')}/${id}` : '';
            console.log('Action изменен на:', form.action); 
        });
    } else {
        console.error(`Элементы не найдены: ${selectId} или ${formId}`);
    }
}



// Универсальная загрузка и вывод данных
async function fetchAndRender(url, containerId, templateKey) {
    const container = document.getElementById(containerId);
    if (!container) return;

    try {
        const response = await fetch(url, { headers: { 'Accept': 'application/json' } });
        const data = await response.json();

        if (!data.length) {
            container.innerHTML = '<p>Данных пока нет.</p>';
            return;
        }

        
        const html = data.map(templates[templateKey]).join('');
        container.innerHTML = `<ul>${html}</ul>`;
    } catch (error) {
        console.error('Ошибка загрузки:', error);
        container.innerHTML = '<p>Ошибка при загрузке данных.</p>';
    }
}

// Инициализация при загрузке страницы
document.addEventListener('DOMContentLoaded', () => {
    // Логика для Компаний
    if (document.getElementById('companies-list')) {
        fetchAndRender('/companies', 'companies-list', 'companies');
        initFormAction('update-company-select', 'update-form', '/companies');
        initFormAction('delete-company-select', 'delete-form', '/companies');
    }

    // Логика для Университетов
    if (document.getElementById('universities-list')) {
        fetchAndRender('/universities', 'universities-list', 'universities');
        initFormAction('update-univ-select', 'update-univ-form', '/universities');
        initFormAction('delete-univ-select', 'delete-univ-form', '/universities');
    }

    if(document.getElementById('students-list')) {
        fetchAndRender('/students', 'students-list', 'students');
        initFormAction('update-student-select', 'update-form', '/students');
        initFormAction('delete-student-select', 'delete-form', '/students');
    }

    if(document.getElementById('directions-list')) {
        fetchAndRender('/directions', 'directions-list', 'directions');
        initFormAction('update-direction-select', 'update-form', '/directions');
        initFormAction('delete-direction-select', 'delete-form', '/directions');
    }
});
