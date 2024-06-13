<x-app-layout>
  <div class="flex flex-col items-center justify-center">
    @if(request()->is_practice == 1)
      <p class="sm:text-8xl text-4xl text-yellow-400 mt-10 font-extrabold">れんしゅうモード</p>
    @endif

    <form method="POST" action="{{ route('omikuji.result') }}">
      @csrf
      <div class="sm:text-4xl text-2xl mt-10 mb-10">なまえを入れてボタンをおそう！</div>
      <div>
        @if(request()->is_practice == 0)
          <input type="hidden" name="is_practice" value="0"/>
        @else
          <input type="hidden" name="is_practice" value="1"/>
        @endif
        <div class="flex inline items-center justify-center mb-10">
          <p class="sm:text-4xl text-2xl">なまえ：</p>
          <x-input-lavel for='student_name':value='なまえ'/>
          <x-text-input id="student_name" name="student_name" type="text"/>
        </div>
      </div>
      
      <x-big-button>くじをひく</x-big-button>
    </form>
    @if(request()->is_practice == 0)
      <p class="sm:text-2xl text-xl mt-10 font-bold bg-yellow-400 bg-opacity-60">先生といっしょにスタートしよう！</p>
    @endif
  </div>
</x-app-layout>