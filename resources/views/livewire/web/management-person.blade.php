<div class="text-center">
  <button
    onclick="Livewire.emit('openModal', 'web.management-modal', {{ json_encode(['name' => $personName, 'position' => $personPosition, 'biography' => $personBiography, 'image_src' => $personImage]) }})"
    type="button" class="focus:outline-none transition transform duration-300 ease-in-out hover:scale-105">
    <div class="mb-2"><img class="rounded-full w-32 h-32 mx-auto" src="{{ $personImage }}" alt="{{ $personName }}"
        width="200" height="200" /></div>
    <h4 class="text-blue text-base font-bold leading-tight">{{ $personName }}</h4>
    <p class="text-gray-500 text-sm leading-tight">{{ $personPosition }}</p>
  </button>
</div>