<h1 class="roboto-thin text-gray-700 text-2xl mb-10 text-center">Leave me a message!</h1>
<div class="flex items-center justify-center js-scroll fade-in-bottom">
    <form class="flex flex-1 flex-col px-2 md:px-40" id="contact-form" method="POST" action="/contact">
        @csrf
        <div class="flex flex-col items-start mb-6">
            <label class="block text-gray-700 font-bold md:text-right mb-1 md:mb-0 pr-4" for="name">
                Name
            </label>
            <input class="bg-gray-200 appearance-none border-2 border-gray-200 w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-gray-700" id="name" name="name" value="{{old('name')}}" type="text" required>
        </div>
        <div class="flex flex-col items-start mb-6">
            <label class="block text-gray-700 font-bold md:text-right mb-1 md:mb-0 pr-4" for="email">
                Email
            </label>
            <input class="bg-gray-200 appearance-none border-2 border-gray-200 w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-gray-700" id="email" name="email" value="{{old('email')}}" type="email" required>
        </div>
        <div class="flex flex-col items-start mb-6">
            <label class="block text-gray-700 font-bold md:text-right mb-1 md:mb-0 pr-4" for="message">
                Message
            </label>
            <textarea class="bg-gray-200 appearance-none border-2 border-gray-200 w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-gray-700" id="message" name="message" value="{{old('message')}}" rows="4" required></textarea>
        </div>
        <input id="g-recaptcha-response" name="g-recaptcha-response" type="hidden">

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <div class="flex justify-end items-end">
            <button 
                class="shadow bg-gray-700 hover:bg-gray-600 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4" 
                type="button"
                onclick="onSubmitContact(event)"
            >
                Send
            </button>
        </div>
    </form>
</div>