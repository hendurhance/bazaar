<div class="blog-widget-item wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".4s"
    style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.4s; animation-name: fadeInUp;">
    <div class="top-blog">
        <div class="sidebar-widget-title">
            <h4>Post Tags</h4>
            <span></span>
        </div>
        <div class="blog-widget-body">
            <ul class="category-list">
                @foreach ($tags as $tag)
                <li><a href="{{ route('blog.index', ['tag' => $tag->id]) }}"><span>{{ $tag->name }}</span><span>{{ $tag->posts_count }}</span></a></li>
                @endforeach
            </ul>
        </div>
    </div>
</div>