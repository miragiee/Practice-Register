document.addEventListener('DOMContentLoaded', () => {
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

});

// Fetch students from public API and render cards
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

    // clear except first
    sel.innerHTML = '<option value="">Все направления</option>';
    Object.keys(dirs).forEach(id => {
        const opt = document.createElement('option');
        opt.value = id;
        opt.textContent = dirs[id];
        sel.appendChild(opt);
    });
}

function renderStudents() {
    const grid = document.querySelector('.students-grid');
    if (!grid) return;

    grid.innerHTML = '';

    const course = getSelectedCourse();
    const dir = getSelectedDirection();
    const verified = onlyVerified();

    const filtered = allStudents.filter(s => {
        if (course && course !== String(s.course) && !(course === 'm' && s.course === 'm')) return false;
        if (dir && String(s.direction?.id) !== dir) return false;
        if (verified && !s.verified) return false;
        return true;
    });

    filtered.forEach(s => {
        const card = document.createElement('div');
        card.className = 'student-card';

        const html = `
            <div class="student-header">
                <div class="student-info">
                    <img src="https://i.pravatar.cc/100?u=${s.email}" alt="student">
                    <div>
                        <h4>${s.full_name}</h4>
                        <div class="student-meta">${s.course} курс, ${s.direction?.name ?? '—'}</div>
                    </div>
                </div>
                <span class="badge gray">ID ${s.id}</span>
            </div>
            <div class="card-label">Желаемая роль</div>
            <div class="student-role">${s.role ?? '—'}</div>
            <div class="card-label">Навыки</div>
            <div class="skills">${(s.skills || []).slice(0,4).map(x=>`<span>${x}</span>`).join('')}</div>
            <div class="card-actions">
                <button class="profile-btn" data-id="${s.id}">Профиль</button>
                <button class="book-btn" data-id="${s.id}">Забронировать</button>
            </div>
        `;

        card.innerHTML = html;
        grid.appendChild(card);
    });

    // attach handlers
    document.querySelectorAll('.profile-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const id = btn.dataset.id;
            window.location.href = `/students/${id}`;
        });
    });

    document.querySelectorAll('.book-btn').forEach(btn => {
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

document.addEventListener('DOMContentLoaded', () => {
    fetchStudents();
});
