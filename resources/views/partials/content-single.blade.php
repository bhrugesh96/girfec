<article @php(post_class('content-wrap'))>
  <header>
    @if( $thumbnail = get_field( 'thumbnail' ) )
      <figure class="entry-thumbnail img-cover">
        {!! \App\get_responsive_attachment( $thumbnail['id'], 'girfec-thumbnail-md' ) !!}
      </figure>
    @endif

    <h1 class="entry-title">{{ get_the_title() }}</h1>
    @include( 'partials.entry-meta-single' )
  </header>

  @if( have_rows( 'post_content_layouts' ) )
    <div class="entry-content">
      @while( have_rows( 'post_content_layouts' ) ) @php( the_row() )
        @include( 'flexibles.page-content.' . get_row_layout() )
        @endwhile
    </div>
  @endif
</article>
