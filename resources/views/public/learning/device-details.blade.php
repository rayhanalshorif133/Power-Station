@extends('layouts.web.web')


@section('head')
@endsection
{{-- When Not Active
text-gray-900 border-b-4 border-transparent hover:border-primary
--}}
{{-- When Active
text-white rounded-md bg-primary px-2.5 py-1
--}}
@section('nav-items')
<a href="/"
 class="text-base uppercase font-bold text-gray-900 border-b-4 border-transparent hover:border-primary">HOME</a>
<a href="{{route('public.department.publicIndex')}}"
 class="text-base uppercase font-bold text-white rounded-md bg-primary px-2.5 py-1">DEPARTMENT</a>
<a href="{{route('public.learning.publicIndex')}}"
 class="text-base uppercase font-bold text-gray-900 border-b-4 border-transparent hover:border-primary">LEARNING</a>
<a href="{{route('public.notice.publicIndex')}}"
 class="text-base uppercase font-bold text-gray-900 border-b-4 border-transparent hover:border-primary">NOTICE</a>
<a href="#"
 class="text-base uppercase font-bold text-gray-900 border-b-4 border-transparent hover:border-primary">ABOUT</a>
<a href="#"
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
<div class="bg-primary py-2 md:py-4">
 <div class="side_space">
  <p class="text-white font-semibold text-base md:text-xl">
   Home/Learning/{{ $device->name }}
  </p>
 </div>
</div>
<section class="side_space space-y-8 sm:space-y-8 md:space-y-16">
 <div class="flex flex-col sm:flex-row mt-4 md:mt-10 gap-6 md:gap-12 pb-4 md:pb-8 border-b-2 border-gray-300">
  <main class="w-full space-y-5 md:space-y-10">
   <!-- main blog content  -->
   <div class="space-y-2 md:space-y-3 pb-3 md:pb-3 border-b-2 border-gray-300">
    <!-- video  -->
    @if (strpos($device->images[0], '.mp4') !== false)
    <video class="w-full h-[30vh] md:h-[60vh] bg-gray-300 rounded-lg" controls>
     <source src="{{asset($device->images[0])}}" type="video/mp4">
    </video>
    @else
    <img src="{{asset($device->images[0])}}" alt="image" class="w-full h-[30vh] md:h-[60vh] bg-gray-300 rounded-lg" />
    @endif
    <h1 class="text-lg md:text-xl font-medium pt-1 md:pt-0">
     {{ $device->name }}
    </h1>
    <p class="text-sm md:text-base">
     {{ $device->description }}
    </p>
   </div>
   <!-- comment section  -->
   <div class="space-y-6 md:space-y-10">
    <!-- add comment form  -->
    <div class="flex items-center justify-end md:justify-between gap-3 sm:gap-4 lg:gap-6 flex-wrap">
     <img
      src="https://images.unsplash.com/photo-1662837055748-efea54b38eed?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=387&q=80"
      alt="user" class="h-8 w-8 md:h-12 md:w-12 rounded-full flex-shrink-0" />
     <input type="text" id="comment" name="comment" placeholder="Add Public Comment"
      class="flex-1 py-2 border-b-2 border-gray-300 focus:border-primary text-gray-600 placeholder-gray-400 outline-none bg-transparent" />

     <button class="text-white bg-primary font-medium rounded-md px-1 py-0.5 md:px-2 md:py-1">
      Comment
     </button>
     <button class="font-medium text-gray-500">Cancel</button>
    </div>

    <!-- user comments  -->
    <div class="space-y-4 md:space-y-8">
     <!-- comment  -->
     <div class="flex flex-col sm:flex-row gap-2 sm:gap-4 lg:gap-6">
      <div class="flex-shrink-0 flex gap-3 items-center sm:items-start">
       <img
        src="https://images.unsplash.com/photo-1662837055748-efea54b38eed?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=387&q=80"
        alt="user" class="h-8 w-8 md:h-12 md:w-12 rounded-full flex-shrink-0" />
       <div class="flex sm:hidden flex-col sm:flex-row sm:items-center sm:gap-2 md:gap-4s">
        <h3 class="text-base md:font-medium">Shamin All Hasan</h3>
        <samp class="text-gray-400 text-xs md:text-sm">3 Days ago</samp>
       </div>
      </div>
      <div class="">
       <div class="hidden sm:flex items-center gap-2 md:gap-4s">
        <h3 class="text-base md:font-medium">Shamin All Hasan</h3>
        <samp class="text-gray-400 text-xs md:text-sm">3 Days ago</samp>
       </div>
       <p class="text-sm md:text-base text-gray-600">
        Lorem ipsum dolor sit amet consectetur adipisicing elit.
        Dignissimos similique, dolor maiores velit possimus sapiente
        vero, fuga ratione iusto cumque sint saepe distinctio
        perspiciatis incidunt facilis minima placeat doloremque
        pariatur.
       </p>
      </div>
     </div>
     <!-- comment  -->
     <div class="flex flex-col sm:flex-row gap-2 sm:gap-4 lg:gap-6">
      <div class="flex-shrink-0 flex gap-3 items-center sm:items-start">
       <img
        src="https://images.unsplash.com/photo-1662837055748-efea54b38eed?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=387&q=80"
        alt="user" class="h-8 w-8 md:h-12 md:w-12 rounded-full flex-shrink-0" />
       <div class="flex sm:hidden flex-col sm:flex-row sm:items-center sm:gap-2 md:gap-4s">
        <h3 class="text-base md:font-medium">Shamin All Hasan</h3>
        <samp class="text-gray-400 text-xs md:text-sm">3 Days ago</samp>
       </div>
      </div>
      <div class="">
       <div class="hidden sm:flex items-center gap-2 md:gap-4s">
        <h3 class="text-base md:font-medium">Shamin All Hasan</h3>
        <samp class="text-gray-400 text-xs md:text-sm">3 Days ago</samp>
       </div>
       <p class="text-sm md:text-base text-gray-600">
        Lorem ipsum dolor sit amet consectetur adipisicing elit.
        Dignissimos similique, dolor maiores velit possimus sapiente
        vero, fuga ratione iusto cumque sint saepe distinctio
        perspiciatis incidunt facilis minima placeat doloremque
        pariatur.
       </p>
      </div>
     </div>
    </div>
   </div>
  </main>

  <!-- side video section  -->
  <aside class="sm:max-w-[18rem] w-full space-y-4 md:space-y-6">
   <!-- side video card  -->
   <div class="space-y-1">
    <div class="w-full h-40 bg-blue-200 rounded-lg"></div>
    <h3 class="text-sm md:text-base text-gray-500 font-medium">
     This is title for video for use title bar lorem ipsum
    </h3>
   </div>
   <div class="space-y-1">
    <div class="w-full h-40 bg-blue-200 rounded-lg"></div>
    <h3 class="text-sm md:text-base text-gray-500 font-medium">
     This is title for video for use title bar lorem ipsum
    </h3>
   </div>
   <div class="space-y-1">
    <div class="w-full h-40 bg-blue-200 rounded-lg"></div>
    <h3 class="text-sm md:text-base text-gray-500 font-medium">
     This is title for video for use title bar lorem ipsum
    </h3>
   </div>
   <div class="space-y-1">
    <div class="w-full h-40 bg-blue-200 rounded-lg"></div>
    <h3 class="text-sm md:text-base text-gray-500 font-medium">
     This is title for video for use title bar lorem ipsum
    </h3>
   </div>
  </aside>
 </div>
 <!-- blog  -->
 <div class="space-y-2">
  <h1 class="text-xl md:text-2xl md:font-medium text-gray-600">
   This is title for video for use title bar lorem ipsum
  </h1>
  <div class="space-y-2 md:space-y-4">
   <img
    src="https://images.unsplash.com/photo-1662837055748-efea54b38eed?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=387&q=80"
    alt="" class="max-w-xs h-auto max-h-60 w-full object-cover sm:float-right mx-auto sm:my-2 sm:ml-4 md:ml-8" />
   <p class="text-justify">
    Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam
    nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam
    erat, sed diam voluptua. At vero eos et accusam et justo duo dolores
    et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est
    Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur
    sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore
    et dolore magna aliquyam erat, sed diam voluptua. At vero eos et
    accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren,
    no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum
    dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod
    tempor invidunt ut labore et dolore magna aliquyam erat, sed diam
    voluptua. At vero eos et accusam et justo duo dolores et ea rebum.
    Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum
    dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing
    elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore
    magna aliquyam erat, sed diam voluptua. At vero eos et accusam et
    justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea
    takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor
    sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor
    invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.
    At vero eos et accusam et justo duo dolores et ea rebum. Stet clita
    kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit
    amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
    diam nonumy eirmod tempor invidunt ut labore et dolore magna
    aliquyam erat, sed diam voluptua. At vero eos et accusam et justo
    duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata
    sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore
    et dolore magna aliquyam erat, sed diam voluptua. At vero eos et
    accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren,
    no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum
    dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod
    tempor invidunt ut labore et dolore magna aliquyam erat, sed diam
    voluptua. At vero eos et accusam et justo duo dolores et ea rebum.
    Stet clita kasd gubergren, no sea takimata
   </p>
  </div>
 </div>

 <!-- blog  -->
 <div class="space-y-2">
  <h1 class="text-xl md:text-2xl md:font-medium text-gray-600">
   This is title for video for use title bar lorem ipsum
  </h1>
  <div class="space-y-2 md:space-y-4">
   <img
    src="https://images.unsplash.com/photo-1662837055748-efea54b38eed?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=387&q=80"
    alt="" class="max-w-xs h-auto max-h-60 w-full object-cover sm:float-right mx-auto sm:my-2 sm:ml-4 md:ml-8" />
   <p class="text-justify">
    Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam
    nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam
    erat, sed diam voluptua. At vero eos et accusam et justo duo dolores
    et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est
    Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur
    sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore
    et dolore magna aliquyam erat, sed diam voluptua. At vero eos et
    accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren,
    no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum
    dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod
    tempor invidunt ut labore et dolore magna aliquyam erat, sed diam
    voluptua. At vero eos et accusam et justo duo dolores et ea rebum.
    Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum
    dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing
    elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore
    magna aliquyam erat, sed diam voluptua. At vero eos et accusam et
    justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea
    takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor
    sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor
    invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.
    At vero eos et accusam et justo duo dolores et ea rebum. Stet clita
    kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit
    amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
    diam nonumy eirmod tempor invidunt ut labore et dolore magna
    aliquyam erat, sed diam voluptua. At vero eos et accusam et justo
    duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata
    sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore
    et dolore magna aliquyam erat, sed diam voluptua. At vero eos et
    accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren,
    no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum
    dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod
    tempor invidunt ut labore et dolore magna aliquyam erat, sed diam
    voluptua. At vero eos et accusam et justo duo dolores et ea rebum.
    Stet clita kasd gubergren, no sea takimata
   </p>
  </div>
 </div>
</section>
@endsection


@section('scripts')
@endsection