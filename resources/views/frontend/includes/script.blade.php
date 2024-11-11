 <!-- Bootstrap js-->
 <script src="{{asset('frontend/js/bootstrap/bootstrap.bundle.min.js')}}"></script>

 <!-- cursor js-->
 <script src="{{asset('frontend/js/stats.min.js')}}"> </script>
 {{-- <script src="{{asset('frontend/js/cursor.js')}}"> </script> --}}

 <script src="{{asset('frontend/js/countdown.js')}}"></script>
 {{-- <script src="{{asset('frontend/js/newsletter.js')}}"></script> --}}
 <script src="{{asset('frontend/js/skeleton-loader.js')}}"></script>
 <!-- touchspin-->
 <script src="{{asset('frontend/js/touchspin.js')}}"></script>
 <script src="{{asset('frontend/js/grid-option.js')}}"></script>
 <!-- tost js -->
 <script src="{{asset('frontend/js/toastify.js')}}"></script>
 {{-- <script src="{{asset('frontend/js/theme-setting.js')}}"></script> --}}
 <!-- Theme js-->
 <script src="{{asset('frontend/js/script.js')}}"></script>

 {{-- iconsax --}}
 <script>
    function init_iconsax() {
        document.querySelectorAll(".iconsax").forEach((iconsax) => {
            const iconName = iconsax.getAttribute("data-icon").toLowerCase().trim();

            fetch(`https://glenthemes.github.io/iconsax/icons/${iconName}.svg`)
                .then(response => response.text())
                .then(svg => {
                    iconsax.innerHTML = svg;
                    // Remove SVG if it contains an invalid CSP (optional check)
                    if (iconsax.querySelectorAll("[http-equiv='Content-Security-Policy']").length) {
                        iconsax.innerHTML = "";
                    }
                });
        });
    }
    init_iconsax();
 </script>

 {{-- messages --}}
 <script>
    document.addEventListener('livewire:load', () => {
        Livewire.on('success', (message) => {
            Toastify({
                text: message,
                duration: 3000
            }).showToast();
        });
        
        Livewire.on('info', (message) => {
            Toastify({
                text: message,
                duration: 3000
            }).showToast();
        });

        Livewire.on('warning', (message) => {
            Toastify({
                text: message,
                
                duration: 3000
            }).showToast();
        });

        Livewire.on('error', (message) => {
            Toastify({
                text: message,
                backgroundColor: "#dc3545", // Red for error
                duration: 3000
            }).showToast();
        });
    });
</script>

 @yield('page-script')
