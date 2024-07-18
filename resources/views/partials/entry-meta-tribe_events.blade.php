<div class="entry-meta">
  <time class="updated" datetime="{{ tribe_get_start_time( null, 'c') }}">{{ tribe_get_start_date( get_the_ID(), false, 'd.m.Y' ) }}</time>

  @php( $event_cats = get_the_terms( get_the_ID(), 'tribe_events_cat' ) )
  @if( ! empty( $event_cats ) )
  <ul class="event-cats list-unstyled">
    @foreach( $event_cats as $event_cat )
      <li class="event-cat">
        <a href="{{ get_term_link( $event_cat ) }}" title="{{ $event_cat->name }}">
          {{ $event_cat->name }}
        </a>
      </li>
    @endforeach
  </ul>
  @endif
</div>
