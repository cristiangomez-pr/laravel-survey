<nav>
  <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
    <div class="relative flex items-center justify-between h-16">
      <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
        <div class="hidden sm:block">
          <div class="flex space-x-4">
            @if(auth()->check())
            <a href="{{ route('surveys.admin') }}" class="text-slate-800 hover:underline @if(request()->routeIs('surveys.admin')) font-bold @else font-medium  @endif">Administrar cuestionarios</a>
            @endif
          </div>
        </div>
      </div>
      @auth
      <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
        <!-- Profile dropdown -->
        <div class="ml-3 relative">
          <div>
            <button type="button" class="flex text-sm focus:outline-none items-center space-x-2" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
              <img class="h-8 w-8 rounded-full" src="{{ auth()->user()?->profile_photo_url }}">
              <span class="text-slate-500 font-medium text-sm">{{ auth()->user()->name }}</span>
            </button>
          </div>
        </div>
      </div>
      @endauth
    </div>
  </div>
</nav>