<div>
    <h1>Путешествия</h1>
    <a href="{{ route('travels.create') }}">Добавить путешествие</a> |
    <button wire:click="toggleOnlyMy">
        {{ $onlyMy ? 'Показать путешествия других' : 'Показать только мои путешествия' }}
    </button>
    <br>
    <br>
    <hr>
    <br>

    @forelse($travels as $travel)
        <div style="margin-bottom: 24px; border-bottom: 1px solid #ccc; padding-bottom: 16px;">
            <h2>{{ $travel->title }}</h2>
            <p>Стоимость: {{ $travel->cost ?? 'Не указана' }}</p>
            <p>Геопозиция:
                широта — {{ $travel->latitude ?? '—' }},
                долгота — {{ $travel->longitude ?? '—' }}
            </p>
            @if($travel->images->count())
                <div style="display: flex; gap: 8px;">
                    @foreach($travel->images as $image)
                        <img src="{{ Storage::url($image->path) }}" alt="Фото" width="100">
                    @endforeach
                </div>
            @endif
            <div style="margin-top: 8px;">
                <a href="{{ route('travels.show', $travel) }}">Просмотр</a> |
                @if($travel->user_id === auth()->id())
                    <a href="{{ route('travels.edit', $travel) }}">Редактировать</a> |
                @endif
                <button wire:click="delete({{ $travel->id }})" onclick="return confirm('Удалить это путешествие?')">
                    Удалить
                </button>
            </div>
        </div>
    @empty
        <p>Путешествий не найдено.</p>
    @endforelse
</div>
