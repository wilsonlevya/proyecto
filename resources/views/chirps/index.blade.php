<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Chirps') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                   <!--@dump($errors->get('message'))-->
                    
                    <form method="POST" action="{{ route('chirps.store') }}">
                        @csrf
                        <textarea name="message"

                            class="block w-full rounded-md border-gray-300 bg-white shadow-sm transition-colors duration-300 focus:border-indigo-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50"
                            placeholder="{{  __('What\'s on your mind') }}"
                            >{{ old('message') }}</textarea>

                            
                        
                        <!--@error('message') {{ $message }} @enderror-->

                        <x-input-error :messages="$errors->get('message')" 
                            class="mt-2"
                            />

                        <x-primary-button class="mt-4">
                           {{ __('Chirp') }}
                        </x-primary-button>
                    </form>

                </div>
            </div>      
        </div>



        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg ">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    @foreach ($chirps as $chirp)
                    <div class="p-6 flex space-x-2">
                        <svg class="h-6 w-6 text-gray-600 dark:text-gray-400 -scale-x-100">
                            <path stroke-linecap="roud" stroke-linejoin="round" d="m7.5 8.">
                        </svg>
                        <div class="flex-1">
                            <div class="flex justify-between items-center">
                                <div>
                                    <span class="text-gray-800 dark:text-gray-200">
                                        {{ $chirp->user->name }}
                                    </span>
                                    <small class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ $chirp->created_at }}</small>
                                    @if($chirp->created_at != $chirp->updated_at)
                                        <small class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('editado') }}</small> 
                                    @endif
                                    
                                    
                                </div>
                            </div>
                            <p class="mt-4 text-lg text-gray-900 dark:text-gray-100">{{ $chirp->message }}</p>
                            
                        </div>

                        @can ('update', $chirp) 
                        <x-dropdown>
                            <x-slot name="trigger">
                                <button>
                                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-300" data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z"></path>
                                    </svg>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('chirps.edit', $chirp)" >
                                    {{ __('Edit Chirp') }}
                                </x-dropdown-link>
                                <form method="POST" action="{{ route('chirps.destroy', $chirp) }}">
                                    @csrf @method('DELETE')
                                    <x-dropdown-link :href="route('chirps.destroy', $chirp)" onclick="event.preventDefault(); this.closest('form').submit();" >
                                        {{ __('Delete Chirp') }}
                                    </x-dropdown-link>                                
                                </form>
                                
                            </x-slot>

                            
                        </x-dropdown>
                        @endcan



                        
                        
                    </div>
                            
                @endforeach

                </div>
            </div>      
        </div>


        
        
    </div>

    
</x-app-layout>