@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <div class="flex justify-center">
            <div class="w-full md:w-8/12 lg:w-8/12 xl:w-6/12">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <form id="searchForm" class="mb-6">
                        <div class="flex items-center border-b border-b-2 border-blue-500 py-2">
                            <input type="text" class="w-8/12 py-2 px-3 border border-gray-300 rounded-l-md focus:outline-none focus:border-blue-500"
                                   placeholder="Search" name="q" id="searchInput" value="{{ request('q') }}">
                            <button type="submit"
                                    class="w-4/12 bg-blue-500 text-white py-2 rounded-r-md focus:outline-none hover:bg-blue-700">Search
                            </button>
                        </div>
                    </form>

                    <table id="usersTable" class="w-full mb-6">
                        <thead>
                        <tr>
                            <th class="py-2 px-4 border-b border-gray-300">#</th>
                            <th class="py-2 px-4 border-b border-gray-300">Name</th>
                            <th class="py-2 px-4 border-b border-gray-300">Email</th>
                            <th class="py-2 px-4 border-b border-gray-300">Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td class="py-2 px-4 border-b border-gray-300">{{ $loop->index + 1 }}</td>
                                <td class="py-2 px-4 border-b border-gray-300">{{ $user->name }}</td>
                                <td class="py-2 px-4 border-b border-gray-300">{{ $user->email }}</td>
                                <td class="py-2 px-4 border-b border-gray-300">{{ $user->status == 'active' ? 'Active' : 'Inactive' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-2 px-4 border-b border-gray-300 text-center">No results found.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>

                    <div class="text-center mt-5">
                        {{ $users->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            var debounceTimer;

            // Bind to the input event on the search input
            $('#searchInput').on('input', function () {
                clearTimeout(debounceTimer);

                // Debounce the search function for 500 milliseconds
                debounceTimer = setTimeout(function () {
                    performSearch(); // Call the function to perform the search
                }, 500);
            });

            // Function to perform the search using AJAX
            function performSearch() {
                var searchInputValue = $('#searchInput').val();

                $.ajax({
                    url: '{{ route("index") }}',
                    type: 'GET',
                    data: { q: searchInputValue },
                    dataType: 'json',
                    success: function (data) {
                        // Update the table with the new search results
                        updateTable(data.users.data);
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }

            // Function to update the table with search results
            function updateTable(users) {
                var tableBody = $('#usersTable tbody');
                tableBody.empty();

                if (users.length > 0) {
                    $.each(users, function (index, user) {
                        var rowHtml = '<tr>' +
                            '<td class="border p-2">' + (index + 1) + '</td>' +
                            '<td class="border p-2">' + user.name + '</td>' +
                            '<td class="border p-2">' + user.email + '</td>' +
                            '<td class="border p-2">' + (user.status == 'active' ? 'Active' : 'Inactive') + '</td>' +
                            '</tr>';
                        tableBody.append(rowHtml);
                    });
                } else {
                    var noResultsRow = '<tr>' +
                        '<td colspan="4" class="border p-2 text-center">No results found.</td>' +
                        '</tr>';
                    tableBody.append(noResultsRow);
                }
            }
        });
    </script>
@endsection
