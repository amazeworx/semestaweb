<x-app-layout>
  <x-slot name="header">
    <div class="flex justify-between items-center">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Daily Market') }}
      </h2>
      <a href="{{ route('daily-market.create') }}" class="button button-contained button-blue">Add New Post</a>
    </div>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto mb-8 sm:px-6 lg:px-8">
      @if ($message = Session::get('success'))
      <div x-data="{ show: true }" x-show="show"
        class="text-white px-6 py-4 border-0 rounded relative mb-4 bg-green-500">
        <span class="inline-block align-middle mr-8">
          {{ $message }}
        </span>
        <button @click="show = false"
          class="absolute bg-transparent text-2xl font-semibold leading-none right-0 top-0 mt-4 mr-6 outline-none focus:outline-none">
          <span>×</span>
        </button>
      </div>
      @endif

      <livewire:admin.daily-market-data-table />
    </div>
  </div>
</x-app-layout>