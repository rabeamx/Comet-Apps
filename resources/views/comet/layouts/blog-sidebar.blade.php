<div class="col-md-3 col-md-offset-1">
    <div class="sidebar hidden-sm hidden-xs">
        <div class="widget">
        <h6 class="upper">Search blog</h6>
        <form>
            <input type="text" name="search" placeholder="Search.." class="form-control">
        </form>
        </div>
        <!-- end of widget        -->
        @php 
            $categories = App\Models\Categorypost::all();
        @endphp
        <div class="widget">
        <h6 class="upper">Categories</h6>
        <ul class="nav">
            @foreach ($categories as $cat)
                
            <li><a href="{{ route('blog.post.category', $cat -> slug) }}">{{ $cat -> name }}</a>
            </li>

            @endforeach
        </ul>
        </div>
        <!-- end of widget        -->
        <div class="widget">
        <h6 class="upper">Popular Tags</h6>
        <div class="tags clearfix">
            @php 
            $tags = App\Models\Tag::all();
            @endphp
            @foreach ($tags as $tag) 
            <a href="{{ route('blog.post.post-tag', $tag -> slug) }}">{{ $tag -> name }}</a>
            @endforeach
        </div>
        </div>
        <!-- end of widget      -->
        <div class="widget">
        <h6 class="upper">Latest Posts</h6>
        <ul class="nav">
            @php 
            $posts = App\Models\Post::take(5) -> get();
            @endphp
            @foreach ($posts as $post) 
            <li><a href="{{ $post -> slug }}">{{ $post -> title }}<i class="ti-arrow-right"></i><span>{{ date('F d, Y', strtotime($post -> created_at )) }}</span></a>
            </li>
            @endforeach
        </ul>
        </div>
        <!-- end of widget          -->
    </div>
    <!-- end of sidebar-->
</div>