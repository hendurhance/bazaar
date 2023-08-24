<!-- Success Notification -->
@if (session()->has('success'))
<div
   class="notify fixed inset-0 flex items-end justify-center px-4 py-6 pointer-events-none sm:p-6 sm:items-start sm:justify-end">
   <div id="bodyToast" x-data="{ show:  true  }" x-show="show" x-description="Notification panel, show/hide based on alert state."
      x-transition:enter="transform ease-out duration-300 transition"
      x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
      x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
      x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100"
      x-transition:leave-end="opacity-0"
      class="max-w-sm w-full  bg-white  shadow-lg rounded-lg pointer-events-auto border-l-4  border-green-600    ">
      <div class="relative rounded-lg shadow-xs overflow-hidden">
         <div class="p-4">
            <div class="flex items-start">
               <div
                  class="inline-flex items-center bg-green-600 p-2 text-white text-sm rounded-full flex-shrink-0">
                  <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" class="check w-5 h-5">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                     </path>
                  </svg>
               </div>
               <div class="ml-4 w-0 flex-1">
                  <p class="text-base leading-5 font-medium capitalize  text-green-600    ">
                     success
                  </p>
                  <p id="textToast" class="mt-1 text-sm leading-5  text-gray-500 ">
                     {{ session('success') }}
                  </p>
               </div>
               <div class="ml-4 flex-shrink-0 flex">
                  <button @click="show = false;"
                     class="inline-flex text-gray-400 focus:outline-none focus:text-gray-500 transition ease-in-out duration-150 notify-button">
                     <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                           d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                           clip-rule="evenodd"></path>
                     </svg>
                  </button>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endif
<!-- Success Emoji Notification -->
@if (session()->has('success.emoji'))
<div class="notify fixed inset-0 flex items-end justify-center px-4 py-6 pointer-events-none sm:p-6 sm:items-start sm:justify-end">
   <div id="bodyToast" x-data="{ show:  true  }" x-init="setTimeout(() => { show = true }, 500)" x-show="show" x-description="Notification panel, show/hide based on alert state." x-transition:enter="transform ease-out duration-300 transition" x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2" x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="max-w-sm w-full  bg-white  shadow-lg rounded-lg pointer-events-auto">
      <div class="relative rounded-lg shadow-xs overflow-hidden">
         <div class="p-4">
            <div class="flex items-start">
               <div class="inline-flex items-center text-white text-2xl rounded-full flex-shrink-0">
                  <span>👍</span>
               </div>
               <div class="ml-6 w-0 flex-1">
                  <p class="text-base leading-5 font-medium capitalize  text-green-600 ">
                     success !
                  </p>
                  <p id="textToast" class="mt-1 text-sm leading-5  text-gray-500 ">
                     {{ session('success.emoji') }}
                  </p>
               </div>
               <div class="ml-4 flex-shrink-0 flex">
                  <button @click="show = false;" class="inline-flex text-gray-400 focus:outline-none focus:text-gray-500 transition ease-in-out duration-150 notify-button">
                     <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                     </svg>
                  </button>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endif
<!-- Info Notification -->
@if (session()->has('info'))
<div class="notify fixed inset-0 flex items-end justify-center px-4 py-6 pointer-events-none sm:p-6 sm:items-start sm:justify-end">
   <div id="bodyToast" x-data="{ show:  true  }" x-show="show" x-description="Notification panel, show/hide based on alert state." x-transition:enter="transform ease-out duration-300 transition" x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2" x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="max-w-sm w-full  bg-white  shadow-lg rounded-lg pointer-events-auto border-l-4    border-blue-600  ">
      <div class="relative rounded-lg shadow-xs overflow-hidden">
         <div class="p-4">
            <div class="flex items-start">
               <div class="inline-flex items-center bg-blue-600 p-2 text-white text-sm rounded-full flex-shrink-0">
                  <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" class="exclamation-circle w-5 h-5">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                  </svg>
               </div>
               <div class="ml-4 w-0 flex-1">
                  <p class="text-base leading-5 font-medium capitalize    text-blue-600  ">
                     info
                  </p>
                  <p id="textToast" class="mt-1 text-sm leading-5  text-gray-500 ">
                     {{ session('info') }}
                  </p>
               </div>
               <div class="ml-4 flex-shrink-0 flex">
                  <button @click="show = false;" class="inline-flex text-gray-400 focus:outline-none focus:text-gray-500 transition ease-in-out duration-150 notify-button">
                     <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                     </svg>
                  </button>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endif
<!-- Warning Notification -->
@if (session()->has('warning'))
<div class="notify fixed inset-0 flex items-end justify-center px-4 py-6 pointer-events-none sm:p-6 sm:items-start sm:justify-end">
   <div id="bodyToast" x-data="{ show:  true  }" x-show="show" x-description="Notification panel, show/hide based on alert state." x-transition:enter="transform ease-out duration-300 transition" x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2" x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="max-w-sm w-full  bg-white  shadow-lg rounded-lg pointer-events-auto border-l-4   border-yellow-400   ">
      <div class="relative rounded-lg shadow-xs overflow-hidden">
         <div class="p-4">
            <div class="flex items-start">
               <div class="inline-flex items-center bg-yellow-400 p-2 text-white text-sm rounded-full flex-shrink-0">
                  <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" class="exclamation w-5 h-5">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                  </svg>
               </div>
               <div class="ml-4 w-0 flex-1">
                  <p class="text-base leading-5 font-medium capitalize   text-yellow-400   ">
                     warning
                  </p>
                  <p id="textToast" class="mt-1 text-sm leading-5  text-gray-500 ">
                     {{ session('warning') }}
                  </p>
               </div>
               <div class="ml-4 flex-shrink-0 flex">
                  <button @click="show = false;" class="inline-flex text-gray-400 focus:outline-none focus:text-gray-500 transition ease-in-out duration-150 notify-button">
                     <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                     </svg>
                  </button>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endif
<!-- Error Notification -->
@if (session()->has('error'))
<div class="notify fixed inset-0 flex items-end justify-center px-4 py-6 pointer-events-none sm:p-6 sm:items-start sm:justify-end">
   <div id="bodyToast" x-data="{ show:  true  }" x-show="show" x-description="Notification panel, show/hide based on alert state." x-transition:enter="transform ease-out duration-300 transition" x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2" x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="max-w-sm w-full  bg-white  shadow-lg rounded-lg pointer-events-auto border-l-4     border-red-600 ">
      <div class="relative rounded-lg shadow-xs overflow-hidden">
         <div class="p-4">
            <div class="flex items-start">
               <div class="inline-flex items-center bg-red-600 p-2 text-white text-sm rounded-full flex-shrink-0">
                  <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" class="x w-5 h-5">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                  </svg>
               </div>
               <div class="ml-4 w-0 flex-1">
                  <p class="text-base leading-5 font-medium capitalize     text-red-600 ">
                     error
                  </p>
                  <p id="textToast" class="mt-1 text-sm leading-5  text-gray-500 ">
                     {{ session('error') }}
                  </p>
               </div>
               <div class="ml-4 flex-shrink-0 flex">
                  <button @click="show = false;" class="inline-flex text-gray-400 focus:outline-none focus:text-gray-500 transition ease-in-out duration-150 notify-button">
                     <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                     </svg>
                  </button>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endif
<script>
   var notify = {
       timeout: 10000,
   }

   function toast(toastElement, textToastElement) {
        const hs_theme = localStorage.getItem('bazaar_theme');

        if (hs_theme === 'dark') {
            toastElement.classList.remove('bg-white');
            toastElement.classList.add('bg-gray-800');
            textToastElement.classList.remove('text-gray-500');
            textToastElement.classList.add('text-white');
        }
    }

    // Call the function with the appropriate elements
    const bodyToast = document.getElementById('bodyToast');
    const textToast = document.getElementById('textToast');
    toast(bodyToast, textToast);
    
</script>