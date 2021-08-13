<div class="flex space-x-1 justify-around">
  <a href="{{ route('download-zip',['id'=> $id]) }}" class="inline-block rounded text-orange-500 hover:text-orange-700">
    <span class="material-icons-outlined block text-current">
      folder_shared
    </span>
  </a>
  <a href="{{ route('download-zip',['id'=> $id]) }}" class="inline-block rounded text-orange-500 hover:text-orange-700">
    <span class="material-icons-outlined block text-current">
      picture_as_pdf
    </span>
  </a>
</div>