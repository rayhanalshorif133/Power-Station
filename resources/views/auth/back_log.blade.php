<form class="mt-8 space-y-6" action="{{route('user.login')}}" method="POST">
  @csrf
  <input type="hidden" name="remember" value="true">
  <div class="-space-y-px rounded-md shadow-sm">
    <div>
      <label for="email-address" class="sr-only">Email address</label>
      <input id="email-address" name="email" type="email" autocomplete="email" required
        class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-primary-500 focus:outline-none focus:ring-primary-500 sm:text-sm"
        placeholder="Email address">
    </div>
    <div>

      <label for="password" class="sr-only">Password</label>
      <input id="password" name="password" type="password" autocomplete="current-password" required
        class="relative block w-full appearance-none rounded-none rounded-b-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-primary-500 focus:outline-none focus:ring-primary-500 sm:text-sm"
        placeholder="Password">
    </div>
  </div>

  <div class="flex items-center justify-between hidden">
    <div class="flex items-center">
      <input id="remember-me" name="remember-me" type="checkbox"
        class="h-4 w-4 rounded border-gray-300 text-primary-600 focus:ring-primary-500">
      <label for="remember-me" class="ml-2 block text-sm text-gray-900">Remember me</label>
    </div>

    <div class="text-sm">
      <a href="#" class="font-medium text-primary-600 hover:text-primary-500">Forgot your password?</a>
    </div>
  </div>

  <div>
    <button type="submit" name="submit"
      class="w-full justify-center rounded-md border border-transparent py-2 px-4 text-sm font-medium text-white loginBtn focus:outline-none focus:primary focus:ring-offset-2">
      Sign in
    </button>
  </div>
</form>