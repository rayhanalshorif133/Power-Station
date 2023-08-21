@extends('layouts.web.web')


@section('head')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link
  href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap"
  rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
<link href="{{asset('assets/front-end/css/notice.css')}}" rel="stylesheet">

<style>
  .download-file {
    font-family: 'Ubuntu', sans-serif !important;
  }

  .others {
    font-family: 'Lato', sans-serif !important;
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
  class="text-base uppercase font-bold text-white rounded-md bg-primary px-2.5 py-1">NOTICE</a>
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
<div class="bg-primary py-2 md:py-4">
  <div class="side_space">
    <p class="text-white font-semibold text-base md:text-xl text-right">
      Notice Board
    </p>
  </div>
</div>

<section class="max-w-7xl mx-auto px-4 sm:px-6 my-8 md:my-12 space-y-2 md:space-y-3">
  <div class="flex flex-col md:flex-row gap-2">
    <!-- notice board -->
    <div class="bg-white p-4 space-y-2 md:w-[100%] shadow-md">
      <h1 class="text-lg font-semibold text-gray-500">Notice Board</h1>
      <div class="p-3 border-b border-gray-200">
        <table class="display divide-y divide-gray-300 md:w-[100%] dataTable" style="width:100%">
          <thead class="bg-gray-100 others">
            <tr>
              <th class="px-6 py-2 text-[14px] text-gray-500 md:w-[10%]">
                Notice No.
              </th>
              <th class="px-6 py-2 text-[14px] text-gray-500 md:w-[40%]">
                Notice Title
              </th>
              <th class="px-6 py-2 text-[14px] text-gray-500 md:w-[20%]">
                Description
              </th>
              <th class="px-6 py-2 text-[14px] text-gray-500 md:w-[30%]">
                Published On
              </th>
            </tr>
          </thead>
          <tbody class="bg-white">
            @foreach($notices as $key => $notice)
            @php
            if($key % 2 == 0){
            $trClass = "whitespace-nowrap";
            }else{
            $trClass = "bg-gray-50 whitespace-nowrap";
            }
            @endphp
            <tr class="{{$trClass}}">
              <td class="px-6 py-4 text-[14px] text-gray-500 others">
                {{$notice->notice_no}}
              </td>
              <td class="px-6 py-4 text-[18px] text-[#009E0F] hover:text-[#009E0F] download-file font-bold">
                <a href="{{route('public.notice.viewFile',$notice->id)}}" target="_blank" data-toggle="tooltip"
                  data-placement="top" title="View or Download File">{{$notice->title}}</a>
              </td>
              <td class="px-6 py-4 text-[14px] text-gray-500 others">
                {{$notice->description}}
              </td>
              <td class="px-6 py-4 text-[14px] text-gray-500 others">
                {{$notice->updated_at->format('d M Y')}}
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    <!-- Latest News -->
    <div class="bg-white p-4 space-y-2 md:w-[40%] shadow-md hidden">
      <h1 class="text-lg font-semibold text-gray-500">Latest News</h1>
      <ul class="ml-6 md:ml-12 text-[14px] md:text-sm space-y-2 md:space-y-3 list-disc">
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
</section>
@endsection


@section('scripts')
<script>
  $(document).ready(function() {
  $('.dataTable').DataTable({ responsive: true });
  $('.dataTables_filter label').find('input').addClass('form-control input-sm');
  $('.dataTables_length select').addClass('form-control-select input-sm');
 });

</script>
@endsection