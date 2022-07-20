<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Help And Guid') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session()->has('success'))
                <div class="text-white bg-green-600 px-4 py-3 text-sm text-bold rounded-md">
                    {{ session()->get('success') }}
                </div>
            @endif
            @if(session()->has('errors'))
                <x-auth-validation-errors class="mb-4" :errors="session()->get('errors')" />
            @endif
            <div class="flex bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div>
                    @auth
                        <div class="p-6 bg-white border-gray-200">
                            <div class="mb-3">
                                <form action="{{ route('help-and-guid.store') }}" method="post">
                                    @csrf
                                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Your message</label>
                                    <textarea id="description"
                                        rows="4"
                                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        name="description"
                                        >
                                        {{ old('description') }}
                                    </textarea>
                                    <button type="submit" class="button text-white bg-gray-800 px-3 py-2 rounded my-3 float-right">Submit</button>
                                </form>

                            </div>
                        </div>
                    @endauth
                    @forelse ($helpAndGuids as $helpAndGuid)
                        <div class="p-6 bg-white border-b border-gray-200">
                            <div class="p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                                <div class="flex space-x-3 items-center pb-10">
                                    <img class="mb-3 w-14 h-14 rounded-full shadow-lg" src="https://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50.jpg" alt="Bonnie image"/>
                                    <div class="flex flex-col">
                                        <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{ $helpAndGuid->user->name }}</h5>
                                        <span class="text-sm text-gray-500 dark:text-gray-400">{{ $helpAndGuid->created_at->isoFormat('MMM Do Y'); }}</span>
                                    </div>
                                </div>
                                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $helpAndGuid->description }}</p>
                            </div>

                        </div>
                    @empty

                    @endforelse
                    <div class="p-6 bg-white border-b border-gray-200">
                        {{ $helpAndGuids->links() }}
                    </div>

                </div>
                <div class="p-4 m-6 w-1/2 max-h-screen bg-white rounded-lg border shadow-md sm:p-8 dark:bg-gray-800 dark:border-gray-700 overflow-y-scroll">
                    <div class="flex justify-between items-center mb-4">
                        <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Contributors</h5>
                    </div>
                    <div class="flow-root">
                            <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse ($contributors as $contributor)
                                    <li class="py-3 sm:py-4">
                                        <div class="flex items-center space-x-4">
                                            <div class="flex-shrink-0">
                                                <img class="w-8 h-8 rounded-full" src="https://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50.jpg" alt="Neil image">
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                    {{ $contributor->name }}
                                                </p>
                                                <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                    email@windster.com
                                                </p>
                                            </div>
                                            <span class="text-xs text-bold bg-green-500 text-white px-2 py-1 rounded">{{ $contributor->help_and_guids_count }}
                                                {{ $contributor->help_and_guids_count == 1 ? 'Post' : 'Posts' }}
                                            </span>
                                        </div>
                                    </li>

                                @empty

                                @endforelse
                            </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
