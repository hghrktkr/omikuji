<x-app-layout>
  <div class="flex flex-col items-center">
    @if(request()->is_practice == 1)
      <p class="sm:text-8xl text-4xl text-yellow-400 mt-10 mb-10 font-extrabold">れんしゅうモード</p>
    @endif

    <form method="POST" action="{{ route('omikuji.result') }}">
      @csrf
      @if(request()->is_practice == 0)
        <input type="hidden" name="is_practice" value="0"/>
      @else
        <input type="hidden" name="is_practice" value="1"/>
      @endif
      <x-input-lavel for='student_name':value='なまえ'/>
      <x-text-input id="student_name" name="student_name" type="text"/>
      <x-big-button>くじをひく</x-big-button>
    </form>
  </div>
</x-app-layout>