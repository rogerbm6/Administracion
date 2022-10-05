<div>
    @if ($paginator->hasPages())

    <div class="card-footer py-4 align-items-center">
        <nav aria-label="...">
            <ul class="pagination justify-content-end mb-0">
                @if (!$paginator->onFirstPage())
                <li wire:click="previousPage" :wire:key="foo" class="page-item" id="anterior">
                    <a class="page-link">
                        <i class="fas fa-angle-left"></i>
                        <span class="sr-only">Anterior</span>
                    </a>
                </li>
                @endif

                    @foreach ($elements as $element)

                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page==$paginator->currentPage())
                                <li class="page-item active">
                                    <a class="page-link">{{$page}}</a>
                                </li>
                                @else 
                                <li class="page-item" wire:click="gotoPage({{$page}})">
                                    <a class="page-link">{{$page}}</a>
                                </li>
                                @endif
                            @endforeach
                            
                        @endif
                    @endforeach
                
                @if ($paginator->hasMorePages())
                <li wire:click="nextPage" class="page-item" id="siguiente">
                    <a class="page-link">
                        <i class="fas fa-angle-right"></i>
                        <span class="sr-only">Siguiente</span>
                    </a>
                </li>
                @endif
            </ul>
        </nav>
    </div>
    @endif
</div>