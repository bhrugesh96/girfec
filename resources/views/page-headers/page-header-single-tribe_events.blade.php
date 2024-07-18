<div class="event-header-bar share-bar">
  <div class="container">
    <div class="d-flex align-items-center">
      <a class="btn btn-primary" href="{{ tribe_get_events_link() }}" title="{{ __( 'Back To Events', 'girfec' ) }}">
        <i class="girfec-icon-arrow-left hidden-sm-up" aria-hidden="true"></i>
        <span class="hidden-xs-down">{{ __( 'Back To Events', 'girfec' ) }}</span>
      </a>

      {!! do_shortcode('[share]') !!}
    </div>
  </div>
</div>
