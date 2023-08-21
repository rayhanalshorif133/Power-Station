@extends('layouts.web.web')


@section('tailwind')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/index.min.css" />
@endsection
@section('head')



@endsection
@section('nav-items')
<a href="/"
  class="text-base uppercase font-bold text-gray-900 border-b-4 border-transparent hover:border-primary">HOME</a>
<a href="{{route('public.department.publicIndex')}}"
  class="text-base uppercase font-bold text-white rounded-md bg-primary px-2.5 py-1">DEPARTMENT</a>
<a href="{{route('public.learning.publicIndex')}}"
  class="text-base uppercase font-bold text-gray-900 border-b-4 border-transparent hover:border-primary">LEARNING</a>
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
<div class="bg-primary py-2 md:py-4">
  <div class="side_space">
    <p class="text-white font-semibold text-base md:text-xl">
      Home/Department
    </p>
  </div>
</div>
<!-- top department navigation -->
<section
  class="side_space flex items-center lg:justify-center py-2.5 md:pt-3 text-base md:text-lg text-gray-500 divide-x-2 divide-gray-400 overflow-x-scroll lg:overflow-x-hidden">


  <ul class="nav nav-tabs flex flex-col md:flex-row flex-wrap list-none border-b-0 pl-0 mb-4" id="tabs-tab"
    role="tablist">
    <li class="nav-item tabHover pr-10 pt-5" role="presentation">
      <a href="#tabs0" class="nav-link active" id="tabs0-tab flex-shrink-0" data-bs-toggle="pill"
        data-bs-target="#tabs0" role="tab" aria-controls="tabs0" aria-selected="true">
        <p class="pb-0.5 border-r-2 border-gray-400 px-3 md:px-6 text-primary">
          {{$departments[0]->name}}
        </p>
        <hr class="mx-auto w-20 border-2 bg-primary border-primary hidden" />
      </a>
    </li>
    @foreach ($departments as $key => $department)
    @if ($key != 0)
    <li class="nav-item tabHover pr-10 pt-5" role="presentation">
      <a href="#tabs{{$key}}" class="nav-link flex-shrink-0" id="#tabs{{$key}}-tab" data-bs-toggle="pill"
        data-bs-target="#tabs{{$key}}" role="tab" aria-controls="tabs{{$key}}" aria-selected="false">
        <p class="pb-0.5 border-r-2 border-gray-400 px-3 md:px-6">
          {{$department->name}}
        </p>
        <hr class="mx-auto w-20 border-2 bg-primary border-primary hidden" />
      </a>
    </li>
    @endif
    @endforeach

  </ul>

</section>
<section class="side_space flex flex-col sm:flex-row gap-4 md:gap-6">
  <div class="tab-content" id="tabs-tabContent">
    <div class="tab-pane fade show active" id="tabs0" role="tabpanel" aria-labelledby="tabs0-tab">
      @include('public.department.tab_content', ['department' => $departments[0]])
    </div>
    @foreach ($departments as $key => $department)
    @if ($key != 0)
    <div class="tab-pane fade" id="tabs{{$key}}" role="tabpanel" aria-labelledby="#tabs{{$key}}-tab">
      @include('public.department.tab_content')
    </div>
    @endif
    @endforeach
  </div>
</section>
@endsection


@section('scripts')
<script>
  $(document).ready(function () {
    tabHover();
    handleTabUnderline();
 });

 function tabHover() {
  $('.tabHover').hover(function () {
      $(this).find('hr').removeClass('hidden');
  });
  $('.tabHover').mouseleave(function () {
    if($(this).find('a').hasClass('active')) {
    $(this).find('hr').removeClass('hidden');
    }else{
    $(this).find('hr').addClass('hidden');
    }
  });
 }

 function handleTabUnderline() {
  $('.nav-link').each(function () {
  if($(this).hasClass('active')) {
  $(this).find('hr').removeClass('hidden');
  $(this).find('p').addClass('text-primary');
  }else{
  $(this).find('hr').addClass('hidden');
  $(this).find('p').removeClass('text-primary');
  }
  });
  $('.nav-link').click(function () {
      if($(this).hasClass('active')) {
      $(this).find('hr').removeClass('hidden');
      $(this).find('p').addClass('text-primary');
      }else{
      $(this).find('hr').addClass('hidden');
      $(this).find('p').removeClass('text-primary');
      }
      handleTabUnderline();
  });
 }
</script>
@endsection