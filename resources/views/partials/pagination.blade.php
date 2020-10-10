@if( $pagination->total() > $pagination->perPage() )
<div class="wrapper">
    <div class="pagination">
        @if ($pagination->currentPage() !== 1)
            <a href="{{ $pagination->previousPageUrl() }}" class="paginationPrev" title="Previous">
            <i class="fa fa-caret-left"></i>&nbsp;&nbsp;&nbsp;Previous
        </a>
        @endif
        @if( $pagination->hasMorePages())
        <a href="{{ $pagination->nextPageUrl() }}" class="paginationNext" title="Next">
            Next&nbsp;&nbsp;&nbsp;<i class="fa fa-caret-right"></i>
        </a>
        @endif
    </div>
</div>
@endif
