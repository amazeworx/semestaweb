<div class="modal">
  <div class="relative">
    <button wire:click="$emit('forceCloseModal')" class="absolute top-4 right-4">
      <svg class="fill-current text-gray-500 hover:text-gray-800 w-6 h-6" xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 24 24">
        <path d="M0 0h24v24H0V0z" fill="none" />
        <path
          d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z" />
      </svg>
    </button>
    <div class="modal-header pt-4 md:pt-8 px-4 md:px-8">
      <h3 class="text-xl lg:text-2xl text-blue font-display font-bold mb-4">
        {{ $post_date }}
      </h3>
    </div>
    <div class="modal-content pb-2 md:pb-4 px-4 md:px-8">
      {!! $post_content !!}
    </div>
    <div class="modal-footer border-t border-gray-100 px-2 py-2 md:px-6">
      <livewire:daily-market-modal-footer :current_id="$post_id" />
    </div>
  </div>
</div>