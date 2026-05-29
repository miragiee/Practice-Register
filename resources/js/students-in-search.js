let allStudents = [];

function getSelectedCourse() {
    const active = document.querySelector('.course-buttons button.active');
    return active?.dataset.course ?? '';
}

function getSelectedDirection() {
    const sel = document.getElementById('direction-select');
    return sel ? sel.value : '';
}

function onlyVerified() {
    const v = document.getElementById('verified');
    return v ? v.checked : false;
}

async function fetchStudents() {
    try {
        const res = await fetch('/api/students', {
            headers: { 'Accept': 'application/json' }
        });

        if (!res.ok) throw new Error('Network response was not ok');

        allStudents = await res.json();

        populateDirections(allStudents);
        renderStudents();
    } catch (e) {
        console.error('Failed to load students:', e);
    }
}

function populateDirections(students) {
    const sel = document.getElementById('direction-select');
    if (!sel) return;

    const dirs = {};
    students.forEach(s => {
        if (s.direction && s.direction.id) dirs[s.direction.id] = s.direction.name;
    });

    sel.innerHTML = '<option value="">Все направления</option>';
    Object.keys(dirs).forEach(id => {
        const opt = document.createElement('option');
        opt.value = id;
        opt.textContent = dirs[id];
        sel.appendChild(opt);
    });
}

function sanitizeText(value) {
    return String(value ?? '').replace(/[<>]/g, '');
}

function formatCourse(course) {
    if (course === 'm') return 'Магистратура';
    if (course === null || course === undefined || course === '') return 'Не указан';

    return `${course} курс`;
}

function updateCounter(count) {
    const counter = document.querySelector('.counter-value');
    if (!counter) return;

    const label = count === 1 ? 'студент' : count >= 2 && count <= 4 ? 'студента' : 'студентов';
    counter.textContent = `${count} ${label}`;
}

function renderStudents() {
    const grid = document.querySelector('.students-grid');
    if (!grid) return;

    grid.innerHTML = '';

    const course = getSelectedCourse();
    const dir = getSelectedDirection();
    const verified = onlyVerified();

    const filtered = allStudents.filter(s => {
        const studentCourse = String(s.course ?? '');
        const matchesCourse = !course || course === studentCourse || (course === 'm' && studentCourse === 'm');
        const matchesDirection = !dir || String(s.direction?.id) === dir;
        const matchesVerified = !verified || Boolean(s.verified ?? true);

        return matchesCourse && matchesDirection && matchesVerified;
    });

    updateCounter(filtered.length);

    if (!filtered.length) {
        const empty = document.createElement('div');
        empty.className = 'empty-state';
        empty.textContent = 'Студенты не найдены по выбранным фильтрам';
        grid.appendChild(empty);
        return;
    }

    filtered.forEach(s => {
        const card = document.createElement('div');
        card.className = 'student-card';

        const skills = Array.isArray(s.skills) ? s.skills : [];
        const badgeClass = Boolean(s.verified ?? true) ? 'badge badge-green' : 'badge badge-gray';
        const badgeText = Boolean(s.verified ?? true) ? 'VERIFIED' : 'UNVERIFIED';

        card.innerHTML = `
            <div class="student-header">
                <div class="student-info">
                    <img class="student-avatar" src="https://i.pravatar.cc/100?u=${encodeURIComponent(s.email ?? '')}" alt="${sanitizeText(s.full_name)}">
                    <div>
                        <h4 class="student-name">${sanitizeText(s.full_name)}</h4>
                        <div class="student-meta">${sanitizeText(formatCourse(s.course))}, ${sanitizeText(s.direction?.name ?? '—')}</div>
                    </div>
                </div>
                <span class="${badgeClass}">${badgeText}</span>
            </div>
            <div class="card-label">Желаемая роль</div>
            <div class="student-role">${sanitizeText(s.role ?? 'Студент')}</div>
            <div class="card-label">Навыки</div>
            <div class="skills">${skills.slice(0,4).map(x => `<span>${sanitizeText(x)}</span>`).join('')}</div>
            <div class="card-actions">
                <button class="profile-button" data-id="${s.id}">Профиль</button>
                <button class="book-button" data-id="${s.id}">Забронировать</button>
            </div>
        `;

        grid.appendChild(card);
    });

    document.querySelectorAll('.profile-button').forEach(btn => {
        btn.addEventListener('click', () => {
            const id = btn.dataset.id;
            window.location.href = `/students/${id}`;
        });
    });

    document.querySelectorAll('.book-button').forEach(btn => {
        btn.addEventListener('click', async () => {
            const id = btn.dataset.id;
            if (!confirm('Подтвердите бронирование студента #' + id + '?')) return;

            try {
                const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                const res = await fetch('/reservations/book', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ student_id: id })
                });

                if (!res.ok) {
                    const text = await res.text();
                    throw new Error(text || 'Booking failed');
                }

                alert('Бронирование отправлено');
            } catch (e) {
                console.error(e);
                alert('Ошибка бронирования: ' + e.message);
            }
        });
    });
}

const courseButtons = document.querySelectorAll('.course-buttons button');
const directionSelect = document.getElementById('direction-select');
const verifiedCheckbox = document.getElementById('verified');

courseButtons.forEach(button => {
    button.addEventListener('click', () => {
        courseButtons.forEach(btn => btn.classList.remove('active'));
        button.classList.add('active');
        renderStudents();
    });
});

if (directionSelect) {
    directionSelect.addEventListener('change', () => renderStudents());
}

if (verifiedCheckbox) {
    verifiedCheckbox.addEventListener('change', () => renderStudents());
}

fetchStudents();
