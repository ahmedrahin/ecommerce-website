 <!-- Bootstrap js-->
 <script src="{{asset('frontend/js/bootstrap/bootstrap.bundle.min.js')}}"></script>

 <!-- cursor js-->
 <script src="{{asset('frontend/js/stats.min.js')}}"> </script>
 {{-- <script src="{{asset('frontend/js/cursor.js')}}"> </script> --}}

 {{-- <script src="{{asset('frontend/js/countdown.js')}}"></script> --}}
 {{-- <script src="{{asset('frontend/js/newsletter.js')}}"></script> --}}
 <script src="{{asset('frontend/js/skeleton-loader.js')}}"></script>
 <!-- tost js -->
 <script src="{{asset('frontend/js/toastify.js')}}"></script>
 <!-- Theme js-->
 <script src="{{asset('frontend/js/script.js')}}" ></script>

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

<script>
    function addTocartFuncation() {
        const plusMinus = document.querySelectorAll('.quantity-quickview');

        plusMinus.forEach((element) => {
            const addButton = element.querySelector('.plus');
            const subButton = element.querySelector('.minus');
            const inputEl = element.querySelector('.quntity-filed');

            if (inputEl && inputEl.dataset.quantity) {
                const maxQuantity = parseInt(inputEl.dataset.quantity);

                // Remove existing event listeners using cloning technique
                const addButtonClone = addButton.cloneNode(true);
                addButton.parentNode.replaceChild(addButtonClone, addButton);

                const subButtonClone = subButton.cloneNode(true);
                subButton.parentNode.replaceChild(subButtonClone, subButton);

                // Add event listener to the "plus" button
                addButtonClone.addEventListener('click', function () {
                    let currentValue = Number(inputEl.value);
                    if (currentValue < maxQuantity) {
                        inputEl.value = currentValue + 1;
                        Livewire.emit('updateQuantity', inputEl.value);
                    }
                    addButtonClone.disabled = inputEl.value >= maxQuantity;
                    subButtonClone.disabled = false;
                });

                // Add event listener to the "minus" button
                subButtonClone.addEventListener('click', function () {
                    let currentValue = Number(inputEl.value);
                    if (currentValue > 1) {
                        inputEl.value = currentValue - 1;
                        Livewire.emit('updateQuantity', inputEl.value);
                    }
                    subButtonClone.disabled = inputEl.value <= 1;
                });

                // Set initial button states
                addButtonClone.disabled = inputEl.value >= maxQuantity;
                subButtonClone.disabled = inputEl.value <= 1;
            }
        });

        var sizeItems = document.querySelectorAll('#quick-view .option-box ul li');
        sizeItems.forEach(function (item) {
            item.addEventListener('click', function () {
                sizeItems.forEach(function (sizeItem) {
                    sizeItem.classList.remove('active');
                });
                this.classList.add('active');
                var selectedSize = this.getAttribute('data-size');
                Livewire.emit('selectSize', selectedSize);
            });
        });

        var colorItems = document.querySelectorAll('.color-variant li');
        colorItems.forEach(function (item) {
            item.addEventListener('click', function () {
                colorItems.forEach(function (colorItem) {
                    colorItem.classList.remove('active');
                });
                this.classList.add('active');
                var selectedColor = this.getAttribute('data-color');
                Livewire.emit('selectColor', selectedColor);
            });
        });
    }
</script>

<script>
    
    function toggleSearchBox() {
        const searchBox = document.getElementById('mobileSearchBox');
        if (searchBox.style.display === 'none' || searchBox.style.display === '') {
            searchBox.style.display = 'block';
        } else {
            searchBox.style.display = 'none';
        }
    }

    function closeSearchBox(event) {
        const searchBox = document.getElementById('mobileSearchBox');
        const mobileSearch = document.querySelector('.mobile-search');
        if (searchBox && !mobileSearch.contains(event.target)) {
            searchBox.style.display = 'none';
        }
    }

    document.addEventListener("DOMContentLoaded", function () {
        document.addEventListener('click', closeSearchBox);

        // Listen to Livewire events
        Livewire.on('serchUpdate', function () {
            toggleSearchBox();
        });
    });

    document.addEventListener('click', function (event) {
        const productList = document.getElementById('product-list');
        const searchInput = document.getElementById('search-input');

        // Check if the product list exists
        if (productList) {
            if (!productList.contains(event.target) && !searchInput.contains(event.target)) {
                // Hide the product list if clicked outside
                productList.style.display = 'none';
            } else if (searchInput.contains(event.target)) {
                // Show the product list when the search input is clicked
                productList.style.display = 'block';
            }
        }
    });

    
</script>

 {{-- reload js after livewire load --}}
 <script>
    document.addEventListener("livewire:load", function () {
        Livewire.hook('message.processed', (message, component) => {
            init_iconsax();
            addTocartFuncation();
            
            document.querySelectorAll('.quickview').forEach(function (element) {
                element.addEventListener('click', function () {
                    Livewire.emit('get_productId', this.getAttribute('data-product-id'));
                });
            });
        });
    });
 </script>


{{-- quick view modal --}}
<script>
    document.addEventListener('livewire:load', function () {
        Livewire.on('btnClose', () => {
          setTimeout(() => {
            const modalElement = document.getElementById('quick-view');
            const modalInstance = bootstrap.Modal.getInstance(modalElement); 
            modalInstance.hide();
          }, 1000);
        });
    });

    document.querySelectorAll('.quickview').forEach(function (element) {
        element.addEventListener('click', function () {
            Livewire.emit('get_productId', this.getAttribute('data-product-id'));
        });
    });
    
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
                className: "custom-toast-info",
                duration: 3000
            }).showToast();
        });

        Livewire.on('warning', (message) => {
            Toastify({
                text: message,
                className: "custom-toast-warning",
                duration: 3000
            }).showToast();
        });

        Livewire.on('error', (message) => {
            Toastify({
                text: message,
                className: "custom-toast-error",
                duration: 3000
            }).showToast();
        });

    });

    function error(message){
        Toastify({
            text: message,
            className: "custom-toast-error",
            duration: 3000
        }).showToast();
    }
</script>

 {{-- messages --}}
 @if (session('success'))
    <script>
        Toastify({
                text: "{{ session('success') }}",
                duration: 3000
            }).showToast();
    </script>
@endif
  

 @yield('page-script')
 @yield('addcart-js')
