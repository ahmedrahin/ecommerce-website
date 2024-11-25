@extends('frontend.layout.app')
    
@section('page-title')
    Checkout | {{config('app.name')}}
@endsection

@section('page-css')
   
@endsection

    
@section('body-content')

    <section class="pt-3">
        <div class="custom-container container"> 
            <livewire:frontend.cart.cart-list />
        </div>
    </section>

@endsection 
