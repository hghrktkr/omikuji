<x-app-layout>
  <div class="flex items-center justify-center" style="height:calc(100vh - 64px);">
    <div class="w-full sm:mx-10 mx-2 mt-10 mb-10" style="height:calc(100vh - 64px); overflow-y:auto;">
      <table class="bg-gray-50 bg-opacity-80 text-left w-full rounded-md">
        <tr class="border-b-2">
          <th scope="col" class="px-6 py-3">当たった賞</th>
          <th scope="col" class="px-6 py-3">名前</th>
          <th scope="col" class="px-6 py-3">くじを引いたとき</th>
        </tr>
        <tbody>
          @foreach($histories as $history)
            <tr>
              <th scope="col" class="px-6 py-3">{{ $history->rank_name }}賞</th>
              <th scope="col" class="px-6 py-3">{{ $history->student_name }}</th>
              <th scope="col" class="px-6 py-3">{{ $history->created_at }}</th>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</x-app-layout>