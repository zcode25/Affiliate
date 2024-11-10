<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
          {{ __('Project Detail') }}
      </h2>
  </x-slot>

  <div class="py-12">
      <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
              <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">
                {{ $project->created_at->format('d M Y') }}
              </p>
              <h3 class="mb-2 text-2xl font-semibold text-gray-800 dark:text-gray-200">
                {{ $project->project_name }}
              </h3>
              <div class="mb-3">
                <span class="bg-gray-100 text-gray-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">{{ ucfirst($project->project_type) }}</span>
                <span class="bg-purple-100 text-purple-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-purple-900 dark:text-purple-300">{{ ucfirst(trans($project->status)) }}</span>
              </div>
              <hr class="mb-3 h-px bg-gray-200 border-0 dark:bg-gray-700">
              <p class="text-md font-semibold text-gray-900 dark:text-gray-400 mb-1">
                Project Description
              </p>
              <p class="text-md text-gray-600 dark:text-gray-400 mb-3">
                {{ $project->project_description }}
              </p>
              <hr class="mb-3 h-px bg-gray-200 border-0 dark:bg-gray-700">
              <p class="text-md text-gray-600 dark:text-gray-400 mb-2">
                <span class="font-semibold text-gray-900">Affiliate Code</span><br> {{ $project->affiliate->affiliate_code}}
              </p>
              <p class="text-md text-gray-600 dark:text-gray-400 mb-2">
                <span class="font-semibold text-gray-900">Affiliate Name</span><br> {{ $project->affiliate->user->name}}
              </p>
              <p class="text-md text-gray-600 dark:text-gray-400 mb-3">
                <span class="font-semibold text-gray-900">Affiliate Email</span><br> {{ $project->affiliate->user->email}}
              </p>
              <hr class="mb-3 h-px bg-gray-200 border-0 dark:bg-gray-700">
              <p class="text-md text-gray-600 dark:text-gray-400 mb-2">
                <span class="font-semibold text-gray-900">Client Name</span><br> {{ $project->client_name}}
              </p>
              <p class="text-md text-gray-600 dark:text-gray-400 mb-2">
                <span class="font-semibold text-gray-900">Client Email</span><br> {{ $project->client_email}}
              </p>
              <p class="text-md text-gray-600 dark:text-gray-400 mb-3">
                <span class="font-semibold text-gray-900">Client Phone</span><br> {{ $project->client_phone}}
              </p>
              <hr class="mb-3 h-px bg-gray-200 border-0 dark:bg-gray-700">

              <!-- Update Total Value and Status Form -->
              <form action="{{ route('project.update', $project) }}" method="POST" class="mt-6">
                  @csrf
                  @method('PUT')
                  <div class="mb-5">
                    <label for="total_value" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Total Value</label>
                    <input type="number" id="total_value" name="total_value" value="{{ $project->total_value }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @error('total_value')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="mb-5">
                    <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                    <select id="status" name="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                      <option value="deal" {{ $project->status === 'deal' ? 'selected' : '' }}>Deal</option>
                      <option value="cancelled" {{ $project->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                  </div>
                  <button type="submit" class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Update Project</button>
              </form>
          </div>
      </div>
  </div>
</x-app-layout>
