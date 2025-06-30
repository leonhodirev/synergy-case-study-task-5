<div>
    <h2>Редактировать путешествие</h2>
    <form wire:submit.prevent="update" enctype="multipart/form-data">
        <input type="text" wire:model="title" placeholder="Название" required>
        @error('title') <span>{{ $message }}</span> @enderror

        <input type="number" wire:model="latitude" placeholder="Широта" step="any" required>
        @error('latitude') <span>{{ $message }}</span> @enderror

        <input type="number" wire:model="longitude" placeholder="Долгота" step="any" required>
        @error('longitude') <span>{{ $message }}</span> @enderror

        <input type="number" wire:model="cost" placeholder="Стоимость" step="any">
        @error('cost') <span>{{ $message }}</span> @enderror

        <div>
            <label>Добавить новые изображения:</label>
            <input type="file" wire:model="images" multiple>
            @error('images.*') <span>{{ $message }}</span> @enderror
        </div>

        <div>
            <label>Текущие изображения:</label>
            <div style="display: flex; gap: 8px;">
                @foreach($existingImages as $image)
                    <div style="position: relative;">
                        <img src="{{ Storage::url($image->path) }}" alt="Фото" width="100">
                        <button type="button" wire:click="deleteImage({{ $image->id }})" style="position: absolute; top: 0; right: 0;">×</button>
                    </div>
                @endforeach
            </div>
        </div>

        <button type="submit">Сохранить изменения</button>
    </form>
</div>
