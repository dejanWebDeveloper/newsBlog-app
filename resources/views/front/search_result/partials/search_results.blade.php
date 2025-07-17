<div class="col-lg-8">

    @php
        // Pripremi regex za označavanje (case-insensitive)
        $highlight = function ($text, $query) {
            return preg_replace('/(' . preg_quote($query, '/') . ')/i', '<mark>$1</mark>', $text);
        };
    @endphp

    @if($results->count())
        <ul>
            @foreach($results as $article)
                <li class="list-unstyled">
                    <a href="{{ route('single_page', ['heading'=> $article->heading]) }}">

                        <h4>{!! $highlight($article->heading, $query) !!}</h4>
                        <h5>{!! $highlight($article->preheading, $query) !!}</h5>
                        <p>{!! $highlight(Str::limit($article->text, 200), $query) !!}</p>
                    </a>
                </li>
            @endforeach
        </ul>
    @else
        <p>Nema rezultata.</p>
    @endif

    <div class="mt-4" style="padding-top: 40px;">
        {{ $results->withQueryString()->links() }}
    </div>


</div>
