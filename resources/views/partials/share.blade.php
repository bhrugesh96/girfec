@php
  if ( empty( $url ) ) $url = get_the_permalink();

  $settings = \Roots\ShareButtons\Admin\get_settings();
  $thumb_id = get_post_thumbnail_id( get_the_ID() );

  if ( empty( $title ) ) $title = get_the_title();
@endphp

@if( ! empty( $settings['button_order'] ) )
<div class="entry-share">
  <ul class="entry-share-btns list-unstyled text-center">
    <?php foreach( $settings['button_order'] as $setting ) : ?>
      @if( 'twitter' === $setting && in_array( 'twitter', $settings['buttons'] ) )
        <li class="entry-share-btn entry-share-btn-twitter">
          <a href="https://twitter.com/intent/tweet?text={{ urlencode( html_entity_decode( $title, ENT_COMPAT, 'UTF-8' ) ) }}&amp;url={{ urlencode( $url ) }}" title="{{ __( 'Share on Twitter', 'girfec' ) }}">
            <i class="girfec-icon-twitter"></i>
          </a>
        </li>
      @endif

      @if( 'facebook' === $setting && in_array( 'facebook', $settings['buttons'] ) )
        <li class="entry-share-btn entry-share-btn-facebook">
          <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode( $url ) }}" title="{{ __( 'Share on Facebook', 'girfec' ) }}">
            <i class="girfec-icon-facebook"></i>
          </a>
        </li>
      @endif

      @if( 'google_plus' === $setting && in_array( 'google_plus', $settings['buttons'] ) )
        <li class="entry-share-btn entry-share-btn-google-plus">
          <a href="https://plus.google.com/share?url={{ urlencode( $url ) }}" title="{{ __( 'Share on Google+', 'girfec' ) }}">
            <i class="girfec-icon-google"></i>
          </a>
        </li>
      @endif

      @if( 'linkedin' === $setting && in_array( 'linkedin', $settings['buttons'] ) )
        <li class="entry-share-btn entry-share-btn-linkedin">
          <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{ urlencode( $url ) }}&amp;summary=" title="{{ __( 'Share on LinkedIn', 'girfec' ) }}">
            <i class="girfec-icon-linkedin"></i>
          </a>
        </li>
      @endif

      @if( 'pinterest' === $setting && in_array( 'pinterest', $settings['buttons'] ) && ( ! empty( $thumb_id ) || ! empty( get_field('thumbnail') ) ) )
        @php
          // Don't show 'Pin It' button if post doesn't have a thumbnail
          if ( empty( $thumb_id ) ) $thumb_id = get_field( 'thumbnail' )['id'];

          // Get thumbnail URL
          $thumb = wp_get_attachment_image_src( $thumb_id, 'thumbnail_size' );
          $thumb_src = ( isset( $thumb[0] ) ) ? $thumb[0] : null;
          $thumb_alt = get_post_meta( $thumb_id , '_wp_attachment_image_alt', true );

          // Make sure thumbnail URL isn't relative
          $thumb_src = phpUri::parse( network_site_url() )->join( $thumb_src );

          // Fallback to post title as a description if the post thumbnail doesn't have one
          $description = ( ! empty( $thumb_alt ) ) ? $thumb_alt : $title;
        @endphp

        <li class="entry-share-btn entry-share-btn-pinterest">
          <a href="https://pinterest.com/pin/create/button/?url={{ rawurlencode( $url ) }}&amp;media={{ urlencode( $thumb_src ) }}&amp;description={{ urlencode( $description ) }}" title="{{ __( 'Share on Pinterest', 'girfec' ) }}">
            <i class="girfec-icon-pinterest"></i>
          </a>
        </li>
      @endif
    <?php endforeach; ?>

    <li class="entry-share-btn-email">
      <a class="btn btn-secondary" href="mailto:{{ '?subject=' . rawurlencode( get_bloginfo( 'name' )  . ' - ' . get_the_title() ) . '&body=' . urlencode( get_the_permalink() ) }}" title="{{ __( 'Save For Later', 'girfec' ) }}">
        <i class="girfec-icon-envelop"></i>
        <span class="hidden-sm-down">{{ __( 'Save For Later', 'girfec' ) }}</span>
      </a>
    </li>
  </ul>
</div>
@endif
