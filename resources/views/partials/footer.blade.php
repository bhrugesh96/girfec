<footer class="content-info">
  <div class="top">
    <div class="container">
      <nav class="nav-footer hidden-sm-down">
        @if (has_nav_menu( 'footer_navigation' ))
          {!! wp_nav_menu([ 'theme_location' => 'footer_navigation', 'menu_class' => 'nav' ]) !!}
        @endif
      </nav>

      @if( ! empty( $members_page_id = wpc_get_default_page_id( 'intranet' ) ) )
        <a class="members-account btn btn-primary" href="{{ get_the_permalink( $members_page_id ) }}" role="button">
          @if( is_user_logged_in() )
            {{ __( 'My Account', 'girfec' ) }}
          @else
            {{ __( 'User Login', 'girfec' ) }}
          @endif
        </a>
      @endif
    </div>
  </div>
  <div class="bottom">
    <div class="container">
      <p class="copyright">
        {{ sprintf(__( '%s Copyright &copy;%s', 'girfec' ), get_bloginfo( 'name' ), date( 'Y' )) }}
      </p>

      <p class="websiteby">{!! __( 'Website by ', 'girfec' ) !!}
        <a href="http://bbdcreative.com" title="BBD Creative"
           target="_blank" rel="nofollow">BBD</a></p>
    </div>
  </div>
</footer>

