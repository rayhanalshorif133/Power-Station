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
<a href="#"
 class="text-base uppercase font-bold text-gray-900 border-b-4 border-transparent hover:border-primary">LEARNING</a>
<a href="#"
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
@endsection


@section('scripts')
@endsection