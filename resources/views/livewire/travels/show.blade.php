<div>
    <h1>{{ $travel->title }}</h1>
    <p><strong>Стоимость:</strong> {{ $travel->cost ?? 'Не указана' }}</p>
    <p>
        <strong>Геопозиция:</strong>
        широта — {{ $travel->latitude ?? '—' }},
        долгота — {{ $travel->longitude ?? '—' }}
    </p>
    @if($travel->images->count())
        <div style="display: flex; gap: 12px; margin-top: 12px;">
            @foreach($travel->images as $image)
                <img src="{{ Storage::url($image->path) }}" alt="Фото" width="200">
            @endforeach
        </div>
    @endif
    <div style="margin-top: 16px;">
        <a href="{{ route('travels.edit', $travel) }}">Редактировать</a>
        <a href="{{ route('travels.index') }}">К списку путешествий</a>
    </div>
</div>
