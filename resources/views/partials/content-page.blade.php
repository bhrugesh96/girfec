@include('partials.sub-nav')

<div class="content-wrap">
  @if( have_rows( 'page_content_layouts', wpc_get_the_id() ) )
    @while( have_rows( 'page_content_layouts', wpc_get_the_id() ) ) @php( the_row() )
      @include( 'flexibles.page-content.' . get_row_layout() )
    @endwhile
  @endif

  @include('partials.feedback-form')
</div>
