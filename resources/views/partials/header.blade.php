@php
  $field = array(
	'site_description' => get_field( 'hf_site_description', 'option' ),
	'btn_sign_up'      => get_field( 'hf_sign_up_button', 'option' ),
	'login_title'      => get_field( 'hf_login_title', 'option' ),
	'login_text'       => get_field( 'hf_login_text', 'option' ),
	'sign_up_title'    => get_field( 'hf_sign_up_title', 'option' ),
	'sign_up_text'     => get_field( 'hf_sign_up_text', 'option' ),
  );

  $login_url = ( defined('WP_ENV') && ( WP_ENV !== 'production' ) ) ? 'wp/wp-login.php' : 'wp-login.php';
@endphp

<header class="header-wrap">
  @if( ! is_user_logged_in() )
    <div id="login-collapse" class="login-collapse collapse">
      <div class="container login-collapse-inner">
        <a href="#login-collapse" class="login-collapse-close hidden-sm-down"
           title="{{ __( 'Close Login Panel', 'girfec' ) }}" data-toggle="collapse" aria-expanded="false"
           aria-controls="login-collapse">
          <span class="sr-only">{{ __( 'Close Login Panel', 'girfec' ) }}</span>
          <i class="girfec-icon-cross" aria-hidden="true"></i>
        </a>

        <div class="row">
          <div class="col-md-6 login">
            <div class="login-header">
              <h3 class="login-title">{{ $field['login_title'] }}</h3>
              <div class="login-text">
                {!! $field['login_text'] !!}
              </div>
            </div>
            <div class="login-form">
              <form class="form" name="loginform" action="{{ home_url( $login_url ) }}" method="post">
                <div class="login-form-body">
                  <div class="form-group">
                    <input type="text" name="log" id="user_login" class="form-control" value="" autocomplete="off"
                           placeholder="{{ __( 'Username', 'girfec' ) }}"/>
                  </div>
                  <div class="form-group">
                    <input type="password" name="pwd" id="user_pass" class="form-control" value="" autocomplete="off"
                           placeholder="{{ __( 'Password', 'girfec' ) }}"/>
                    <a href="{{ wp_lostpassword_url( get_permalink() ) }}"
                       title="{{ __( 'Forgot your password?', 'girfec' ) }}"
                       class="forgot-password">
                      {{ __( 'Forgot your password?', 'girfec' ) }}
                    </a>
                  </div>
                </div>

                @php(do_action( 'login_form' ))

                  <div class="login-form-footer">
                    <button class="btn btn-info" type="submit" name="wp-submit" id="wp-submit">
                      {{ __( 'Sign In', 'girfec' ) }}
                    </button>
                    <input type="hidden" name="redirect_to"
                           value="{{ ! empty( $_REQUEST['redirect'] ) ? $_REQUEST['redirect'] : \App\get_intranet_page_link() }}">
                  </div>
              </form>
            </div>
          </div>

          <div class="col-md-5 offset-md-1 sign-up">
            <h3 class="sign-up-title">{{ $field['sign_up_title'] }}</h3>

            <div class="sign-up-text">
              {!! $field['sign_up_text'] !!}
            </div>

            @php(\App\the_wpc_button(array('data' => $field['btn_sign_up'], 'classes' => array('btn', 'btn-info'))))
          </div>
        </div>
      </div>
    </div>
  @endif

  <div class="banner">
    <div class="mobile-banner hidden-md-up d-flex">
      @if( ! is_user_logged_in() )
        <button class="btn btn-block btn-secondary member-login-toggle-mobile" data-toggle="collapse"
                data-target="#login-collapse" aria-expanded="false" aria-controls="login-collapse">
          {{ __('User Login', 'girfec') }}
        </button>
      @else
        <a class="btn btn-block btn-secondary member-login-toggle-mobile" href="{{ \App\get_intranet_page_link() }}"
           title="{{ __( 'My Account', 'girfec' ) }}">
          {{ __( 'My Account', 'girfec' ) }}
        </a>
      @endif

      @if ( ! empty( $accessibility_id = wpc_get_default_page_id( 'accessibility' ) ) )
        <a href="{{ get_the_permalink( $accessibility_id ) }}" class="btn btn-sm btn-secondary btn-accessibility" title="{{ __( 'Font Size', 'girfec' ) }}">
          <span class="sr-only">{{ __( 'Font Size', 'girfec' ) }}</span>
          <span data-size="font-default" class="default">A</span>
          <span data-size="font-medium" class="medium">A</span>
          <span data-size="font-large" class="large">A</span>
        </a>
      @endif

      <button class="btn btn-block btn-secondary" data-toggle="side-nav">
        <span class="sr-only">{{ __( 'Navigation Toggle', 'girfec' ) }}</span>
        {{ __('Menu', 'girfec') }}
        <i aria-hidden="true"></i>
      </button>
    </div>

    <div class="top hidden-sm-down">
      <div class="container">
        <div class="top-inner">
          <div class="left">
            @if ( ! empty( $screen_reader_id = wpc_get_default_page_id( 'screen_reader' ) ) )
              <a href="{{ get_the_permalink( $screen_reader_id ) }}" class="btn btn-sm btn-screen-reader"
                 title="{{ get_the_title( $screen_reader_id ) }}">
                <i class="girfec-icon-screen-reader" aria-hidden="true"></i>
                <span class="hidden-md-down">{{ get_the_title( $screen_reader_id ) }}</span>
              </a>
            @endif

            <a href="#" class="btn btn-sm btn-font-size" title="{{ __( 'Font Size', 'girfec' ) }}">
              <span class="sr-only">{{ __( 'Font Size', 'girfec' ) }}</span>
              <span data-size="font-default" class="default">A</span>
              <span data-size="font-medium" class="medium">A</span>
              <span data-size="font-large" class="large">A</span>
            </a>

            <a href="#" class="btn btn-sm btn-contrast" title="{{ __( 'Contrast', 'girfec' ) }}">
              <span class="sr-only">{{ __( 'Contrast', 'girfec' ) }}</span>
              <i class="girfec-icon-contrast" aria-hidden="true"></i>
            </a>

            @if ( ! empty( $accessibility_id = wpc_get_default_page_id( 'accessibility' ) ) )
              <a href="{{ get_the_permalink( $accessibility_id ) }}" class="btn btn-sm btn-accessibility"
                   title="{{ __( 'More', 'girfec') }} ...">
                <span class="hidden-md-down">{{ __( 'More', 'girfec' ) }}</span> ...
              </a>
            @endif
          </div>

          <div class="right hidden-sm-down">
            <nav class="nav-top">
              @if (has_nav_menu('top_navigation'))
                {!! wp_nav_menu(['theme_location' => 'top_navigation', 'menu_class' => 'nav']) !!}
              @endif

              @if( ! is_user_logged_in() )
                <button class="btn btn-sm btn-secondary member-login-toggle" data-toggle="collapse"
                        data-target="#login-collapse" aria-expanded="false" aria-controls="login-collapse">
                  {{ __('User Login', 'girfec') }}
                </button>
              @else
                <a class="btn btn-sm btn-secondary member-login-toggle" href="{{ \App\get_intranet_page_link() }}"
                   title="{{ __( 'My Account', 'girfec' ) }}">
                  {{ __( 'My Account', 'girfec' ) }}
                </a>
              @endif
            </nav>
          </div>
        </div>
      </div>
    </div>

    <div class="middle">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-6 left">
            <a class="brand align-items-center" href="{{ home_url('/') }}"
               title="{{ get_bloginfo('name', 'display') }}">
              {!! wpc_get_the_logo_html() !!}
            </a>
          </div>

          <div class="col-md-6 right hidden-sm-down">
            @if(!empty($field['site_description']))
              <h2 class="site-description">{!! $field['site_description'] !!}</h2>
            @endif
          </div>
        </div>
      </div>
    </div>

    <div class="bottom hidden-sm-down">
      <div class="container">
        <nav class="nav-primary">
          @if (has_nav_menu('primary_navigation'))
            {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav justify-content-between']) !!}
          @endif
        </nav>
      </div>
    </div>

    <div class="bottom-fantom hidden-sm-down">
      <div class="container">
        <nav class="nav-primary">
          @if (has_nav_menu('primary_navigation'))
            {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav justify-content-between']) !!}
          @endif
        </nav>
      </div>
    </div>
  </div>

  <div class="side-nav" id="side-nav">
    <nav class="nav-side">
      @php
        if ( has_nav_menu( 'mobile_navigation' ) ) :
          wp_nav_menu( [
          'theme_location' => 'mobile_navigation',
          'menu_class'     => 'nav flex-column',
          ] );
        endif;
      @endphp
    </nav>
  </div>

  <button class="btn side-nav-toggle" data-toggle="side-nav">
    <span class="sr-only">{{ __( 'Navigation Toggle', 'girfec' ) }}</span>
    {{ __('Menu', 'girfec') }}
    <i aria-hidden="true"></i>
  </button>

  <button class="btn login-collapse-toggle hidden-md-up" data-toggle="collapse" data-target="#login-collapse"
          aria-expanded="false" aria-controls="login-collapse">
    <span class="sr-only">{{ __( 'Close Login Panel', 'girfec' ) }}</span>
    <i aria-hidden="true"></i>
  </button>

  <div class="side-nav-backdrop"></div>
  <div class="login-collapse-backdrop"></div>
</header>
