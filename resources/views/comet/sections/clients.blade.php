<section>
    <div class="container">
      <div class="title center">
        <h4 class="upper">Some of the best.</h4>
        <h3>Our Clients<span class="red-dot"></span></h3>
        <hr>
      </div>
      <div class="section-content">
        <div class="boxes clients">
          <div class="row">

            @php
                $clients = App\Models\Client::where('status', true) -> where('trash', false) -> latest() -> get();
                $i = 1;
            @endphp

            @foreach ($clients as $item)
              @php
              if( $i == 1 ){
                $className = 'border-right border-bottom' ;
                $delay = 0;
              } elseif( $i == 2 ) {
                $className = 'border-right border-bottom' ;
                $delay = 0;
              } elseif ( $i == 3 ) {
                $className = 'border-bottom' ;
                $delay = 0;
              } elseif ( $i == 4 ) {
                $className = 'border-right' ;
                $delay = 0;
              } elseif ( $i == 5 ) {
                $className = 'border-right' ;
                $delay = 0;
              } elseif ( $i == 6 ) {
                $className = '' ;
                $delay = 0;
              }
              @endphp

              <div class="col-sm-4 col-xs-6 {{ $className }}">
                <img src="{{ url('storage/clients/', $item -> logo) }}" alt="" data-animated="true" class="client-image" data-delay="{{ $className }}">
              </div>
              @php $i ++; @endphp

            @endforeach

            {{-- <div class="col-sm-4 col-xs-6 border-right border-bottom">
              <img src="frontend/images/clients/1.png" alt="" data-animated="true" class="client-image">
            </div>

            <div class="col-sm-4 col-xs-6 border-right border-bottom">
              <img src="frontend/images/clients/2.png" alt="" data-animated="true" data-delay="500" class="client-image">
            </div>

            <div class="col-sm-4 col-xs-6 border-bottom">
              <img src="frontend/images/clients/3.png" alt="" data-animated="true" data-delay="1000" class="client-image">
            </div>
            <div class="col-sm-4 col-xs-6 border-right">
              <img src="frontend/images/clients/4.png" alt="" data-animated="true" class="client-image">
            </div>
            <div class="col-sm-4 col-xs-6 border-right">
              <img src="frontend/images/clients/5.png" alt="" data-animated="true" data-delay="500" class="client-image">
            </div>
            <div class="col-sm-4 col-xs-6">
              <img src="frontend/images/clients/6.png" alt="" data-animated="true" data-delay="1000" class="client-image">
            </div> --}}
          </div>
          <!-- end of row-->
        </div>
      </div>
      <!-- end of section content-->
    </div>
</section>