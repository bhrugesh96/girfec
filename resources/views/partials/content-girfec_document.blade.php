<article @php(post_class())>
  <header class="entry-header">
    <h2 class="entry-title">
      {{ get_the_title() }}
    </h2>
  </header>

  @if( ! empty( $excerpt = get_field( 'excerpt' ) ) )
    <div class="entry-summary">
      {!! $excerpt !!}
    </div>
  @endif

  @if( ! empty( $document = get_field( 'document' ) ) )
    <footer class="entry-footer">
      <a class="entry-button btn btn-success" href="{{ $document['url'] }}" title="{{ __('Download', 'girfec') }}"
         download>
        {{ __('Download', 'girfec') }}
      </a>
    </footer>
  @endif
</article>
