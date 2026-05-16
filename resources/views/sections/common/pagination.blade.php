@if (($page['totalPages'] ?? 1) > 1)
    <div class="d-flex justify-content-center py-4">
        <ul class="custom-pagination">
            @for ($i = 1; $i <= $page['totalPages']; $i++)
                @php($query = array_merge(request()->query(), [$page['param'] => $i]))
                <li class="page-item {{ $page['currentPage'] === $i ? 'active' : '' }}">
                    <a href="{{ url()->current() . '?' . http_build_query($query) }}">{{ $i }}</a>
                </li>
            @endfor
        </ul>
    </div>
@endif
