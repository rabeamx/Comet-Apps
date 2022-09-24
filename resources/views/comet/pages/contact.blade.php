@extends('comet.layouts.app')

@section('comet-main')
    
<section class="page-title parallax">
    <div data-parallax="scroll" data-image-src="{{ url('frontend/images/bg/11.jpg') }}" class="parallax-bg"></div>
    <div class="parallax-overlay">
      <div class="centrize">
        <div class="v-center">
          <div class="container">
            <div class="title center">
              <h1 class="upper">Drop a Line<span class="red-dot"></span></h1>
              <h4>Let’s get in touch.</h4>
              <hr>
            </div>
          </div>
          <!-- end of container-->
        </div>
      </div>
    </div>
</section>

<section> 
  <div class="container">
    <div class="row">

      @php
          $counter = App\Models\Counter::latest() -> take(4)  -> get();
      @endphp

      @foreach ($counter as $item)
      <div class="col-md-3 col-sm-6">
        <div class="counter">
          <div class="counter-icon"><i class="{{ $item -> icon }}"></i>
          </div>
          <div class="counter-content">
            <h5><span data-count="{{ $item -> count }}" class="number-count">{{ $item -> count }}</span><span class="red-dot"></span></h5><span>{{ $item -> title }}</span>
          </div>
        </div>
        <!-- end of counter -->
      </div>
      @endforeach

    </div>
  </div>
</section>

@endsection