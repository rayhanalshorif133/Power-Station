<aside class="sm:max-w-xs w-full bg-white rounded-md py-6 px-4 space-y-2 md:space-y-4">
 <input type="text"
  class="rounded-md border-primary border-2 px-2 md:px-3 py-0.5 md:py-1.5 placeholder:text-primary w-full"
  placeholder="Search Categories……" />
 <!-- side menu links -->
 <div class="flex flex-col flex-grow overflow-y-auto">
  <div class="flex-grow flex flex-col">
   <nav class="flex-1 px-2 space-y-1 text-sm md:text-base" aria-label="Sidebar">
    <div>
     <a href="{{route('public.learning.publicDashboard')}}"
      class="text-gray-900 group w-full flex items-center pl-0.5 py-2 border-b-2">
      Dashboard
     </a>
    </div>
    <div>
     <a href="{{route('public.learning.publicIndex')}}"
      class="text-gray-900 group w-full flex items-center pl-0.5 py-2 border-b-2">
      Learning
     </a>
    </div>
    <div>
     <a href="{{route('public.learning.publicDeviceStatusList')}}"
      class="text-gray-900 group w-full flex items-center pl-0.5 py-2 border-b-2">
      Device Status List
     </a>
    </div>
    <div class="space-y-1 hidden">
     <!-- Current: "bg-gray-100 text-gray-900", Default: "bg-white text-gray-600 hover:bg-gray-50 hover:text-gray-900" -->
     <button type="button"
      class="bg-white group w-full flex items-center pl-0.5 pr-1 py-2 text-left focus:outline-none border-b-2"
      aria-controls="sub-menu-1" aria-expanded="true">
      <span class="flex-1"> Team </span>
      <!-- Expanded: "text-gray-400 rotate-90", Collapsed: "text-gray-300" -->
      <i class="fa-solid fa-angle-right"></i>
     </button>
     <!-- Expandable link section, show/hide based on state. -->
     <div class="space-y-1" id="sub-menu-1">
      <a href="#" class="group w-full flex items-center justify-between pl-4 pr-1 py-2 border-b-2">
       <span>Overview</span>
       <span>12</span>
      </a>
     </div>
    </div>
   </nav>
  </div>
 </div>
</aside>