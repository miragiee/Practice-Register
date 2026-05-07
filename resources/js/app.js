async function loadCompanies() {
    try {
        const response = await fetch('/companies');
        const companies = await response.json();

        console.log("Данные из БД:", companies);

        const container = document.getElementById('companies-list');
        if (!container) return;

        container.innerHTML = '';

        if (companies.length === 0) {
            container.innerHTML = '<p>В базе данных пока нет компаний.</p>';
            return;
        }

        const ul = document.createElement('ul');
        companies.forEach(company => {
            const li = document.createElement('li');
            li.innerHTML = `<strong>${company.name}</strong> — ${company.contact_info}`;
            ul.appendChild(li);
        });
        container.appendChild(ul);

    } catch (error) {
        console.error('Ошибка в JS:', error);
    }
}
document.addEventListener('DOMContentLoaded', loadCompanies);
