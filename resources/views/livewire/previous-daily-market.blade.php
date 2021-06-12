<div>
  <div class="grid grid-cols-1 md:grid-cols-2 gap-y-3 gap-x-6 lg:gap-x-8">
    @foreach($previous_posts as $post)
    <div class="w-full border-b border-gray-100 pb-2">
      <button
        wire:click="$emit('openModal', 'daily-market-modal', {{ json_encode(['post_id' => $post->id, 'post_date' => date('D, d M Y', strtotime($post->post_date)), 'post_content' => $post->content]) }})"
        type="button"
        class="flex justify-between items-center w-full focus:outline-none text-gray-500 hover:text-orange">
        <span class="text-base font-display font-medium">{{ date('D, d M Y', strtotime($post->post_date)) }}</span>
        <span>
          <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path d="M0 0h24v24H0V0z" fill="none" />
            <path
              d="M19 19H5V5h7V3H5c-1.11 0-2 .9-2 2v14c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2v-7h-2v7zM14 3v2h3.59l-9.83 9.83 1.41 1.41L19 6.41V10h2V3h-7z" />
          </svg>
        </span>
      </button>
    </div>
    @endforeach
  </div>
  <div class="mt-4">
    {{ $previous_posts->links() }}
  </div>
</div>