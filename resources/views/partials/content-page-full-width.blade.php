@if( have_rows( 'full_width_content_layouts', wpc_get_the_id() ) )
  @while( have_rows( 'full_width_content_layouts', wpc_get_the_id() ) ) @php( the_row() )
    @include( 'flexibles.' . get_row_layout() )
  @endwhile
@endif
