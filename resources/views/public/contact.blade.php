@extends('layouts.web.web')


@section('head')
@endsection

@section('nav-items')
<a href="/"
  class="text-base uppercase font-bold text-gray-900 border-b-4 border-transparent hover:border-primary">HOME</a>
<a href="{{route('public.department.publicIndex')}}"
  class="text-base uppercase font-bold text-gray-900 border-b-4 border-transparent hover:border-primary">DEPARTMENT</a>
<a href="{{route('public.learning.publicIndex')}}"
  class="text-base uppercase font-bold text-gray-900 border-b-4 border-transparent hover:border-primary">LEARNING</a>
<a href="{{route('public.notice.publicIndex')}}"
  class="text-base uppercase font-bold text-gray-900 border-b-4 border-transparent hover:border-primary">NOTICE</a>
<a href="{{route('public.about.publicIndex')}}"
  class="text-base uppercase font-bold text-gray-900 border-b-4 border-transparent hover:border-primary">ABOUT</a>
<a href="{{route('public.contact.publicIndex')}}"
  class="text-base uppercase font-bold text-white rounded-md bg-primary px-2.5 py-1">CONTACT</a>
@if (Auth::check())
<a href="{{route('user.logout')}}"
  class="text-base uppercase font-bold text-gray-900 border-b-4 border-transparent hover:border-primary">LOGOUT</a>
@else
<a href="{{route('user.login')}}"
  class="text-base uppercase font-bold text-gray-900 border-b-4 border-transparent hover:border-primary">LOGIN</a>
@endif
@endsection
@section('content')
<div class="bg-primary py-2 md:py-4">
  <div class="side_space">
    <p class="text-white font-semibold text-base md:text-xl text-right">
      Contract Us
    </p>
  </div>
</div>
<main class="side_space my-3 md:my-6">
  <div class="flex-1 h-full ml-auto w-full">
    <div class="flex flex-col md:flex-row md:justify-end md:items-center">
      <div
        class="min-w-full md:min-w-fit sm:max-w-md w-full md:h-[80vh] bg-[url({{asset('assets/front-end/image/contact_page.png')}})] bg-cover bg-bottom bg-no-repeat">
        <div class="sm:max-w-xs px-6 sm:px-4 py-6 md:py-12 mx-auto text-white">
          <h1 class="text-xl md:text-2xl font-medium mb-4 md:mb-8">
            Shahjibazar 330 MW CCPP
          </h1>
          <p class="text-sm md:text-base md:leading-[22px] mb-6 md:mb-14">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam
            officia nihil delectus assumenda eligendi exercitationem
            accusamus, at ipsam minus soluta consectetur laborum in. Esse
            quaerat maxime aut accusamus, officia voluptas.
          </p>
          <div class="space-y-2 text-sm md:text-base mx-4">
            <div class="flex gap-3 items-center">
              <i class="fa-solid fa-location-dot"></i>
              <p class="">N2, Shahjibazar</p>
            </div>
            <div class="flex gap-3 items-center">
              <i class="fa-sharp fa-solid fa-phone"></i>
              <p>01709-641889</p>
            </div>
            <div class="flex gap-3 items-center">
              <i class="fa-sharp fa-solid fa-envelope"></i>
              <p class="">name@email.com</p>
            </div>
          </div>
        </div>
      </div>
      <div class="flex items-center justify-center bg-white p-6 md:p-10 md:h-[70vh] w-full">
        <div class="max-w-md space-y-4 md:space-y-6">
          <div class="max-w-fit space-y-1">
            <h1 class="text-lg md:text-xl font-semibold text-primary">
              Contract Us
            </h1>
            <hr class="h-[2px] bg-primary" />
            <hr class="h-[2px] bg-primary w-3/4" />
          </div>
          <p class="text-xs md:text-sm font-light">
            Feet free to contact us, if you need some help, Congratulations
            or you have some other question
          </p>
          <form action="" class="space-y-2 md:space-y-4 w-[85%]">
            <input type="text"
              class="w-full px-4 py-2 text-sm border border-gray-400 focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary"
              placeholder="Your Name" />
            <input type="text"
              class="w-full px-4 py-2 text-sm border border-gray-400 focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary"
              placeholder="Your Email" />
            <textarea name="" id="" type="text"
              class="w-full px-4 py-2 text-sm border border-gray-400 focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary"
              placeholder="Your Message" rows="4"></textarea>
          </form>
          <button
            class="block px-8 md:px-14 py-1 md:py-1.5 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-primary border border-transparent rounded-lg focus:outline-none focus:shadow-outline-blue"
            href="#">
            SUBMIT
          </button>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection


@section('scripts')
@endsection