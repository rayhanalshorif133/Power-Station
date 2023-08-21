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

  <div class="flex-shrink-0">
    <p class="text-primary pb-0.5 border-r-2 px-3 md:px-6">
      Department Name
    </p>
    <hr class="mx-auto w-24 border-2 bg-primary border-primary" />
  </div>
  <div class="flex-shrink-0">
    <p class="pb-0.5 border-r-2 px-3 md:px-6">Department Name</p>
    <hr class="mx-auto w-24 border-2 border-transparent" />
  </div>
  <div class="flex-shrink-0">
    <p class="pb-0.5 border-r-2 px-3 md:px-6">Department Name</p>
    <hr class="mx-auto w-24 border-2 border-transparent" />
  </div>
  <div class="flex-shrink-0">
    <p class="pb-0.5 border-r-2 px-3 md:px-6">Department Name</p>
    <hr class="mx-auto w-24 border-2 border-transparent" />
  </div>
  <div class="flex-shrink-0">
    <p class="pb-0.5 border-r-2 px-3 md:px-6 border-transparent">
      Department Name
    </p>
    <hr class="mx-auto w-24 border-2 border-transparent" />
  </div>
</section>
<h1 class="text-primary text-xl md:text-2xl font-semibold text-center my-4 md:my-10">
  Department of Name of Deparment
</h1>
<section class="side_space flex flex-col sm:flex-row gap-4 md:gap-6">
  <!-- side menu  -->
  <aside class="sm:max-w-xs w-full bg-white rounded-md py-6 px-4 space-y-2 md:space-y-4 self-baseline">
    <!-- side menu links -->
    <div class="flex flex-col flex-grow overflow-y-auto">
      <div class="flex-grow flex flex-col">
        <nav class="flex-1 px-2 space-y-1 text-sm md:text-base divide-y-2 divide-gray-300 font-medium"
          aria-label="Sidebar">
          <div>
            <a href="#" class="text-primary group w-full flex items-center pl-0.5 py-2">
              Dashboard
            </a>
          </div>
          <div>
            <a href="#" class="text-gray-900 group w-full flex items-center pl-0.5 py-2">
              Message from Head
            </a>
          </div>
          <div>
            <a href="#" class="text-gray-900 group w-full flex items-center pl-0.5 py-2">
              Officers
            </a>
          </div>
        </nav>
      </div>
    </div>
  </aside>

  <!-- blog cards -->
  <div class="w-full space-y-6 md:space-y-10">
    <!-- blog card  -->
    <div class="space-y-1 md:space-y-2">
      <h3 class="text-lg md:text-xl font-semibold">
        The Standard lorem ipsum passage
      </h3>
      <p class="text-sm md:text-base">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias
        corporis repellat laudantium a dolorum veniam iusto sit excepturi?
        Repellendus asperiores vero ad consectetur possimus! Similique ad
        laboriosam illum non labore. Lorem ipsum dolor sit amet consectetur
        adipisicing elit. Incidunt aliquid, repellendus expedita at voluptas
        veniam ipsam dolores repudiandae deserunt nobis! Necessitatibus
        voluptates quibusdam mollitia laudantium perferendis, eaque ipsum
        totam odio!
      </p>
    </div>
    <div class="space-y-1 md:space-y-2">
      <h3 class="text-lg md:text-xl font-semibold">
        The Standard lorem ipsum passage
      </h3>
      <p class="text-sm md:text-base">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias
        corporis repellat laudantium a dolorum veniam iusto sit excepturi?
        Repellendus asperiores vero ad consectetur possimus! Similique ad
        laboriosam illum non labore. Lorem ipsum dolor sit amet consectetur
        adipisicing elit. Incidunt aliquid, repellendus expedita at voluptas
        veniam ipsam dolores repudiandae deserunt nobis! Necessitatibus
        voluptates quibusdam mollitia laudantium perferendis, eaque ipsum
        totam odio!
      </p>
    </div>
  </div>
</section>
@endsection


@section('scripts')
<script>
  $(document).ready(function () {
  tailwind.config = {
      theme: {
      extend: {
      fontFamily: {
      sans: ['Inter', 'sans-serif'],
      },
      }
      }
  }
 });
</script>
@endsection