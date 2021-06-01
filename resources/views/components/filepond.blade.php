<div class="mt-1" wire:ignore x-data x-init="() => {
  const post = FilePond.create($refs.{{ $attributes->get('ref') ?? 'input' }});
  post.setOptions({
    server: {
      process:(fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
        @this.upload('{{ $attributes->whereStartsWith('wire:model')->first() }}', file, load, error, progress)
      },
      revert: (filename, load) => {
        @this.removeUpload('{{ $attributes->whereStartsWith('wire:model')->first() }}', filename, load)
      },
    },
    allowFileTypeValidation: true,
    acceptedFileTypes: ['image/*'],
    allowFileSizeValidation: true,
    maxFileSize: '8MB',
  });
}">
  <input type="file" x-ref="{{ $attributes->get('ref') ?? 'input' }}" />
</div>