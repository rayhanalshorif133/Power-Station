<h1 class="text-primary text-xl md:text-2xl font-semibold text-center my-4 md:my-10">
 {{ $department->name }}
</h1>
<section class="side_space flex flex-col sm:flex-row gap-4 md:gap-6">
 <!-- side menu  -->
 <aside class="sm:max-w-xs w-full bg-white rounded-md py-6 px-4 space-y-2 md:space-y-4 self-baseline">
  <!-- side menu links -->
  <div class="flex flex-col flex-grow overflow-y-auto">
   <div class="flex-grow flex flex-col">
    <nav class="flex-1 px-2 space-y-1 text-sm md:text-base divide-y-2 divide-gray-300 font-medium" aria-label="Sidebar">
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
    User List Under This Department
   </h3>
   <p class="text-sm md:text-base">
    {{$department->name}} Department has {{$department->users->count()}} users.
   <main class=" mt-8">
    <ul class="w-full">
     <li class="flex items-center justify-between py-2 px-5 mb-3 text-center">
      <p class="flex items-center text-[#707070] text-base w-[5%] justify-center">
       <span class="text-[#707070] text-base">SL</span>
       <span class="flex flex-col ml-1 -mt-1"><i class="fa-solid fa-sort-up h-[1px] text-[10px]"></i>
        <i class="fa-solid fa-sort-down h-[1px] text-[10px]"></i>
       </span>
      </p>
      <p class="flex items-center text-[#707070] text-base w-[28%] justify-center">
       User Name
       <span class="flex flex-col ml-1 -mt-1"><i class="fa-solid fa-sort-up h-[1px] text-[10px]"></i>
        <i class="fa-solid fa-sort-down h-[1px] text-[10px]"></i>
       </span>
      </p>
      <p class="flex items-center text-[#707070] text-base w-[20%] justify-center">
       Email
       <span class="flex flex-col ml-1 -mt-1"><i class="fa-solid fa-sort-up h-[1px] text-[10px]"></i>
        <i class="fa-solid fa-sort-down h-[1px] text-[10px]"></i>
       </span>
      </p>
      <p class="flex items-center text-[#707070] text-base w-[20%] justify-center">
       Phone
       <span class="flex flex-col ml-1 -mt-1"><i class="fa-solid fa-sort-up h-[1px] text-[10px]"></i>
        <i class="fa-solid fa-sort-down h-[1px] text-[10px]"></i>
       </span>
      </p>
     </li>
     @foreach ($department->users as $user)
     <li class="bg-white flex items-center justify-between py-2 px-5 mb-5 text-center">
      <p class="w-[5%]">{{$loop->index+1}}</p>
      <p class="w-[28%]">{{$user->name}}</p>
      <p class="w-[17%]">{{$user->email}}</p>
      <p class="w-[17%]">{{$user->phone}}</p>
     </li>
     @endforeach
     <li class="hidden bg-white flex items-center justify-between py-2 px-5 mb-5 text-center">
      <p class="w-[5%]">1</p>
      <p class="w-[28%]">This is devices name list Lorem ipsum</p>
      <p class="w-[17%]">Categories Name</p>
      <p class="w-[18%]">Sub-Categories Name</p>
      <p class="w-[10%]"><i class="fa-solid fa-eye"></i> 450</p>
      <p class="w-[10%] text-[#009e0f]">
       <i class="fa-solid fa-heart"></i>
      </p>
      <p class="w-[10%]">
       <button class="bg-[#707070] text-white w-full py-1 rounded-3xl">
        Inactive
       </button>
      </p>
     </li>
    </ul>
   </main>
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