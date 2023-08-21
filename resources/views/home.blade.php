@extends('layouts.web.web')


@section('head')
@endsection
@section('nav-items')
<a href="/" class="text-base uppercase font-bold text-white rounded-md bg-primary px-2.5 py-1">HOME</a>
<a href="{{route('public.department.publicIndex')}}"
    class="text-base uppercase font-bold text-gray-900 border-b-4 border-transparent hover:border-primary">DEPARTMENT</a>
<a href="{{route('public.learning.publicIndex')}}"
    class="text-base uppercase font-bold text-gray-900 border-b-4 border-transparent hover:border-primary">LEARNING</a>
<a href="{{route('public.notice.publicIndex')}}"
    class="text-base uppercase font-bold text-gray-900 border-b-4 border-transparent hover:border-primary">NOTICE</a>
<a href="{{route('public.about.publicIndex')}}"
    class="text-base uppercase font-bold text-gray-900 border-b-4 border-transparent hover:border-primary">ABOUT</a>
<a href="{{route('public.contact.publicIndex')}}"
    class="text-base uppercase font-bold text-gray-900 border-b-4 border-transparent hover:border-primary">CONTACT</a>
@if(Auth::check())
<a href="{{route('user.logout')}}"
    class="text-base uppercase font-bold text-gray-900 border-b-4 border-transparent hover:border-primary">LOGOUT</a>
@else
<a href="{{route('user.login')}}"
    class="text-base uppercase font-bold text-gray-900 border-b-4 border-transparent hover:border-primary">LOGIN</a>
@endif
@endsection
@section('content')
@include('layouts.web._partials.header')
<!-- image and card {{asset('assets/front-end/image/Shahjibazar-logo.png')}}-->
<section class="max-w-7xl mx-auto px-4 sm:px-6 my-8 md:my-12 flex flex-col md:flex-row gap-4 md:gap-8">
    <div class="md:w-[45%] space-y-2">
        <img src="{{asset('assets/front-end/image/card1.png')}}" alt="" />
        <p class="mx-auto text-justify w-[80%] text-sm md:text-base">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum tenetur
            vitae reprehenderit . Lorem ipsum dolor
        </p>
    </div>
    <div class="md:w-[65%] space-y-2 md:space-y-3">
        <h3 class="text-xl md:text-2xl font-bold">
            About Shahjibazar Power Co. Ltd
        </h3>
        <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem
            doloribus velit et minus atque voluptas consequuntur iure at dolorem
            ratione molestiae possimus nisi corporis quas, sunt ullam quis id
            repellat. Lorem ipsum dolor sit amet consectetur adipisicing elit.
            Adipisci veritatis culpa eos necessitatibus hic dicta, in facere ad
            nobis. Nisi, vel debitis placeat voluptatem omnis quidem sed veritatis
            exercitationem magni! Lorem ipsum dolor sit amet consectetur
            adipisicing elit. Voluptatem doloribus velit et minus atque voluptas
            consequuntur iure at dolorem ratione molestiae possimus nisi corporis
            quas, sunt ullam quis id repellat. Lorem ipsum dolor sit amet
            consectetur adipisicing elit. Adipisci veritatis culpa eos
            necessitatibus hic dicta, in facere ad nobis. Nisi, vel debitis
            placeat voluptatem omnis quidem sed veritatis exercitationem magni!
            exercitationem magni! Lorem ipsum dolor sit amet consectetur
        </p>
    </div>
</section>

<!-- head image card  -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 my-8 md:my-12 hidden md:flex gap-8 pt-10">
    <div class="relative">
        <img src="{{asset('assets/front-end/image/card2.png')}}" alt="" />
        <img src="{{asset('assets/front-end/image/head.png')}}" alt="" class="w-[35%] absolute left-10 bottom-0" />
        <div class="absolute top-16 right-20 w-[40vw]">
            <p class="text-white">
                "Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum,
                accusamus? Beatae dolores et iste, a eum quia, sed ipsa culpa
                deleniti tempora doloribus? Sunt porro magni ab omnis ipsam neque"
                accusamus? Beatae dolores et iste, a eum quia, sed ipsa culpa
                deleniti tempora doloribus? Sunt porro magni ab omnis ipsam neque"
            </p>
        </div>
        <div class="text-center absolute bottom-2 right-10">
            <h3 class="text-white font-medium">Chairman name</h3>
            <p class="text-white">Chairman Shahjibazar 330 MW Power Plant</p>
        </div>
    </div>
</section>
<!-- mobile section  -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 my-8 md:my-12 flex flex-col md:flex-row gap-4 md:gap-8 md:hidden">
    <img src="{{asset('assets/front-end/image/head.png')}}" alt="" class="w-[60%] mx-auto" />
    <p class="text-justify">
        "Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic, ut maxime
        dolorum suscipit inventore maiores possimus, sed enim nesciunt aperiam
        culpa et voluptatibus dolor earum molestias neque ipsa voluptas
        voluptate. Lorem ipsum dolor, sit amet consectetur adipisicing elit.
        Deserunt quis, nulla minima quod reiciendis eos voluptatem odio dolore,
        sapiente"
    </p>
    <div class="text-center">
        <p class="font-medium">Chairman name</p>
        <p class="">Chairman Shahjibazar 330 MW Power Plant</p>
    </div>
</section>

<!-- notice - news section  -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 my-8 md:my-12 space-y-2 md:space-y-3">
    <div class="flex flex-col md:flex-row gap-2">
        <!-- notice board -->
        <div class="bg-white p-4 space-y-2 md:w-[60%] shadow-md">
            <h1 class="text-lg font-semibold text-gray-500">Notice Board</h1>
            <ul class="ml-6 md:ml-12 text-xs md:text-sm space-y-2 md:space-y-3 list-disc">
                <li class="text-primary">
                    This is the notice title publish on today
                </li>
                <li class="text-primary">
                    This is the notice title publish on today
                </li>
                <li class="text-primary">
                    This is the notice title publish on today
                </li>
                <li class="text-primary">
                    This is the notice title publish on today
                </li>
            </ul>
        </div>
        <!-- Latest News -->
        <div class="bg-white p-4 space-y-2 md:w-[40%] shadow-md">
            <h1 class="text-lg font-semibold text-gray-500">Latest News</h1>
            <ul class="ml-6 md:ml-12 text-xs md:text-sm space-y-2 md:space-y-3 list-disc">
                <li class="text-primary">
                    This is the notice title publish on today
                </li>
                <li class="text-primary">
                    This is the notice title publish on today
                </li>
                <li class="text-primary">
                    This is the notice title publish on today
                </li>
                <li class="text-primary">
                    This is the notice title publish on today
                </li>
            </ul>
        </div>
    </div>

    <div class="flex flex-col md:flex-row gap-2">
        <div class="bg-white p-4 w-full h-28 shadow-md"></div>
        <div class="bg-white p-4 w-full h-28 shadow-md"></div>
        <div class="bg-white p-4 w-full h-28 shadow-md"></div>
    </div>
</section>

<!-- download our mobile app  -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 my-8 md:my-12 space-y-2 md:space-y-3">
    <div class="relative">
        <img src="{{asset('assets/front-end/image/app.png')}}" alt="" class="hidden md:block" />
        <div class="md:absolute top-14 lg:top-36 left-10 space-y-2 md:w-[40%]">
            <h3 class="text-xl text-gray-600 font-medium">
                Download Our Mobile App
            </h3>
            <p class="text-sm md:text-base font-semibold text-gray-400">
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dolore
                perferendis, unde aspernatur est, cum velit ea possimus maiores
                placeat magnam inventore rem totam dignissimos voluptate iste quia
                praesentium. Iste, nesciunt!
            </p>
            <div class="flex gap-4 pt-2 md:pt-0">
                <button class="px-4 py-1 pb-1.5 bg-primary text-white rounded-md font-semibold">
                    Google Play
                </button>
                <button class="px-4 py-1 pb-1.5 bg-primary text-white rounded-md font-semibold">
                    IOS Store
                </button>
            </div>
        </div>
    </div>
</section>

<!-- All Events  -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 my-8 md:my-12 space-y-2 md:space-y-3">
    <h1 class="text-xl md:text-2xl text-gray-500 font-bold text-center mb-6 md:mb-8">
        All Events
    </h1>
    <div class="flex flex-col my-24" data-controller="slider">
        <div class="flex overflow-x-scroll" data-slider-target="scrollContainer">
            <div class="w-auto h-40 px-4 flex-shrink-0" data-slider-target="image" id="1">
                <img class="h-full"
                    src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?ixid=MnwxMjA3fDB8MHxzZWFyY2h8MXx8c2hvZXN8ZW58MHx8MHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=900&q=60" />
            </div>
            <div class="w-auto h-40 px-4 flex-shrink-0" data-slider-target="image" id="1">
                <img class="h-full"
                    src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?ixid=MnwxMjA3fDB8MHxzZWFyY2h8MXx8c2hvZXN8ZW58MHx8MHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=900&q=60" />
            </div>
            <div class="w-auto h-40 px-4 flex-shrink-0" data-slider-target="image" id="1">
                <img class="h-full"
                    src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?ixid=MnwxMjA3fDB8MHxzZWFyY2h8MXx8c2hvZXN8ZW58MHx8MHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=900&q=60" />
            </div>
            <div class="w-auto h-40 px-4 flex-shrink-0" data-slider-target="image" id="1">
                <img class="h-full"
                    src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?ixid=MnwxMjA3fDB8MHxzZWFyY2h8MXx8c2hvZXN8ZW58MHx8MHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=900&q=60" />
            </div>
            <div class="w-auto h-40 px-4 flex-shrink-0" data-slider-target="image" id="1">
                <img class="h-full"
                    src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?ixid=MnwxMjA3fDB8MHxzZWFyY2h8MXx8c2hvZXN8ZW58MHx8MHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=900&q=60" />
            </div>
            <div class="w-auto h-40 px-4 flex-shrink-0" data-slider-target="image" id="1">
                <img class="h-full"
                    src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?ixid=MnwxMjA3fDB8MHxzZWFyY2h8MXx8c2hvZXN8ZW58MHx8MHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=900&q=60" />
            </div>
        </div>
    </div>
</section>

<!-- Gallery  -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 my-8 md:my-12 space-y-2 md:space-y-3">
    <h1 class="text-xl md:text-2xl text-gray-500 font-bold text-center">
        Gallery
    </h1>
    <div class="flex justify-center gap-2 py-4">
        <button class="px-3 py-0.5 font-medium text-primary border-primary border rounded-md">
            All
        </button>
        <button class="px-3 py-0.5 font-medium text-primary border-primary border rounded-md">
            Plant
        </button>
        <button class="px-3 py-0.5 font-medium text-primary border-primary border rounded-md">
            BPDB
        </button>
        <button class="px-3 py-0.5 font-medium text-primary border-primary border rounded-md">
            330
        </button>
    </div>
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4">
        <div class="flex flex-wrap">
            <div class="w-full p-1 md:p-2">
                <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                    src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(73).webp" />
            </div>
        </div>
        <div class="flex flex-wrap">
            <div class="w-full p-1 md:p-2">
                <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                    src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(74).webp" />
            </div>
        </div>
        <div class="flex flex-wrap">
            <div class="w-full p-1 md:p-2">
                <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                    src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(75).webp" />
            </div>
        </div>
        <div class="flex flex-wrap">
            <div class="w-full p-1 md:p-2">
                <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                    src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(70).webp" />
            </div>
        </div>
        <div class="flex flex-wrap">
            <div class="w-full p-1 md:p-2">
                <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                    src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(70).webp" />
            </div>
        </div>
        <div class="flex flex-wrap">
            <div class="w-full p-1 md:p-2">
                <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                    src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(76).webp" />
            </div>
        </div>
        <div class="flex flex-wrap">
            <div class="w-full p-1 md:p-2">
                <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                    src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(72).webp" />
            </div>
        </div>
        <div class="flex flex-wrap">
            <div class="w-full p-1 md:p-2">
                <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                    src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(72).webp" />
            </div>
        </div>
    </div>
</section>
@endsection


@section('scripts')
@endsection
