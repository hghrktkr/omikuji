<x-aapp-layout>
<section class="text-gray-600 body-font">
  <div class="container mx-auto">
    <div class="flex flex-col text-center w-full">

      @if (session('message'))

        <!-- フラッシュメッセージの表示 -->
        <div id="flash-message" class="bg-white bg-opacity-50 mb-4 text-2xl font-bold text-red-400">
          {{ session('message') }}
        </div>

        <!-- フラッシュメッセージを3秒後に非表示に -->
        <script>
          
          document.addEventListener('DOMContentLoaded', function() {
            // 3秒後に実行される関数をセット
            setTimeout(function() {
              // フラッシュメッセージの要素を取得
              var flashMessage = document.getElementById('flash-message');
              // 要素が存在する場合、その表示を非表示にする
              if (flashMessage) {
                flashMessage.style.display = 'none';
              }
            }, 3000); // 3秒後にメッセージを非表示にする
          });
        </script>
      @endif

      

      <!-- 教室一覧を取得して選択 -->
      <form action="{{ route('admin.dashboard.edit') }}" method="POST" class="sm:m-5">
        @csrf
          <label class="font-bold sm:text-2xl text-l sm:mr-5 mr-2" for="user_email">編集したい教室名を選択:</label>
          <select name="user_email" id="user_email">
              @foreach ($users as $user)
                  <option value="{{ $user->email }}" {{ isset($userEmail) && $userEmail == $user->email ? 'selected' : '' }}>
                    {{ $user->name }}
                  </option>
              @endforeach
          </select>
          <x-primary-button type="submit" class="sm:ml-20 ml-2">編集</x-primary-button>
      </form>
    </div>

    <!-- 編集画面(教室名選択後に再度レンダリングして表示) -->
    @if(isset($items))
      <form action="{{ route('admin.dashboard.update') }}" method="POST">
        @csrf

        <!-- 更新後に同じ教室の編集画面を表示するため教室emailをhiddenで送信 -->
        <input type="hidden" name="user_email" value="{{ $userEmail }}">

        <div class="lg:w-2/3 w-full mx-auto overflow-auto object-contain">
          <h1 class="font-extrabold sm:text-2xl text-xl sm:mb-10 mb-5">{{ $userEmail }}</h1>
          <table class="table-auto w-full text-left whitespace-no-wrap">
            <thead>
              <tr>
                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">くじ名</th>
                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">現在の本数</th>
                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">最後に当たった日</th>
                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">変更後の本数</th>
                <th class="w-10 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br"></th>
              </tr>
            </thead>
            <tbody syle="overflow-y:auto;">
              @foreach($items as $item)
              <tr>
                <td class="px-4 py-3">{{ $item->rank_name }}</td>
                <td class="px-4 py-3">{{ $item->quantity }}</td>
                <td class="px-4 py-3">{{ $item->updated_at }}</td>
                <td class="px-4 py-3">
                  <!-- 更新する値を入力 -->
                  <input type="number" name="quantities[{{ $item->id }}]" value="{{ $item->quantity }}" min="0" class="border rounded py-1 px-2 w-full">
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="flex pl-4 mt-4 lg:w-2/3 w-full mx-auto">
          <button type="submit" class="flex ml-auto text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded">更新</button>
        </div>
      </form>
    @endif
  </div>
</section>
</x-aapp-layout>