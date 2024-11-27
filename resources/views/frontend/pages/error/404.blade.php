@extends('frontend.layout.app')
    
@section('page-title')
    404 Not found | {{config('app.name')}}
@endsection

@section('page-css')
   
@endsection

    
@section('body-content')

<section >
    <div class="custom-container container error-img">
      <div class="row g-4">
        {{-- <div class="col-12 px-0"> <a href="#"><img class="img-fluid" src="../assets/images/other-img/404.png" alt=""></a></div> --}}
        <div class="col-12"> 
          <h2>Page Not Found </h2>
          <p>The page you are looking for doesn't exist or an other error occurred. Go back, or head over to choose a new direction. </p><a class="btn btn_black rounded" href="{{route('homepage')}}">Back Home Page 
            </a>
        </div>
      </div>
    </div>
  </section>

@endsection 
