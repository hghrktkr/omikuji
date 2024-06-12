<x-app-layout>
  <div class="flex flex-col items-center">
    <img src="{{ asset('images/steve_bow.png') }}" style="height:calc(100vh - 320px);"/>
    <p class="mt-10 sm:text-4xl text-2xl font-extrabold mb-10">くじびきは全て終了しました…</p>
    <form method="GET" action="{{ route( 'dashboard' ) }}">
        @csrf
        <x-primary-button class="ms-3">
          終了してメニューにもどる
        </x-primary-button>
      </form>
  </div>
</x-app-layout>