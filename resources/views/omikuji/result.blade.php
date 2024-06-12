<x-app-layout>
  <style>
    .png_image{
      transition: all 0.5s ease;
    }
    .png_image.selected{
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, 10%);
      transition: 0.5s ease;
    }
  </style>

  <div class="flex flex-col items-center">

    <p class="sm:text-4xl text-2xl font-bold mb-10" id="explanation">3つのブロックから1つえらぼう！</p>
    <!-- 選択するpngイメージ -->
    <div class="container flex justify-around relative mb-8">
      <img src="{{ asset('images\tnt.png') }}" class="png_image w-1/4 cursor-pointer">
      <img src="{{ asset('images\emerald_ore.png') }}" class="png_image w-1/4 cursor-pointer">
      <img src="{{ asset('images\diamond_ore.png') }}" class="png_image w-1/4 cursor-pointer">
    </div>
    
    <!-- 結果表示 -->
    <div class="result hidden text-center">
    <p class="sm:text-4xl text:2xl font-extrabold mb-10">ひいたくじは…</p>
      <p id="result_text" class="sm:text-8xl text:4xl text-yellow-400 font-extrabold mb-10" data-rank="{{ $result_omikuji->rank_name }}"></p>

      <form method="GET" action="{{ route( 'dashboard' ) }}">
        @csrf
        <x-primary-button class="ms-3">
          終了してメニューにもどる
        </x-primary-button>
      </form>
    </div>

  </div>
  <audio id="drum" src="{{ asset('audio/drum.mp3') }}" preload="auto"></audio>
  <audio id="lvup" src="{{ asset('audio/lvup.mp3') }}" preload="auto"></audio>

  <!-- スクリプト読み込み -->
  @section('scripts')
    @vite('resources\js\omikuji.js')
  @endsection
</x-app-layout>