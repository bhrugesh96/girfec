<div class="entry-meta">
  <time class="updated" datetime="{{ get_post_time('c', true) }}">{{ get_the_date() }}</time>

  @php( $entry_cats = get_the_terms( get_the_ID(), 'category' ) )
    @if( ! empty( $entry_cats ) )
      <ul class="entry-cats list-unstyled">
        @foreach( $entry_cats as $entry_cat )
          <li class="entry-cat">
            <a href="{{ get_term_link( $entry_cat ) }}" title="{{ $entry_cat->name }}">
              {{ $entry_cat->name }}
            </a>
          </li>
        @endforeach
      </ul>
    @endif
</div>
