@extends('layouts.web.web')


@section('head')
<style>
    .loginBtn {
        background-color: #009e0f !important;
    }

    .loginBtn:hover {
        background-color: #018e10 !important;
    }
</style>
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
    class="text-base uppercase font-bold text-gray-900 border-b-4 border-transparent hover:border-primary">CONTACT</a>
@if (Auth::check())
<a href="{{route('user.logout')}}"
    class="text-base uppercase font-bold text-gray-900 border-b-4 border-transparent hover:border-primary">LOGOUT</a>
@else
<a href="{{route('user.login')}}"
    class="text-base uppercase font-bold text-white rounded-md bg-primary px-2.5 py-1">LOGIN</a>
@endif
@endsection

@section('content')
<!-- title  -->
<div class="bg-primary py-2 md:py-4">
    <div class="side_space">
        <p class="text-white font-semibold text-base md:text-xl text-right">
            Login
        </p>
    </div>
</div>
<main class="side_space my-3 md:my-6">
    <div class="flex-1 h-full ml-auto w-full">
        <div class="flex flex-col md:flex-row md:justify-center md:items-center">
            <div class="flex items-center justify-center bg-white p-6 md:p-10 md:h-[50vh] w-1/2">
                <div class="max-w-md space-y-4 md:space-y-6">
                    <div class="max-w-fit space-y-1">
                        <h1 class="text-lg md:text-xl font-semibold text-primary">
                            Login to your account
                        </h1>
                        <hr class="h-[2px] bg-primary" />
                        <hr class="h-[2px] bg-primary w-3/4" />
                    </div>
                    <form action="{{route('user.login')}}" method="POST" class="space-y-2 md:space-y-4 w-[85%]">
                        @csrf
                        <input id="email-address" name="email" type="email" autocomplete="email" required
                            class="w-full px-4 py-2 text-sm border border-gray-400 focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary"
                            placeholder="Email address">
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                            class="w-full px-4 py-2 text-sm border border-gray-400 focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary"
                            placeholder="Your Password" />
                        <button type="submit" name="submit"
                            class="block px-8 md:px-14 py-1 md:py-1.5 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-[#009e0f] border border-transparent rounded-lg focus:outline-none focus:shadow-outline-blue">
                            SUBMIT
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection