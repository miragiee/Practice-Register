const partnershipsBtn = document.querySelector('.partnerships-btn');
const logoutBtn = document.querySelector('.logout-button');
const editBtn = document.querySelector('.edit-btn');
const heroSection = document.querySelector('.hero-section');

function getMetaToken() {
    return document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
}

document.querySelectorAll('.practice-item').forEach(item => {
    item.addEventListener('click', () => {
        item.classList.toggle('active');
    });
});

if (partnershipsBtn) {
    partnershipsBtn.addEventListener('click', function () {
        const url = this.getAttribute('data-url');
        if (url) {
            window.location.href = url;
        }
    });
}

if (logoutBtn) {
    logoutBtn.addEventListener('click', async () => {
        const token = getMetaToken();
        if (!token) {
            alert('CSRF token not found.');
            return;
        }

        try {
            const response = await fetch('/logout', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': token,
                },
                body: JSON.stringify({}),
            });

            if (!response.ok) {
                throw new Error('Failed to logout');
            }

            window.location.href = '/auth';
        } catch (error) {
            console.error(error);
            alert('Не удалось выйти. Попробуйте снова.');
        }
    });
}

const editModal = document.getElementById('edit-modal');
const editForm = document.getElementById('university-edit-form');
const editCancel = document.getElementById('edit-cancel');
const modalClose = document.querySelector('.modal-close');
const inputName = document.getElementById('edit-name');
const inputInn = document.getElementById('edit-inn');
const inputContact = document.getElementById('edit-contact-person');
const inputPosition = document.getElementById('edit-position');
const inputPhone = document.getElementById('edit-phone');

function openEditModal() {
    const currentName = document.getElementById('university-name')?.textContent.trim() || '';
    const rawInn = document.getElementById('university-inn')?.textContent.trim() || '';
    const rawContact = document.getElementById('university-contact')?.textContent.trim() || '';
    const rawPhone = document.getElementById('university-phone')?.textContent.trim() || '';

    const currentInn = rawInn.startsWith('ИНН: ') ? rawInn.replace('ИНН: ', '').trim() : '';
    const currentContact = rawContact.startsWith('Контактное лицо: ') ? rawContact.replace('Контактное лицо: ', '').replace(/\s*\(.*\)/, '').trim() : '';
    const currentPosition = rawContact.match(/\((.*)\)/)?.[1] || '';
    const currentPhone = rawPhone.startsWith('Телефон: ') ? rawPhone.replace('Телефон: ', '').trim() : '';

    if (inputName) inputName.value = currentName;
    if (inputInn) inputInn.value = currentInn;
    if (inputContact) inputContact.value = currentContact;
    if (inputPosition) inputPosition.value = currentPosition;
    if (inputPhone) inputPhone.value = currentPhone;

    editModal?.classList.remove('hidden');
}

function closeEditModal() {
    editModal?.classList.add('hidden');
}

if (editBtn && heroSection && editModal && editForm) {
    editBtn.addEventListener('click', () => {
        openEditModal();
    });

    editCancel?.addEventListener('click', () => {
        closeEditModal();
    });

    modalClose?.addEventListener('click', () => {
        closeEditModal();
    });

    editModal.addEventListener('click', (event) => {
        if (event.target === editModal) {
            closeEditModal();
        }
    });

    editForm.addEventListener('submit', async (event) => {
        event.preventDefault();

        const token = getMetaToken();
        if (!token) {
            alert('CSRF token not found.');
            return;
        }

        const name = inputName?.value.trim() || '';
        const inn = inputInn?.value.trim() || '';
        const contactPerson = inputContact?.value.trim() || '';
        const position = inputPosition?.value.trim() || '';
        const phone = inputPhone?.value.trim() || '';

        try {
            const response = await fetch('/profile/university', {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': token,
                },
                body: JSON.stringify({
                    name,
                    inn,
                    contact_person: contactPerson,
                    position,
                    phone,
                }),
            });

            if (!response.ok) {
                const data = await response.json().catch(() => ({}));
                const message = data.message || 'Не удалось сохранить изменения';
                throw new Error(message);
            }

            window.location.reload();
        } catch (error) {
            console.error(error);
            alert(error.message || 'Не удалось обновить данные университета');
        }
    });
}
