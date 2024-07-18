<article @php(post_class('content-wrap'))>
  <header>
    @if( has_post_thumbnail() )
      <figure class="entry-thumbnail img-cover">
        @php( the_post_thumbnail( 'girfec-thumbnail-lg' ) )
      </figure>
    @endif

    <h1 class="entry-title">{{ get_the_title() }}</h1>
    @include('partials/entry-meta-tribe_events')
  </header>

  @if( have_rows( 'event_content_layouts' ) )
    <div class="entry-content">
      @while( have_rows( 'event_content_layouts' ) ) @php( the_row() )
        @include( 'flexibles.page-content.' . get_row_layout() )
      @endwhile
    </div>
  @endif
</article>
