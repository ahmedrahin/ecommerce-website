@extends('frontend.layout.app')
    
@section('page-title')
    Checkout | {{config('app.name')}}
@endsection

@section('page-css')
 
@endsection

    
@section('body-content')

  <section class="section-b-space pt-0 pb-0">
    <div class="custom-container container"> 
      <livewire:frontend.order.checkout />
    </div>
  </section>
 
@endsection 
    
@section('page-script')
  


@endsection