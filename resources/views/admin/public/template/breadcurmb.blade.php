<nav aria-label="Page breadcrumb" class="my-3">
    <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item breadcrumb-customer">
                    <i class="fas fa-tachometer-alt"></i>{{ $breadcrumb  }}
                </li>
                @if (isset($getNameCate))
                    <li class="breadcrumb-item active">
                        {{ $getNameCate }}
                    </li>
                @else

                @endif
            </ol>
    </div>
</nav>
