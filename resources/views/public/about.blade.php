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
  class="text-base uppercase font-bold text-white rounded-md bg-primary px-2.5 py-1">ABOUT</a>
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
<div class="bg-primary py-2 md:py-4">
  <div class="side_space">
    <p class="text-white font-semibold text-base md:text-xl text-right">
      About
    </p>
  </div>
</div>
<main class="side_space my-3 md:my-6">
  {{-- two columns --}}
  <div class="grid grid-cols-1 md:grid-cols-2 gap-3 md:gap-6">
    {{-- left column --}}
    <div class="col-span-1">
      <div class="bg-white shadow-md rounded-md p-3 md:p-6">
        <p class="text-primary font-semibold text-base md:text-xl">
          About
        </p>
        <p class="text-gray-600 break-normal text-justify text-sm md:text-base">
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem doloribus velit et minus atque voluptas
          consequuntur
          iure at dolorem ratione molestiae possimus nisi corporis quas, sunt ullam quis id repellat. Lorem ipsum dolor
          sit
          amet consectetur adipisicing elit. Adipisci veritatis culpa eos necessitatibus hic dicta, in facere ad nobis.
          Nisi,
          vel
          debitis placeat voluptatem omnis quidem sed veritatis exercitationem magni! Lorem ipsum dolor sit amet
          consectetur
          adipisicing elit. Voluptatem doloribus velit et minus atque .<br>
          Voluptatem doloribus velit et minus atque voluptas consequuntur iure at dolorem ratione molestiae
          possimus nisi corporis quas, sunt ullam quis id repellat. Lorem ipsum dolor sit amet consectetur adipisicing
          elit.
          Adipisci veritatis culpa eos necessitatibus hic dicta, in facere ad nobis. Nisi, vel debitis placeat
          voluptatem
          omnis
          quidem sed veritatis exercitationem magni! exercitationem magni! Lorem ipsum dolor sit amet consectetur
          d veritatis exercitationem magni! exercitationem magni! Lorem ipsum dolo
        </p>
      </div>
    </div>
    <div class="col-span-1">
      <div class="rounded-md p-3 md:p-6">
        <div class="w-full h-full md:h-96 bg-gray-200">
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d29103.44418911681!2d91.35441035740672!3d24.244208618951937!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x37515a145dd3e14d%3A0x2ca362a7bf27ea2c!2sShahaji%20Bazar!5e0!3m2!1sen!2sbd!4v1664962441452!5m2!1sen!2sbd"
            width="800" height="800" style="border:0;" allowFullScreen="true" webkitallowfullscreen="true"
            mozallowfullscreen="true" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
            class="w-full h-full object-cover"></iframe>
        </div>
      </div>
    </div>
    {{-- right column --}}

  </div>
  <div class="space-y-2">
    <h1 class="text-xl md:text-2xl md:font-medium text-primary">
      History
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
</main>

@endsection


@section('scripts')
@endsection