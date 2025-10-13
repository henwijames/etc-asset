<x-layouts.guest>
    <x-slot:title>Login | ETC Asset Management System</x-slot:title>
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <img src={{ asset('assets/etclogo.jpeg') }} alt="Your Company" class="mx-auto h-36 w-auto" />
            <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight">Sign in to your account</h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form action='/login' method="POST" class="space-y-4">
                @csrf
                <div>

                    <x-form-input name="email" type="email" label="Email" placeholder="ericktrco@etc.com" />
                    @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>

                    <x-form-input name="password" type="password" label="Password" placeholder="Password" />
                    @error('password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <button type="submit" class="btn btn-primary w-full">Sign in</button>
                </div>
            </form>
        </div>
    </div>

</x-layouts.guest>
