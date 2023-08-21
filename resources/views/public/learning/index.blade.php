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
    <header class="flex justify-between items-center gap-16 mb-6">
      <h3 class="text-base md:text-lg font-semibold">Home/Learning</h3>
      <input type="text"
        class="rounded-md border-primary border-2 px-2 md:px-3 py-0.5 md:py-1.5 placeholder:text-primary max-w-xs w-full searchDevices"
        placeholder="Search Devices……" />
    </header>
    <main
      class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-x-2 sm:gap-x-4 gap-y-3 md:gap-y-6">
      <!-- card  -->
      @foreach ($devices as $key => $device)
      <a href="{{route('public.learning.publicDeviceDetails',$device->id)}}" class="devices" id="deviceKey-{{$key}}">
        <div class="bg-white shadow-md">
          @if (strpos($device->images[0], '.mp4') !== false)
          <video class="h-48 w-full object-cover object-center" controls>
            <source src="{{asset($device->images[0])}}" type="video/mp4">
          </video>
          @else
          <img src="{{asset($device->images[0])}}" alt="image" class="h-48 w-full object-cover object-center" />
          @endif
          <div class="pb-1 md:pb-1.5 px-1.5 md:px-2">
            <span class="text-xs text-gray-400 deviceCategory">{{$device->deviceCategory->name}}</span>
            <p class="text-sm deviceName">{{$device->name}}</p>
            <div class="w-full flex justify-end items-center gap-2 text-xs md:text-sm">
              <div class="flex items-center gap-0.5 text-gray-400">
                <i class="fa-solid fa-eye"></i>
                <p class="mb-0.5">232</p>
              </div>
              <i class="fa-regular fa-heart text-gray-500"></i>
              <!-- <i class="fa-solid fa-heart text-primary"></i> -->
            </div>
          </div>
        </div>
      </a>
      @endforeach


    </main>
    {{-- No Device Available --}}
    <div class="noDeviceAvailable hidden">
      <div class="bg-white shadow-md">
        <div class="bg-red-100 border-t-4 border-red-500 rounded-b text-red-900 px-4 py-3 shadow-md" role="alert">
          <div class="flex">
            <div class="py-1"><svg class="fill-current h-6 w-6 text-red-500 mr-4" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20">
                <path
                  d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z" />
              </svg></div>
            <div>
              <p class="font-bold">Your input does not match any devices or category name...!!!</p>
              <p class="text-sm">Make sure, what is your device or category name?</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- pagination -->
    <div class="flex justify-end pagination">
      <div class="flex items-center justify-between px-4 py-3 md:py-5 sm:px-6">
        <div class="flex flex-1 justify-between sm:hidden">
          <a href="#" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700">Previous</a>
          <a href="#"
            class="relative ml-3 inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700">Next</a>
        </div>
        <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
          <div>
            <nav class="isolate inline-flex items-center rounded-md space-x-2 pageItem" aria-label="Pagination">
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
  var value = '';
  var deviceName = '';
  var deviceCategory = '';
  var countDisplayNone = 0;
  $(document).ready(function () {
    handleSearch();
    handlePagination();
  });
  function handleSearch() {
    $('.searchDevices').on('keyup', function () {
    value = $(this).val().toLowerCase();
    $('.devices').filter(function () {
    deviceName = $(this).find('.deviceName').text().toLowerCase();
    deviceCategory = $(this).find('.deviceCategory').text().toLowerCase();
    if(deviceName.includes(value) || deviceCategory.includes(value)){
    $(this).show();
    }else{
    $(this).hide();
    }
    });
    countDisplayNone = $('.devices').filter(function () {
    return $(this).css('display') == 'none';
    }).length;
    
    if($('.devices').length == countDisplayNone){
    $('.noDeviceAvailable').removeClass('hidden');
    $('.pagination').addClass('hidden');
    }else{
    $('.noDeviceAvailable').addClass('hidden');
    $('.pagination').removeClass('hidden');
    }
    });
  }

  function handlePagination() {

    setUpPagination();

    $('.devices').each(function () {
      let key = $(this).attr('id').split('-')[1];
      if (key >= 12) {
        $(this).addClass('hidden');
      }
    });
    $('.devices').length > 12 ? $('.pagination').removeClass('hidden') : $('.pagination').addClass('hidden');

    $(".pageItem a").on('click', function(){

      let page = $(this).text();
      let start = (page - 1) * 12;
      let end = start + 12;
      $('.devices').each(function () {
        let key = $(this).attr('id').split('-')[1];
        if (key >= start && key < end) {
          $(this).removeClass('hidden');
        } else {
          $(this).addClass('hidden');
        }
      });

      
      

      $('.pageItem a').each(function(){
        if($(this).hasClass('current')){
          $(this).removeClass('justify-center h-8 w-8 text-sm md:text-base font-bold text-white bg-black rounded-full focus:z-20');
          $(this).addClass('px-2 py-2 text-sm md:text-base font-bold focus:z-20');
          $(this).removeClass('current');
        }
      });

      $(this).removeClass('px-2 py-2 text-sm md:text-base font-bold focus:z-20');
      $(this).addClass('justify-center h-8 w-8 text-sm md:text-base font-bold text-white bg-black rounded-full focus:z-20 current');
    })
  }

  function setUpPagination() {
    let total = $('.devices').length;
    let pages = Math.ceil(total / 12);
    let pagination = '';
    for (let i = 1; i <= pages; i++) {
      if (i == 1) {
        pagination += `<a href="#" class="relative inline-flex items-center justify-center h-8 w-8 text-sm md:text-base font-bold text-white bg-black rounded-full focus:z-20 current">${i}</a>`;
      } else {
        pagination += `<a href="#" class="relative inline-flex items-center px-2 py-2 text-sm md:text-base font-bold focus:z-20">${i}</a>`;
      }
    }
    $('.pageItem').append(pagination);
  }

  
</script>
@endsection