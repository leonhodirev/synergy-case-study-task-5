<section class="w-full">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">
            {{ $isEdit ? 'Редактировать путешествие' : 'Новое путешествие' }}
        </flux:heading>
        <flux:subheading size="lg" class="mb-6">
            {{ $isEdit ? 'Измените детали вашего путешествия' : 'Добавьте детали вашего путешествия' }}
        </flux:subheading>
        <flux:separator variant="subtle"/>
    </div>

    <div class="flex-1 self-stretch max-md:pt-6">
        <form wire:submit.prevent="save" class="my-6 w-full space-y-6" enctype="multipart/form-data">
            <flux:input wire:model="title" :label="__('Название')" type="text" required autofocus autocomplete="off"/>

            <div class="flex gap-4">
                <flux:input wire:model="latitude" :label="__('Широта')" type="number" step="any" required/>
                <flux:input wire:model="longitude" :label="__('Долгота')" type="number" step="any" required/>
            </div>

            <div wire:ignore>
                <div id="map" style="width: 100%; height: 400px;"></div>
            </div>

            <flux:input wire:model="cost" :label="__('Стоимость')" type="number" required step="any"/>

            <div>
                <label class="block font-medium mb-2">{{ __('Изображения мест') }}</label>
                <input type="file" wire:model="images" multiple
                       class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"/>
                @error('images.*') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            @if($isEdit && $existingImages)
                <div class="mb-4">
                    <label class="block font-medium mb-2">Загруженные изображения:</label>
                    <div class="flex gap-3 flex-wrap">
                        @foreach($existingImages as $image)
                            <div class="relative">
                                <img src="{{ Storage::url($image->path) }}" alt="Фото" width="100">
                                <button type="button" wire:click="deleteImage({{ $image->id }})"
                                        class="absolute top-0 right-0 bg-red-600 text-white px-2 py-1 rounded">×
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="flex items-center gap-4">
                <flux:button variant="primary" type="submit" class="w-full">
                    {{ $isEdit ? 'Сохранить изменения' : 'Сохранить' }}
                </flux:button>
                <x-action-message class="me-3" on="travel-created">
                    {{ __('Путешествие добавлено!') }}
                </x-action-message>
            </div>
        </form>

        @if(session('success'))
            <div class="mt-4 font-medium text-green-600">
                {{ session('success') }}
            </div>
        @endif
    </div>

    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var map = L.map('map').setView([55.751244, 37.618423], 10);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 18,
                attribution: '© OpenStreetMap'
            }).addTo(map);

            var marker = null;

            map.on('click', function (e) {
                var lat = e.latlng.lat;
                var lng = e.latlng.lng;

            // Добавляем или перемещаем маркер
                if (marker) {
                    marker.setLatLng(e.latlng);
                } else {
                    marker = L.marker(e.latlng).addTo(map);
                }

            // Передаём координаты в Livewire
            @this.set('latitude', lat);
            @this.set('longitude', lng);
            });
        });
    </script>

</section>
