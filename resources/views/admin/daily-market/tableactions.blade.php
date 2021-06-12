<div class="flex space-x-1 justify-around">

  <a href="{{ route('daily-market.edit', $id) }}" title="Edit"
    class="block rounded text-gray-500 hover:text-orange-500">
    <span class="material-icons-outlined block text-current">
      edit
    </span>
  </a>
  <form action="{{ route('daily-market.destroy', $id) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"
      class="block rounded text-gray-500 hover:text-orange-500">
      <span class="material-icons-outlined block text-current">
        delete
      </span>
    </button>
  </form>
</div>