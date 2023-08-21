@extends('layouts.web.web')


@section('head')
@endsection
@section('nav-items')
<a href="/"
  class="text-base uppercase font-bold text-gray-900 border-b-4 border-transparent hover:border-primary">HOME</a>
<a href="{{route('public.department.publicIndex')}}"
  class="text-base uppercase font-bold text-gray-900 border-b-4 border-transparent hover:border-primary">DEPARTMENT</a>
<a href="{{route('public.learning.publicIndex')}}"
  class="text-base uppercase font-bold text-white rounded-md bg-primary px-2.5 py-1">LEARNING</a>
<a href="{{route('public.notice.publicIndex')}}"
  class="text-base uppercase font-bold text-gray-900 border-b-4 border-transparent hover:border-primary">NOTICE</a>
<a href="{{route('public.about.publicIndex')}}"
  class="text-base uppercase font-bold text-gray-900 border-b-4 border-transparent hover:border-primary">ABOUT</a>
<a href="{{route('public.contact.publicIndex')}}"
  class="text-base uppercase font-bold text-gray-900 border-b-4 border-transparent hover:border-primary">CONTACT</a>
@if (Auth::check())
<a href="{{route('user.logout')}}"
  class="text-base uppercase font-bold text-gray-900 border-b-4 border-transparent hover:border-primary">LOGOUT</a>
@else
<a href="{{route('user.login')}}"
  class="text-base uppercase font-bold text-gray-900 border-b-4 border-transparent hover:border-primary">LOGIN</a>
@endif
@endsection
@section('content')
<!-- title  -->
<div class="bg-primary text-right py-2 md:py-4">
  <div class="side_space">
    <p class="text-white font-semibold text-base md:text-xl">
      Device Learning
    </p>
  </div>
</div>
<section class="side_space flex flex-col sm:flex-row mt-4 md:mt-10 gap-6 md:gap-6">
  <!-- side menu  -->
  @include('public.learning.side-menu')

  <!-- home/learning cards -->
  <div class="w-full">
    <header class="flex justify-between items-center gap-8 mb-6">
      <h3 class="text-base md:text-lg font-semibold">Home/Device-status-list</h3>
      <div class="flex items-center gap-4 md:gap-8">
        <input type="text"
          class="rounded-md border-primary border-2 px-2 md:px-3 py-0.5 md:py-1 placeholder:text-primary max-w-xs w-full"
          placeholder="Search Devices……" />
      </div>
    </header>
    <main class=" mt-8">
      <ul class="w-full">
        <li class="flex items-center justify-between py-2 px-5 mb-3 text-center">
          <p class="flex items-center text-[#707070] text-base w-[5%] justify-center">
            No
            <span class="flex flex-col ml-1 -mt-1"><i class="fa-solid fa-sort-up h-[1px] text-[10px]"></i>
              <i class="fa-solid fa-sort-down h-[1px] text-[10px]"></i>
            </span>
          </p>
          <p class="flex items-center text-[#707070] text-base w-[28%] justify-center">
            Devices Name
            <span class="flex flex-col ml-1 -mt-1"><i class="fa-solid fa-sort-up h-[1px] text-[10px]"></i>
              <i class="fa-solid fa-sort-down h-[1px] text-[10px]"></i>
            </span>
          </p>
          <p class="flex items-center text-[#707070] text-base w-[20%] justify-center">
            Catagories
            <span class="flex flex-col ml-1 -mt-1"><i class="fa-solid fa-sort-up h-[1px] text-[10px]"></i>
              <i class="fa-solid fa-sort-down h-[1px] text-[10px]"></i>
            </span>
          </p>
          <p class="flex items-center text-[#707070] text-base w-[10%] justify-center">
            View
            <span class="flex flex-col ml-1 -mt-1"><i class="fa-solid fa-sort-up h-[1px] text-[10px]"></i>
              <i class="fa-solid fa-sort-down h-[1px] text-[10px]"></i>
            </span>
          </p>
          <p class="flex items-center text-[#707070] text-base w-[12%] justify-center">
            Library
            <span class="flex flex-col ml-1 -mt-1"><i class="fa-solid fa-sort-up h-[1px] text-[10px]"></i>
              <i class="fa-solid fa-sort-down h-[1px] text-[10px]"></i>
            </span>
          </p>
          <p class="flex items-center text-[#707070] text-base w-[10%] justify-center">
            Status
            <span class="flex flex-col ml-1 -mt-1"><i class="fa-solid fa-sort-up h-[1px] text-[10px]"></i>
              <i class="fa-solid fa-sort-down h-[1px] text-[10px]"></i>
            </span>
          </p>
        </li>
        @foreach ($devices as $device)
        <li class="bg-white flex items-center justify-between py-2 px-5 mb-5 text-center">
          <p class="w-[5%]">{{$loop->index+1}}</p>
          <p class="w-[28%]">{{$device->name}}</p>
          <p class="w-[17%]">{{$device->deviceCategory->name}}</p>
          <p class="w-[10%]"><i class="fa-solid fa-eye"></i> 450</p>
          <p class="w-[10%] text-[#009e0f]">
            <i class="fa-regular fa-heart"></i>
          </p>
          <p class="w-[10%]">
            <button class="bg-[#009e0f] text-white w-full py-1 rounded-3xl">
              {{$device->deviceStatus->name}}
            </button>
          </p>
        </li>
        @endforeach
        <li class="hidden bg-white flex items-center justify-between py-2 px-5 mb-5 text-center">
          <p class="w-[5%]">1</p>
          <p class="w-[28%]">This is devices name list Lorem ipsum</p>
          <p class="w-[17%]">Categories Name</p>
          <p class="w-[18%]">Sub-Categories Name</p>
          <p class="w-[10%]"><i class="fa-solid fa-eye"></i> 450</p>
          <p class="w-[10%] text-[#009e0f]">
            <i class="fa-solid fa-heart"></i>
          </p>
          <p class="w-[10%]">
            <button class="bg-[#707070] text-white w-full py-1 rounded-3xl">
              Inactive
            </button>
          </p>
        </li>
      </ul>
    </main>
    <!-- pagination -->
    <div class="flex justify-end">
      <div class="flex items-center justify-between px-4 py-3 md:py-5 sm:px-6">
        <div class="flex flex-1 justify-between sm:hidden">
          <a href="#" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700">Previous</a>
          <a href="#"
            class="relative ml-3 inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700">Next</a>
        </div>
        <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
          <div>
            <nav class="isolate inline-flex items-center rounded-md space-x-2" aria-label="Pagination">
              <a href="#"
                class="relative inline-flex items-center justify-center h-8 w-8 text-sm md:text-base font-bold text-white bg-black rounded-full focus:z-20">
                <span class="sr-only">Previous</span>
                <!-- Heroicon name: mini/chevron-left -->
                <i class="fa-solid fa-angle-left"></i>
              </a>
              <!-- Current: "relative inline-flex items-center justify-center h-8 w-8 text-sm md:text-base font-bold text-white bg-black rounded-full focus:z-20" -->
              <a href="#" aria-current="page"
                class="relative inline-flex items-center justify-center h-8 w-8 text-sm md:text-base font-bold text-white bg-black rounded-full focus:z-20">1</a>
              <a href="#"
                class="relative inline-flex items-center px-2 py-2 text-sm md:text-base font-bold focus:z-20">2</a>
              <a href="#"
                class="relative inline-flex items-center px-2 py-2 text-sm md:text-base font-bold focus:z-20">3</a>
              <span
                class="relative inline-flex items-center px-2 py-2 text-sm md:text-base font-bold focus:z-20">...</span>
              <a href="#"
                class="relative inline-flex items-center px-2 py-2 text-sm md:text-base font-bold focus:z-20">8</a>
              <a href="#"
                class="relative inline-flex items-center px-2 py-2 text-sm md:text-base font-bold focus:z-20">9</a>
              <a href="#"
                class="relative inline-flex items-center px-2 py-2 text-sm md:text-base font-bold focus:z-20">10</a>
              <a href="#"
                class="relative inline-flex items-center justify-center h-8 w-8 text-sm md:text-base font-bold text-white bg-black rounded-full focus:z-20">
                <span class="sr-only">Next</span>
                <!-- Heroicon name: mini/chevron-right -->
                <i class="fa-solid fa-angle-right"></i>
              </a>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection


@section('scripts')
<script>
  $(document).ready(function () {
    $('.searchDevices').on('keyup', function () {
      var value = $(this).val().toLowerCase();
      $('.grid .bg-white').filter(function () {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });
</script>
@endsection