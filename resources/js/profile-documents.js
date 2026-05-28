document.addEventListener('DOMContentLoaded', () => {
    async function loadOptions(select) {
        try {
            const res = await fetch('/profile/documents/options', { headers: { 'Accept': 'application/json' } });
            if (!res.ok) throw new Error('Failed to fetch options');
            const data = await res.json();
            select.innerHTML = '<option value="">-- Выберите стажировку --</option>';
            data.forEach(item => {
                const opt = document.createElement('option');
                opt.value = item.id;
                opt.textContent = item.label;
                select.appendChild(opt);
            });
        } catch (e) {
            console.error('Options load error', e);
        }
    }

    const docForm = document.getElementById('profile-document-form');
    const select = document.getElementById('profile-student-internship-select');

    if (select) {
        loadOptions(select);
    }

    if (docForm) {
        docForm.addEventListener('submit', async (e) => {
            // let the form submit normally (multipart) to server; optionally could submit via fetch
            // basic client-side validation
            if (!select || !select.value) {
                e.preventDefault();
                alert('Выберите стажировку');
                return;
            }
        });
    }
});
