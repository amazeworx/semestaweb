<div class="flex flex-col mb-8">
  <h2 class="uppercase text-gray-600 font-bold">PREVIOUS DAILY MARKET</h2>
  <div>
    @foreach($previous_posts as $post)
    <div class="w-full border-b border-gray-200 py-4">
      <h3 class="text-xl text-blue font-display font-bold mt-2 mb-4">
        {{ date('D, d M Y', strtotime($post->post_date)) }}</h3>
      <div>
        {!! Helper::trimwords($post->content, 320) !!}
      </div>
      <div class="mt-2">
        <button
          wire:click="$emit('openModal', 'daily-market-modal', {{ json_encode(['post_id' => $post->id, 'post_date' => $post->post_date, 'post_content' => $post->content]) }})"
          type="button" class="button button-text">
          <span class="mr-1">Continue Reading</span> <span class="material-icons">arrow_right_alt</span>
        </button>
      </div>
    </div>
    @endforeach
  </div>
  {{ $previous_posts->links() }}
</div>