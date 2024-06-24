<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-end">
            <nav aria-label="...">
                <ul class="pagination">
                    {{-- Link Previous --}}
                    @if ($items->onFirstPage())
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">Previous</a>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $items->previousPageUrl() }}" tabindex="-1">Previous</a>
                        </li>
                    @endif
        
                    {{-- Link Number --}}
                    @foreach ($items->links()->elements as $element)
                        @if (is_string($element))
                            <li class="page-item disabled"><a class="page-link" href="#">{{ $element }}</a></li>
                        @endif
        
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $items->currentPage())
                                    <li class="page-item active"><a class="page-link" href="#">{{ $page }} <span class="sr-only">(current)</span></a></li>
                                @else
                                    <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
        
                    {{-- Link Next --}}
                    @if ($items->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $items->nextPageUrl() }}">Next</a>
                        </li>
                    @else
                        <li class="page-item disabled">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
            
        
    </div>
    
    
</div>
