function setFormAction(selectElementId, formElementId, baseUrl) {
    const selectElement = document.getElementById(selectElementId);
    const formElement = document.getElementById(formElementId);

    if (!selectElement || !formElement) return;

    selectElement.addEventListener('change', function() {
        const id = this.value;
        formElement.action = id ? `${baseUrl}/${id}` : '';
    });
}

async function loadList(url, containerId, renderFn) {
    try {
        const response = await fetch(url, { headers: { 'Accept': 'application/json' } });
        const data = await response.json();
        const container = document.getElementById(containerId);
        if (!container) return;

        container.innerHTML = data.length === 0 ? '<p>Данных пока нет.</p>' : '';
        if (data.length > 0) renderFn(container, data);
    } catch (error) {
        console.error('Ошибка загрузки:', error);
    }
}

function renderCompanies(container, companies) {
    const ul = document.createElement('ul');
    companies.forEach(c => {
        ul.innerHTML += `<li><strong>${c.name}</strong> — ${c.contact_info}</li>`;
    });
    container.appendChild(ul);
}

function renderUniversities(container, universities) {
    const ul = document.createElement('ul');
    universities.forEach(u => {
        ul.innerHTML += `<li><strong>${u.name}</strong> (${u.city}) — ${u.contact_info}</li>`;
    });
    container.appendChild(ul);
}

document.addEventListener('DOMContentLoaded', function() {
    // Если мы на странице компаний
    if (document.getElementById('companies-list')) {
        loadList('/companies', 'companies-list', renderCompanies);
        setFormAction('update-company-select', 'update-form', '/companies');
        setFormAction('delete-company-select', 'delete-form', '/companies');
    }

    // Если мы на странице университетов
    if (document.getElementById('universities-list')) {
        loadList('/universities', 'universities-list', renderUniversities);
        setFormAction('update-univ-select', 'update-univ-form', '/universities');
        setFormAction('delete-univ-select', 'delete-univ-form', '/universities');
    }
});
