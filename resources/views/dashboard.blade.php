<x-app-layout>
    <!-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> -->

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col items-center bg-white bg-opacity-50 py-10 shadow-sm rounded-lg space-y-4">
                <!-- <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div> -->
                <div class="text-2xl sm:text-6xl">くじびき</div>
                <form method="POST" action="{{ route('omikuji.start') }}">
                    @csrf
                    <input type="hidden" name="is_practice" value="0"/>
                    <x-big-button>くじをひく！</x-big-button>
                </form>
                <form method="POST" action="{{ route('omikuji.start') }}">
                <input type="hidden" name="is_practice" value="1"/>
                    @csrf
                    <x-big-button>れんしゅう</x-big-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
