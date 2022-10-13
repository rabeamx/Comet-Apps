@extends('comet.layouts.app')

@section('comet-main')
    
<section class="page-title parallax">
    <div data-parallax="scroll" data-image-src="{{ url('frontend/images/bg/10.jpg') }}" class="parallax-bg"></div>
    <div class="parallax-overlay">
      <div class="centrize">
        <div class="v-center">
          <div class="container">
            <div class="title center">
              <h1 class="upper">Our Blog<span class="red-dot"></span></h1>
              <h4>Let’s get in touch.</h4>
              <hr>
            </div>
          </div>
          <!-- end of container-->
        </div>
      </div>
    </div>
</section>

@php

if( isset($_GET['search']) ){
    $key = $_GET['search'];
    $posts = App\Models\Post::where('title', 'LIKE', '%'.$key.'%') -> orWhere('content', 'LIKE', '%'.$key.'%') -> get();
}
    
@endphp

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
            <div class="blog-posts">

                @foreach ($posts as $post)

                <article class="post-single">
                <div class="post-info">
                    <h2><a href="#">{{ $post -> title }}</a></h2>
                    <h6 class="upper"><span>By</span><a href="#"> {{ $post -> author -> name }}</a><span class="dot"></span><span>{{ date('F d, Y', strtotime($post -> created_at )) }}</span><span class="dot"></span>

                        {{-- @php
                        // - only shows before the last one
                            $post_num = 1;
                        @endphp --}}
                        @foreach ($post -> tag as $tag)
                        <a href="#" class="post-tag">{{ $tag -> name }}</a> @if(($loop -> index +1) <  count($post -> tag) ) - @endif 
                        {{-- @if($post_num <  count($post -> tag) ) - @endif --}}
                        {{-- @php $post_num++ @endphp --}}
                        @endforeach
                    </h6>
                </div>

                @php
                    $featured = json_decode($post -> featured);
                @endphp
   
                @if($featured -> post_type == 'gallery')
                {{-- for gallery post --}}
                <div class="post-media">
                    <div data-options="{&quot;animation&quot;: &quot;slide&quot;, &quot;controlNav&quot;: true" class="flexslider nav-outside">
                    <ul class="slides">

                        @foreach (json_decode($featured -> gallery) as $gall )
                        <li class="" style="width: 100%; float: left; margin-right: -100%; position: relative; opacity: 0; display: block; z-index: 1;">
                        <img src="{{ url('storage/posts/gallery/'. $gall ) }}" alt="" draggable="false">
                        </li>
                        @endforeach

                        <li style="width: 100%; float: left; margin-right: -100%; position: relative; opacity: 0; display: block; z-index: 1;" class="">
                        <img src="frontend/images/blog/2.jpg" alt="" draggable="false">
                        </li>
                        <li style="width: 100%; float: left; margin-right: -100%; position: relative; opacity: 1; display: block; z-index: 2;" class="flex-active-slide">
                        <img src="frontend/images/blog/3.jpg" alt="" draggable="false">
                        </li>

                    </ul>
                    </div>
                </div>
                @endif

                @if($featured -> post_type == 'video')
                {{-- for video post --}}
                {{-- https://www.youtube.com/embed/rrT6v5sOwJg --}}
                <div class="post-media">
                    <div class="media-video">
                    <iframe src="{{ $featured -> video }}" frameborder="0"></iframe>
                    </div>
                </div>
                @endif

                {{-- for standard post --}}
                @if($featured -> post_type == 'standard')
                <div class="post-media">
                    <a href="#">
                    <img src="{{ url('storage/posts/standard/' . $featured -> standard) }}" alt="">
                    </a>
                </div>
                @endif

                {{-- for audio post --}}
                @if($featured -> post_type == 'audio')
                <div class="post-media">
                    <div class="media-audio">
                    <iframe src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/51057943&amp;amp;color=ff5500&amp;amp;auto_play=false&amp;amp;hide_related=false&amp;amp;show_comments=true&amp;amp;show_user=true&amp;amp;show_reposts=false" frameborder="0"></iframe>
                    </div>
                </div>
                @endif

                <div class="post-body">
                    
                    {{-- {!! Str::limit(htmlspecialchars_decode( $post -> content ), 50) !!} --}}
                    {{-- {!! Str::of(htmlspecialchars_decode( $post -> content )) -> limit(100) !!} --}}
                    {{-- {!! Str::of(htmlspecialchars_decode( $post -> content )) -> words(20, '<a href="#" >read more</a>') !!} --}}
                    {!! Str::of(htmlspecialchars_decode( $post -> content )) -> words(20, '++++++++++++') !!}

                    <p><a href="{{ route('blog.single', $post -> slug) }}" class="btn btn-color btn-sm">Read More</a>
                    </p>
                </div>
                

                </article>

                @endforeach

                <!-- end of article-->

                {{-- <article class="post-single">
                <div class="post-info">
                    <h2><a href="#">Never Tell People What You Do</a></h2>
                    <h6 class="upper"><span>By</span><a href="#"> Admin</a><span class="dot"></span><span>28 September 2015</span><span class="dot"></span><a href="#" class="post-tag">Entrepreneurship</a></h6>
                </div>
                <div class="post-media">
                    <div class="media-video">
                    <iframe src="https://www.youtube.com/embed/rrT6v5sOwJg" frameborder="0"></iframe>
                    </div>
                </div>
                <div class="post-body">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestiae ut ratione similique temporibus tempora dicta soluta? Qui hic, voluptatem nemo quo corporis dignissimos voluptatum debitis cumque fugiat mollitia quasi quod. Repudiandae
                    possimus quas odio nisi optio asperiores, vitae error laudantium, ratione odit ipsa obcaecati debitis deleniti minus, illo maiores placeat omnis magnam.</p>
                    <p><a href="#" class="btn btn-color btn-sm">Read More</a>
                    </p>
                </div>
                </article> --}}
                <!-- end of article-->

                {{-- <article class="post-single">
                <div class="post-info">
                    <h2><a href="#">Give It Five Minutes</a></h2>
                    <h6 class="upper"><span>By</span><a href="#"> Admin</a><span class="dot"></span><span>28 September 2015</span><span class="dot"></span><a href="#" class="post-tag">Startups</a></h6>
                </div>
                <div class="post-body">
                    <blockquote class="italic">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et quam neque facilis similique laborum, nihil id ratione, error illum. Porro quas maxime accusamus numquam consequatur consequuntur eveniet quis, fuga repellendus.</p>
                    </blockquote>
                </div>
                </article> --}}
                <!-- end of article-->

                {{-- <article class="post-single">
                <div class="post-info">
                    <h2><a href="#">Uber Launches in Las Vegas</a></h2>
                    <h6 class="upper"><span>By</span><a href="#"> Admin</a><span class="dot"></span><span>28 September 2015</span><span class="dot"></span><a href="#" class="post-tag">Startups</a></h6>
                </div>
                <div class="post-media">
                    <a href="#">
                    <img src="frontend/images/blog/4.jpg" alt="">
                    </a>
                </div>
                <div class="post-body">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestiae ut ratione similique temporibus tempora dicta soluta? Qui hic, voluptatem nemo quo corporis dignissimos voluptatum debitis cumque fugiat mollitia quasi quod. Repudiandae
                    possimus quas odio nisi optio asperiores, vitae error laudantium, ratione odit ipsa obcaecati debitis deleniti minus, illo maiores placeat omnis magnam.</p>
                    <p><a href="#" class="btn btn-color btn-sm">Read More</a>
                    </p>
                </div>
                </article> --}}
                <!-- end of article-->

                {{-- <article class="post-single">
                <div class="post-info">
                    <h2><a href="#">Fun With Product Hunt</a></h2>
                    <h6 class="upper"><span>By</span><a href="#"> Admin</a><span class="dot"></span><span>28 September 2015</span><span class="dot"></span><a href="#" class="post-tag">Tech</a></h6>
                </div>
                <div class="post-media">
                    <div class="media-audio">
                    <iframe src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/51057943&amp;amp;color=ff5500&amp;amp;auto_play=false&amp;amp;hide_related=false&amp;amp;show_comments=true&amp;amp;show_user=true&amp;amp;show_reposts=false" frameborder="0"></iframe>
                    </div>
                </div>
                <div class="post-body">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestiae ut ratione similique temporibus tempora dicta soluta? Qui hic, voluptatem nemo quo corporis dignissimos voluptatum debitis cumque fugiat mollitia quasi quod. Repudiandae
                    possimus quas odio nisi optio asperiores, vitae error laudantium, ratione odit ipsa obcaecati debitis deleniti minus, illo maiores placeat omnis magnam.</p>
                    <p><a href="#" class="btn btn-color btn-sm">Read More</a>
                    </p>
                </div>
                </article> --}}
                <!-- end of article-->
            </div>

            <ul class="pagination">
                <li><a href="#" aria-label="Previous"><span aria-hidden="true"><i class="ti-arrow-left"></i></span></a>
                </li>
                <li class="active"><a href="#">1</a>
                </li>
                <li><a href="#">2</a>
                </li>
                <li><a href="#">3</a>
                </li>
                <li><a href="#">4</a>
                </li>
                <li><a href="#">5</a>
                </li>
                <li><a href="#" aria-label="Next"><span aria-hidden="true"><i class="ti-arrow-right"></i></span></a>
                </li>
            </ul>
            
            <!-- end of pagination-->
            </div>

            @include('comet.layouts.blog-sidebar')

        </div>
      <!-- end of row-->
    </div>
    <!-- end of container-->
</section>



@endsection