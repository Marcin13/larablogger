<div class="wrapper">
    <div class="pagination">
        @if($post->previous) <a href="{{route('posts.single',$post->previous)}}" class="paginationPrev"
                                title="Previous">
            <i class="fa fa-caret-left"></i>&nbsp;&nbsp;&nbsp;Previous
        </a>@endif
        @if($post->next)  <a href="{{route('posts.single',$post->next)}}" class="paginationNext"
                             title="Next">
            Next&nbsp;&nbsp;&nbsp;<i class="fa fa-caret-right"></i>
        </a>@endif
    </div>
</div>
