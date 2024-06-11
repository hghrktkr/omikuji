<x-app-layout>
  <div class="sm:text-8xl text:4xl text-yellow-400 font-extrabold">{{$result_omikuji->rank_name}}賞</div>
  <div>{{$result_omikuji->quantity}}</div>

  <form method="POST" action="{{ route( 'omikuji.savehistory' ) }}">
    @csrf
    <x-input-lavel for='student_name':value='なまえ'/>
    <x-text-input id="student_name" name="student_name" type="text"/>
    <input id="rank_name" name="rank_name" type="hidden" value="{{ $result_omikuji->rank_name }}">
    <x-primary-button class="ms-3">
      終了
    </x-primary-button>
  </form>
</x-app-layout>