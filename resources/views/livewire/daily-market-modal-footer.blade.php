<div>
  <div class="flex justify-between">
    <div>
      @if ($prev_id)
      <button
        wire:click="$emit('openModal', 'daily-market-modal', {{ json_encode(['post_id' => $prev_id, 'post_date' => date('D, d M Y', strtotime($prev_date)), 'post_content' => $prev_content]) }})"
        type="button" class="button button-text">
        <span class="material-icons">chevron_left</span> <span class="ml-1">Previous</span>
      </button>
      @endif
    </div>
    <div>
      @if ($next_id)
      <button
        wire:click="$emit('openModal', 'daily-market-modal', {{ json_encode(['post_id' => $next_id, 'post_date' => date('D, d M Y', strtotime($next_date)), 'post_content' => $next_content]) }})"
        type="button" class="button button-text">
        <span class="mr-1">Next</span> <span class="material-icons">chevron_right</span>
      </button>
      @endif
    </div>
  </div>
</div>