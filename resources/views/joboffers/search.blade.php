@inject('carbon', 'Carbon\Carbon')
<x-app-layout>
    <div class="mt-8">
        <div class=" bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4 max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
            @foreach ($joboffers as $joboffer)
            <a href="{{route('joboffers.show',$joboffer)}}" class="flex flex-col relative shadow-2xl rounded-b-lg">
                <div class="flex-grow">
                    <div class="bg-white overflow-hidden">
                        <img class="rounded-t-sm" src="@if ($joboffer->image) {{Storage::url($joboffer->image->url)}} @endif" width="100%" height="auto" alt="Application 21">
                        <!-- Special Offer label -->
                        <button class="mr-4 absolute top-4 left-4 bg-gray-800 bg-opacity-50 rounded-full">
                            <div class="inline-flex items-center">
                                <svg class="w-3 h-3 ml-1 text-white" viewBox="0 0 12 12">
                                    <path d="M11.953 4.29a.5.5 0 00-.454-.292H6.14L6.984.62A.5.5 0 006.12.173l-6 7a.5.5 0 00.379.825h5.359l-.844 3.38a.5.5 0 00.864.445l6-7a.5.5 0 00.075-.534z"></path>
                                </svg>
                                <span class="text-white tracking-wider ml-2 mr-2 text-sm capitalize"> {{$joboffer->category->name}}</span>
                            </div>
                        </button>
                        <!-- Like button -->
                        <div class="ml-4 absolute top-4 right-4 bg-gray-800 bg-opacity-50 rounded-full">
                            <div class="inline-flex items-center">
                                <div class="inline-flex text-sm rounded-full mx-2 text-white ">$ {{$joboffer->salary}}</div>
                            </div>
                        </div>
                    </div>
                    <!-- Card Content -->
                    <div class="flex flex-col">
                        <!-- Card body -->
                        <header class="m-4">
                            <h3 class="text-slate-800 text-xl font-bold mb-2">{{$joboffer->title}}</h3>
                            <div class="text-sm leading-relaxed line-clamp-3">{{$joboffer->description}}</div>
                            <div class="flex flex-wrap justify-between items-center mt-4">
                                <div class="text-sm text-gray-500">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                        </svg>
                                        <span>{{$joboffer->location}}</span>
                                    </div>
                                </div>
                                <div class="flex items-center text-sm text-gray-500">
                                    <div class="flex items-center">
                                        <svg class="inline-block w-4 h-4 mr-1 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12 22s-8-4.5-8-11.8A8 8 0 0 1 12 2a8 8 0 0 1 8 8.2c0 7.3-8 11.8-8 11.8z" />
                                        </svg>
                                        {{$joboffer->type}}
                                    </div>
                                </div>
                            </div>
                        </header>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
</x-app-layout>
