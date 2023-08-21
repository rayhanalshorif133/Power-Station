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
   Device Learning dashboard
  </p>
 </div>
</div>
<section class="side_space flex flex-col sm:flex-row mt-4 md:mt-10 gap-6 md:gap-6">
 <!-- side menu  -->
 @include('public.learning.side-menu')
 <!-- home/learning cards -->
 <div class="w-full">
  <header class="flex justify-between items-center gap-16 mb-6">
   <h3 class="text-base md:text-lg font-semibold">Learning Dashboard</h3>
   <input type="text"
    class="hidden rounded-md border-primary border-2 px-2 md:px-3 py-0.5 md:py-1.5 placeholder:text-primary max-w-xs w-full searchDevices"
    placeholder="Search Devices……" />
  </header>
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