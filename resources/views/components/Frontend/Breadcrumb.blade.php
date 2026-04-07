<div>
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                @foreach ($items as $item)
                    @if (!$loop->last)
                        <a href="{{ $item['url'] }}" rel="nofollow"><iclass="{{ $item['icon'] }} mr-5"></iclass=>{{ $item['label'] }}</a>
                    @else
                    <span></span> {{ $item['label'] }}
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
