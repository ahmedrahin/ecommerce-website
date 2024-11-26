<x-default-layout>

    @section('title')
    Dashboard
    @endsection

    @section('breadcrumbs')
    {{ Breadcrumbs::render('dashboard') }}
    @endsection

    

    @push('scripts')

        @if (session('success'))
            <script>
                toastr.success("{{ session('success') }}");
            </script>
        @endif
    
    @endpush

</x-default-layout>