<div class="reservations-container">
    <h2 class="section-title">Мои отклики</h2>

    @if($reservations->isEmpty())
        <div class="empty-reservations">
            <p>У вас пока нет откликов на стажировки.</p>
            <a href="{{ route('internships.index') }}" class="btn-primary">Найти стажировку</a>
        </div>
    @else
        <div class="reservations-list">
            @foreach($reservations as $reservation)
                <div class="reservation-card content-card">
                    <div class="reservation-header">
                        <h3 class="internship-title">
                            {{ $reservation->internship->title ?? 'Стажировка без названия' }}
                        </h3>
                        <span class="reservation-status status-{{ strtolower($reservation->status) }}">
                            {{ $reservation->status }}
                        </span>
                    </div>
                    <div class="company-name">
                        {{ $reservation->company->name ?? 'Компания не указана' }}
                    </div>
                    <div class="reservation-dates">
                        @if($reservation->internship && $reservation->internship->start_date)
                            <span>📅 {{ \Carbon\Carbon::parse($reservation->internship->start_date)->format('d.m.Y') }}
                            – {{ \Carbon\Carbon::parse($reservation->internship->end_date)->format('d.m.Y') }}</span>
                        @endif
                        <span>🕒 Отклик от: {{ $reservation->created_at->format('d.m.Y') }}</span>
                    </div>
                    <div class="reservation-actions">
                        @if($reservation->internship)
                            <a href="{{ route('internships.show', $reservation->internship_id) }}" class="btn-outline">Подробнее</a>
                        @endif
                        @if($reservation->status === 'pending')
                            <button class="btn-cancel-reservation" data-id="{{ $reservation->id }}">Отменить отклик</button>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>