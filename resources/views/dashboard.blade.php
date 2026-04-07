<x-app-layout>
    <x-slot name="title">Dashboard</x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Category tabs -->
            <div class="bg-white shadow-sm rounded-lg mb-6 overflow-x-auto">
                <div class="flex text-sm font-medium text-gray-500 px-4 py-3 gap-1">
                    <a href="{{ route('dashboard') }}"
                       class="px-3 py-1.5 rounded-full whitespace-nowrap transition
                              {{ !request('category') ? 'bg-gray-900 text-white' : 'hover:bg-gray-100 text-gray-600' }}">
                        الكل
                    </a>
                    @foreach($categories as $category)
                        <a href="{{ route('dashboard', ['category' => $category->id]) }}"
                           class="px-3 py-1.5 rounded-full whitespace-nowrap transition
                                  {{ request('category') == $category->id ? 'bg-gray-900 text-white' : 'hover:bg-gray-100 text-gray-600' }}">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Posts -->
            <div class="bg-white shadow-sm rounded-lg px-6">
                @forelse($posts as $post)
                    @include('components.post-card', ['post' => $post])
                @empty
                    <p class="text-center text-gray-400 py-16">لا توجد مقالات في هذه الفئة.</p>
                @endforelse
            </div>

            <div class="mt-6">
                {{ $posts->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</x-app-layout>



    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 text-gray-900">
                    <ul
                        class="flex flex-wrap text-sm font-medium text-center text-gray-500 dark:text-gray-400 mx-auto justify-center">

                        <li class="me-2">
                            <a href="#"
                                class="inline-block px-4 py-2 rounded-lg hover:text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-white text-white bg-blue-600 active">
                                All</a>
                        </li>
                        @foreach ($categories as $category)

                            <li class="me-2">
                                <a href="#"
                                    class="inline-block px-4 py-2 rounded-lg hover:text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-white">
                                    {{ $category->name }}
                                </a>
                            </li>
                        @endforeach

                    </ul>

                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" style="margin-top: 4vh;">
                <div class="p-4 text-gray-900">
                    @foreach ($posts as $post)


                        <div
                            class=" flex bg-neutral-primary-soft block max-w-sm p-6 border border-default rounded-base shadow-xs">
                            <div class="p-5 flex-1">
                                <a href="#">
                                    <h5 class="mt-6 mb-2 text-2xl font-semibold tracking-tight text-heading">Streamlining
                                        your
                                        design process today.</h5>
                                </a>
                                <p class="mb-6 text-body">In today’s fast-paced digital landscape, fostering seamless
                                    collaboration among Developers and IT Operations.</p>
                                <a href="#"
                                    class="inline-flex items-center text-body bg-neutral-secondary-medium box-border border border-default-medium hover:bg-neutral-tertiary-medium hover:text-heading focus:ring-4 focus:ring-neutral-tertiary shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none">
                                    Read more
                                    <svg class="w-4 h-4 ms-1.5 rtl:rotate-180 -me-0.5" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                        viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4" />
                                    </svg>
                                </a>
                            </div>
                            <a href="#"  >
                                <img class="rounded-r-lg object-cover w-48 h-48" src="https://flowbite.com/docs/images/blog/image-1.jpg" alt="" />
                            </a>
                        </div>

                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>