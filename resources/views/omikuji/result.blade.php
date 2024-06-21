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

  <script>
    window.addEventListener('beforeunload', function(event) {
        // リロードしようとすると警告ダイアログを表示
        event.preventDefault();
        event.returnValue = '';
    });
  </script>

  <div class="flex flex-col items-center">

    <p class="sm:text-4xl text-2xl font-bold mb-10" id="explanation">3つのブロックから1つえらぼう！</p>
    <!-- 選択するpngイメージ -->
    <div class="container flex justify-around relative mb-8">
      <img src="{{ asset($block_left->block_path) }}" class="png_image w-1/4 cursor-pointer">
      <img src="{{ asset($block_center->block_path) }}" class="png_image w-1/4 cursor-pointer">
      <img src="{{ asset($block_right->block_path) }}" class="png_image w-1/4 cursor-pointer">
    </div>
    
    <!-- 結果表示 -->
    <div class="result hidden text-center">
      <p class="sm:text-4xl text:2xl font-extrabold mb-10">ひいたくじは…</p>
      <div class="flex inline items-center justify-center bg-white bg-opacity-20 m-5 max-h-full">
        <img src="{{ asset($image_left->image_path) }}" class="object-contain max-h-96 max-w-full w-1/4 cursor-pointer">
        <p id="result_text" class="sm:text-8xl text-4xl text-red-600 font-extrabold mb-10" data-rank="{{ $result_omikuji->rank_name }}"></p>
        <img src="{{ asset($image_right->image_path) }}" class="object-contain max-h-96 max-w-full w-1/4 cursor-pointer">
      </div>
      
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
    @vite('resources/js/omikuji.js')
  @endsection
</x-app-layout>