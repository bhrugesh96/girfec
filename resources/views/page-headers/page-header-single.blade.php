<div class="single-header-bar share-bar">
  <div class="container">
    <div class="d-flex align-items-center">
      <a class="btn btn-primary" href="{{ get_permalink( wpc_get_default_page_id( 'post' ) ) }}" title="{{ __( 'Back To News', 'girfec' ) }}">
        <i class="girfec-icon-arrow-left hidden-sm-up" aria-hidden="true"></i>
        <span class="hidden-xs-down">{{ __( 'Back To News', 'girfec' ) }}</span>
      </a>

      {!! do_shortcode('[share]') !!}
    </div>
  </div>
</div>
