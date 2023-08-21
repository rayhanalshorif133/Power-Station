<!-- footer  -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 my-8 md:my-12 space-y-2 md:space-y-3">
  <footer class="p-4 bg-white sm:p-6 md:pt-12 md:p-8">
    <div class="md:flex gap-6 md:gap-12">
      <div class="mb-6 md:mb-0 md:w-[20vw] space-y-4 md:space-y-5">
        <a href="/" class="flex items-center justify-center md:justify-start">
          <img src="{{asset('assets/front-end/image/Shahjibazar-logo.png')}}" class="mr-3 h-12 md:h-20"
            alt="Shahjibazar Power Co. Ltd" />
        </a>
        <p class="text-xs md:text-sm">
          Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ut
          fugit, porro eaque, enim placeat ipsum a laudantium architecto
        </p>
        <div class="space-y-2 text-sm md:text-base">
          <div class="flex gap-2 items-center">
            <i class="fa-solid fa-location-dot"></i>
            <p class="text-gray-500">N2, Shahjibazar</p>
          </div>
          <div class="flex gap-2 items-center text-gray-500">
            <i class="fa-sharp fa-solid fa-phone"></i>
            <p>01709-641889</p>
          </div>
          <div class="flex gap-2 items-center">
            <i class="fa-sharp fa-solid fa-envelope"></i>
            <p class="text-gray-500">name@email.com</p>
          </div>
        </div>
      </div>
      <div class="w-full grid grid-cols-2 gap-8 sm:gap-6 md:gap-20 sm:grid-cols-3">
        <div>
          <h2 class="mb-6 text-lg md:text-xl font-semibold text-gray-700 border-b-4 text-center pb-2 max-w-[200px]">
            Devices
          </h2>

          <ul class="text-gray-600 list-disc ml-4">
            <span class="deviceWaitingSpinner">
              <div class="justify-items-start space-y-5">
                <div class="spinner-border animate-spin w-8 h-8 border-4 rounded-full text-blue-600" role="status">
                  <span class="visually-hidden">Loading...</span>
                </div>
                <div class="spinner-border animate-spin w-8 h-8 border-4 rounded-full text-purple-500" role="status">
                  <span class="visually-hidden">Loading...</span>
                </div>
                <div class="spinner-border animate-spin w-8 h-8 border-4 rounded-full text-green-500" role="status">
                  <span class="visually-hidden">Loading...</span>
                </div>
                <div class="spinner-border animate-spin w-8 h-8 border-4 rounded-full text-red-500" role="status">
                  <span class="visually-hidden">Loading...</span>
                </div>
                <div class="spinner-border animate-spin w-8 h-8 border-4 rounded-full text-blue-300" role="status">
                  <span class="visually-hidden">Loading...</span>
                </div>
              </div>
            </span>
            <span id="footer-device-list"></span>
          </ul>
        </div>
        <div>
          <h2 class="mb-6 text-lg md:text-xl font-semibold text-gray-700 border-b-4 text-center pb-2 max-w-[200px]">
            Useful Links
          </h2>

          <ul class="text-gray-600 list-disc ml-4">
            <li class="mb-4">
              <a href="" class="hover:underline">Device name one</a>
            </li>
            <li class="mb-4">
              <a href="" class="hover:underline">Device name one</a>
            </li>
            <li class="mb-4">
              <a href="" class="hover:underline">Device name one</a>
            </li>
            <li class="mb-4">
              <a href="" class="hover:underline">Device name one</a>
            </li>
            <li class="mb-4">
              <a href="" class="hover:underline">Device name one</a>
            </li>
            <li class="mb-4">
              <a href="" class="hover:underline">Device name one</a>
            </li>
            <li class="mb-4">
              <a href="" class="hover:underline">Device name one</a>
            </li>
          </ul>
        </div>
        <div>
          <h2 class="mb-6 text-lg md:text-xl font-semibold text-gray-700 border-b-4 text-center pb-2 max-w-[200px]">
            Hotline
          </h2>

          <ul class="-mt-2">
            <img src="{{asset('assets/front-end/image/hotline.png')}}" alt="hotline" class="w-[70%]" />
          </ul>
        </div>
      </div>
    </div>
    <div class="flex flex-wrap text-xs md:text-sm justify-center gap-4 mt-4 md:mt-6">
      <p class="text-gray-500">
        Site was last updated 22 JUL 2021 05:30:44
      </p>
      <p class="text-primary">Contract & Feedback</p>
      <p class="text-primary">Download Mobile App</p>
    </div>
    <hr class="my-4 md:my-6 border-gray-700 sm:mx-auto" />
    <div class="sm:flex sm:items-center sm:justify-center">
      <p class="text-sm md:text-base text-gray-700 text-center">
        Copyright © 2022 Website Develop & Maintains by
        <a href="" class="hover:underline text-primary font-bold">TEXON Ltd
        </a>
      </p>
    </div>
  </footer>
</section>