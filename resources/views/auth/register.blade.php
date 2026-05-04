<x-layout>
    <div class="bg-white rounded-lg shadow-md w-full md:mx-width-xl mx-auto mt-12 p-8 py-12">
        <h2 class="text-4xl text-center font-bold mb-4">Register Here</h2>
        <form action="{{ route('register.store') }}" method="post">
            @csrf
            <x-inputs.text id="name" name="name" placeholder="Full Name" />
        </form>
    </div>
</x-layout>
