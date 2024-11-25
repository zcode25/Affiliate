<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
          {{ __('Project') }}
      </h2>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <!-- Search Form -->
          <form action="{{ route('project.index') }}" method="GET" class="mb-6">
              <div class="flex items-center">
                <div class="w-10/12">
                  <input 
                      type="text" 
                      name="search" 
                      value="{{ request('search') }}" 
                      placeholder="Search for projects..." 
                      class="form-input w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-indigo-500"
                  >
                </div>
                <div class="w-2/12 pl-2">
                  <button 
                      type="submit" 
                      class="w-full text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                  >
                      Search
                  </button>
                </div>
              </div>
          </form>

          <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
              @foreach ($projects as $project)
                  <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-lg p-6">
                      <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">
                        {{ $project->created_at->format('d M Y') }}
                      </p>
                      <h3 class="mb-2 text-lg font-semibold text-gray-800 dark:text-gray-200">
                          {{ $project->project_name }}
                      </h3>
                      <div class="mb-3">
                        <span class="bg-gray-100 text-gray-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">{{ ucfirst($project->project_type) }}</span>
                        <span class="bg-purple-100 text-purple-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-purple-900 dark:text-purple-300">{{ ucfirst(trans($project->status)) }}</span>
                      </div>
                      <hr class="mb-3 h-px bg-gray-200 border-0 dark:bg-gray-700">
                      <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">
                        <span class="font-semibold">Total Value:</span> 
                        @if($project->status === 'deal')
                          Rp {{ number_format($project->total_value, 0, ',', '.') }}
                        @else
                          -
                        @endif  
                      </p>
                      <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">
                        <span class="font-semibold">Commission:</span> 
                        @if($project->status === 'deal')
                          Rp {{ number_format($project->total_value * 0.35, 0, ',', '.') }}
                        @else
                          -
                        @endif 
                      </p>
                      <hr class="mb-3 h-px bg-gray-200 border-0 dark:bg-gray-700">
                      <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">
                        <span class="font-semibold">Affiliate:</span> {{ $project->affiliate->user->name}}
                      </p>
                      <hr class="mb-3 h-px bg-gray-200 border-0 dark:bg-gray-700">
                      <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">
                          <span class="font-semibold">Klien:</span> {{ $project->client_name }}
                      </p>
                      <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">
                          <span class="font-semibold">Email:</span> {{ $project->client_email }}
                      </p>
                      <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">
                          <span class="font-semibold">Telepon:</span> {{ $project->client_phone }}
                      </p>
                      @if(Auth::user()->role === 'Admin')
                      <div class="mt-6 w-full">
                        <a href="{{ route('project.detail', $project) }}" class="block w-full text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mb-2">Detail</a>
                      </div>
                      @endif
                    
                  </div>
              @endforeach
          </div>

          <!-- Pagination Links -->
          <div class="mt-6">
              {{ $projects->links() }}
          </div>
      </div>
  </div>
</x-app-layout>
