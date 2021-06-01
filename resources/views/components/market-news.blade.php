<div>
  <ul>
    @foreach ( array_slice($feed_items, 0, $perPage ) as $item )
    <li class="flex border-b border-gray-200 py-4 {{ ($textSize !== 'text-lg') ? $textSize : 'text-lg' }}">
      <div class="mr-4"><span class="text-gray-500 font-semibold">{{ $item->get_date('j/m') }}</span></div>
      <div>
        <h4><a class="text-blue font-semibold hover:text-blue-light" href="{{ $item->get_permalink() }}"
            target="_blank">{{ $item->get_title() }}</a>
        </h4>
      </div>
    </li>
    @endforeach
  </ul>
</div>