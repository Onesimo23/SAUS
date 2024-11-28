<x-authentication-layout>
    <h1 class="text-3xl text-gray-800 dark:text-gray-100 font-bold mb-6">{{ __('Welcome back!') }}</h1>
    @if (session('status'))
    <div class="mb-4 font-medium text-sm text-green-600">
        {{ session('status') }}
    </div>
    @endif
    <!-- Form -->
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="space-y-4">
            <div>
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" type="email" name="email" :value="old('email')" required autofocus />
            </div>
            <div>
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" type="password" name="password" required autocomplete="current-password" />
            </div>
        </div>
        <div class="flex items-center justify-between mt-6">
            @if (Route::has('password.request'))
            <div class="mr-1">
                <a class="text-sm underline hover:no-underline" href="{{ route('password.request') }}">
                    {{ __('Forgot Password?') }}
                </a>
            </div>
            @endif
            <x-button class="ml-3">
                {{ __('Sign in') }}
            </x-button>
        </div>
    </form>
    <x-validation-errors class="mt-4" />
    
    <!-- Divider for alternative logins -->
    <div class="flex items-center my-6">
        <div class="flex-grow border-t border-gray-300"></div>
        <span class="px-3 text-sm text-gray-600 dark:text-gray-400">{{ __('Or continue with') }}</span>
        <div class="flex-grow border-t border-gray-300"></div>
    </div>

    <!-- GitHub Login Button -->
    <div class="mt-4">
        <a href="{{ route('auth.github') }}" class="flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-gray-800 rounded-lg hover:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-700">
            <svg class="w-5 h-5 mr-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true">
                <path d="M12 .297C5.373.297 0 5.67 0 12.297c0 5.291 3.438 9.794 8.205 11.387.6.111.82-.26.82-.578v-2.24c-3.338.724-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.236 1.839 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.774.418-1.305.763-1.604-2.665-.305-5.466-1.331-5.466-5.931 0-1.31.469-2.382 1.236-3.222-.124-.305-.535-1.53.118-3.187 0 0 1.008-.324 3.3 1.23a11.38 11.38 0 013.002-.403c1.02.004 2.046.138 3.002.403 2.291-1.554 3.297-1.23 3.297-1.23.653 1.657.243 2.882.12 3.187.77.84 1.236 1.912 1.236 3.222 0 4.611-2.807 5.623-5.478 5.921.431.37.814 1.102.814 2.222v3.293c0 .32.219.694.825.577C20.565 22.09 24 17.588 24 12.297 24 5.67 18.627.297 12 .297z"/>
            </svg>
            {{ __('Sign in with GitHub') }}
        </a>
    </div>

    <!-- Footer -->
    <div class="pt-5 mt-6 border-t border-gray-100 dark:border-gray-700/60">
        <div class="text-sm">
            {{ __('Don\'t you have an account?') }} <a class="font-medium text-violet-500 hover:text-violet-600 dark:hover:text-violet-400" href="{{ route('register') }}">{{ __('Sign Up') }}</a>
        </div>
        <!-- Warning -->
        <div class="mt-5">
            <div class="bg-yellow-500/20 text-yellow-700 px-3 py-2 rounded-lg">
                <span class="text-sm">
                    Conecte-se com a comunidade alumni da Universidade Save e mantenha contato 
                    com colegas e mentores. Explore oportunidades exclusivas, eventos e muito mais.
                    Juntos, continuamos a crescer!
                </span>
            </div>
        </div>
    </div>
</x-authentication-layout>
