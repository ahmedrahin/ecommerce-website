"use strict";

// Class definition
var KTAppEcommerceSalesSaveOrder = function () {
    

   // Shared variables
   var table;
   var datatable;

   // Private functions
   const initSaveOrder = () => {
       // Init flatpickr
       $('#kt_ecommerce_edit_order_date').flatpickr({
           altInput: true,
           altFormat: "d F, Y",
           dateFormat: "Y-m-d",
       });

       // Init select2 country options
       // Format options
       const optionFormat = (item) => {
           if ( !item.id ) {
               return item.text;
           }

           var span = document.createElement('span');
           var template = '';

          
           template += item.text;

           span.innerHTML = template;

           return $(span);
       }

       // Init Select2 --- more info: https://select2.org/        
       $('#kt_ecommerce_order_district').select2({
           placeholder: "Select a city",
           minimumResultsForSearch: 0,
           templateSelection: optionFormat,
           templateResult: optionFormat
       });


       // Init datatable --- more info on datatables: https://datatables.net/manual/
       table = document.querySelector('#kt_ecommerce_edit_order_product_table');
       datatable = $(table).DataTable({
           'order': [],
           "scrollY": "100px",
           "scrollCollapse": true,
           "paging": false,
           "info": false,
           'columnDefs': [
               { orderable: false, targets: 0 }, // Disable ordering on column 0 (checkbox)
           ]
       });
   }

   // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
   var handleSearchDatatable = () => {
       const filterSearch = document.querySelector('[data-kt-ecommerce-edit-order-filter="search"]');
       filterSearch.addEventListener('keyup', function (e) {
           datatable.search(e.target.value).draw();
       });
   }


    // Public methods
    return {
        init: function () {
            initSaveOrder();
            handleSearchDatatable();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTAppEcommerceSalesSaveOrder.init();
});
