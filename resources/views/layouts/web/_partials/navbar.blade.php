<div class="relative shadow-md mb-3 md:mb-6 bg-white">
  {{-- sticky top-0 --}}
  <div class="side_space">
    <div class="flex items-center justify-between py-2 md:justify-start md:space-x-10">
      <div class="flex justify-start lg:w-0 lg:flex-1">
        <a href="#">
          <span class="sr-only">Shahjibazar Power Co. Ltd.</span>
          <img class="h-8 w-auto sm:h-12" src="{{asset('assets/front-end/image/Shahjibazar-logo.png')}}"
            alt="Shahjibazar Power Co. Ltd." />
        </a>
      </div>
      <div class="-my-2 -mr-2 md:hidden">
        <button id="open_mobile_menu_button" type="button"
          class="inline-flex items-center justify-center rounded-md bg-white p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-primary"
          aria-expanded="false">
          <span class="sr-only">Open menu</span>
          <!-- Heroicon name: outline/bars-3 -->
          <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
          </svg>
        </button>
      </div>
      <nav class="hidden space-x-6 md:flex items-center navBarItems">
        @yield('nav-items')
        @if(Auth::check())
        <a href="{{route('user.dashboard')}}" data-tooltip-target="tooltip-default"
          class="text-base cursor-pointer text-white bg-black hover:bg-primary rounded-full h-8 w-8 flex justify-center items-center">
          <i class="fa-solid fa-user"></i>
        </a>
        <div id="tooltip-default" role="tooltip"
          class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 transition-opacity duration-300 tooltip dark:bg-gray-700"
          data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="top"
          style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 8px);">
          Goto Admin Panel
          <div class="tooltip-arrow" data-popper-arrow=""
            style="position: absolute; left: 0px; transform: translate(0px, 0px);"></div>
        </div>
        @else
        <a href="{{route('user.login')}}"
          class="text-base cursor-pointer text-white bg-black hover:bg-primary rounded-full h-8 w-8 flex justify-center items-center">
          <i class="fa-solid fa-user"></i>
        </a>
        @endif
      </nav>
    </div>
  </div>

  <!--
    Mobile menu, show/hide based on mobile menu state.

    Entering: "duration-200 ease-out"
      From: "opacity-0 scale-95"
      To: "opacity-100 scale-100"
    Leaving: "duration-100 ease-in"
      From: "opacity-100 scale-100"
      To: "opacity-0 scale-95"
  -->
  <div id="mobile_menu" class="absolute inset-x-0 top-0 origin-top-right transform p-2 transition hidden">
    <div class="divide-y-2 divide-gray-50 rounded-lg bg-white shadow-lg ring-1 ring-black ring-opacity-5">
      <div class="px-5 pt-5 pb-6">
        <div class="flex items-center justify-between">
          <div>
            <img class="h-8 w-auto" src="{{asset('assets/front-end/image/Shahjibazar-logo.png')}}"
              alt="Shahjibazar Power Co. Ltd." />
          </div>
          <div class="-mr-2">
            <button id="close_mobile_menu_button" type="button"
              class="inline-flex items-center justify-center rounded-md bg-white p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-primary">
              <span class="sr-only">Close menu</span>
              <!-- Heroicon name: outline/x-mark -->
              <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>
        </div>
        <div class="mt-6">
          <nav class="grid gap-y-8">
            <a href="#" class="-m-3 flex items-center rounded-md p-3 text-white bg-primary">
              <span class="ml-3 text-base font-medium">HOME</span>
            </a>
            <a href="#" class="-m-3 flex items-center rounded-md p-3 hover:bg-gray-50">
              <span class="ml-3 text-base font-medium text-gray-900">DEPARTMENT</span>
            </a>
            <a href="#" class="-m-3 flex items-center rounded-md p-3 hover:bg-gray-50">
              <span class="ml-3 text-base font-medium text-gray-900">LEARNING</span>
            </a>
            <a href="#" class="-m-3 flex items-center rounded-md p-3 hover:bg-gray-50">
              <span class="ml-3 text-base font-medium text-gray-900">NOTICE</span>
            </a>
            <a href="#" class="-m-3 flex items-center rounded-md p-3 hover:bg-gray-50">
              <span class="ml-3 text-base font-medium text-gray-900">ABOUT</span>
            </a>
            <a href="#" class="-m-3 flex items-center rounded-md p-3 hover:bg-gray-50">
              <span class="ml-3 text-base font-medium text-gray-900">CONTACT</span>
            </a>
            <a href="#" class="-m-3 flex items-center rounded-md p-3 hover:bg-gray-50 hidden">
              <span class="ml-3 text-base font-medium text-gray-900">MY PROFILE</span>
            </a>
          </nav>
        </div>
      </div>
    </div>
  </div>
</div>