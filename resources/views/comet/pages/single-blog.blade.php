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
                    {!! htmlspecialchars_decode( $post -> content ) !!}

                </div>
            
            </article>
            <!-- end of article-->

            {{-- <div id="comments">
                <h5 class="upper">3 Comments</h5>
                <ul class="comments-list">
                <li>
                    <div class="comment">
                    <div class="comment-pic">
                        <img src="images/team/1.jpg" alt="" class="img-circle">
                    </div>
                    <div class="comment-text">
                        <h5 class="upper">Jesse Pinkman</h5><span class="comment-date">Posted on 29 September at 10:41</span>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maxime distinctio et quam possimus velit dolor sunt nisi neque, harum, dolores rem incidunt, esse ipsa nam facilis eum doloremque numquam veniam.</p><a href="#" class="comment-reply">Reply</a>
                    </div>
                    </div>
                    <ul class="children">
                    <li>
                        <div class="comment">
                        <div class="comment-pic">
                            <img src="images/team/2.jpg" alt="" class="img-circle">
                        </div>
                        <div class="comment-text">
                            <h5 class="upper">Arya Stark</h5><span class="comment-date">Posted on 29 September at 10:41</span>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque porro quae harum dolorem exercitationem voluptas illum ipsa sed hic, cum corporis autem molestias suscipit, illo laborum, vitae, dicta ullam minus.</p><a href="#" class="comment-reply">Reply</a>
                        </div>
                        </div>
                    </li>
                    </ul>
                </li>
                <li>
                    <div class="comment">
                    <div class="comment-pic">
                        <img src="images/team/3.jpg" alt="" class="img-circle">
                    </div>
                    <div class="comment-text">
                        <h5 class="upper">Rust Cohle</h5><span class="comment-date">Posted on 29 September at 10:41</span>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A deleniti sit beatae natus! Beatae velit labore, numquam excepturi, molestias reiciendis, ipsam quas iure distinctio quia, voluptate expedita autem explicabo illo.</p>
                        <a href="#" class="comment-reply">Reply</a>
                    </div>
                    </div>
                </li>
                </ul>
            </div> --}}
            <!-- end of comments-->

            {{-- <div id="respond">
                <h5 class="upper">Leave a comment</h5>
                <div class="comment-respond">
                <form class="comment-form">
                    <div class="form-double">
                    <div class="form-group">
                        <input name="author" type="text" placeholder="Name" class="form-control">
                    </div>
                    <div class="form-group last">
                        <input name="email" type="text" placeholder="Email" class="form-control">
                    </div>
                    </div>
                    <div class="form-group">
                    <textarea placeholder="Comment" class="form-control"></textarea>
                    </div>
                    <div class="form-submit text-right">
                    <button type="button" class="btn btn-color-out">Post Comment</button>
                    </div>
                </form>
                </div>
            </div> --}}
            <!-- end of comment form-->

            <div class="fb-comments" data-href="{{ Request::url() }}" data-width="" data-numposts="10"></div>

        </div>
        @include('comet.layouts.blog-sidebar')
      </div>
      <!-- end of row-->

    </div>
  </section>



@endsection