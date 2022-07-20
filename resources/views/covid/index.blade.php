<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Covid Updates') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="overflow-x-auto relative">
                        <h1 class="text-xl text-bold">Covid Cases</h1>
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <tbody>
                                @forelse ($covidCase as $index => $value)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $index }}
                                        </th>
                                        <td class="py-4 px-6">
                                            {{ $value }}
                                        </td>
                                    </tr>
                                @empty

                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="overflow-x-auto relative shadow-md sm:rounded-lg mt-10 mb-2">
                        <h1 class="text-xl text-bold">Covid Tests Records</h1>
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="py-3 px-6">
                                        Date
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        PCR Count
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Antigen Count
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($covidTests as $covidTest)
                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $covidTest->date }}
                                        </th>
                                        <td class="py-4 px-6">
                                            {{ $covidTest->pcr_count }}
                                        </td>
                                        <td class="py-4 px-6">
                                            {{ $covidTest->antigen_count }}
                                        </td>
                                    </tr>
                                @empty

                                @endforelse
                            </tbody>
                        </table>
                    </div>


                    {{ $covidTests->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
