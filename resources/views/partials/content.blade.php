<article @php(post_class())>
  <header class="entry-header">
    <h2 class="entry-title">
      <a href="{{ get_the_permalink() }}" title="{{ get_the_title() }}">
        {{ get_the_title() }}
      </a>
    </h2>
    @include('partials/entry-meta')
  </header>

  @if( ! empty( $excerpt = get_field( 'excerpt' ) ) )
    <div class="entry-summary">
      {!! $excerpt !!}
    </div>
  @endif

  <footer class="entry-footer">
    @php($btn_title = sprintf(__( 'Read %s', 'girfec' ), wpc_get_the_post_type_label('singular_name')) )
      <a class="entry-button btn btn-success" href="{{ get_the_permalink() }}" title="{{ $btn_title }}">
        {{ $btn_title }}
      </a>
  </footer>
</article>
