<div>
  <h3 class="text-lg lg:text-2xl text-blue font-display font-bold mb-4">
    {{ $post_date }}
  </h3>
  <div>
    {!! $post_excerpt !!}
  </div>
  <div class="mt-4">
    <button
      wire:click="$emit('openModal', 'daily-market-modal', {{ json_encode(['post_id' => $post_id, 'post_date' => $post_date, 'post_content' => $post_content]) }})"
      type="button" class="button button-text">
      <span class="mr-1">Continue Reading</span> <span class="material-icons">arrow_right_alt</span>
    </button>
  </div>
</div>