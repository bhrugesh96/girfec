@php( $login_url = ( defined('WP_ENV') && ( WP_ENV !== 'production' ) ) ? 'wp/wp-login.php' : 'wp-login.php' )

<div class="girfec-login-form">
  <h3 class="text-center">{{ __( 'User Login', 'girfec' ) }}</h3>
  <form class="form" name="loginform" action="{{ home_url( $login_url ) }}" method="post">

    <div class="form-group">
      <input type="text" name="log" id="user_login" class="form-control" value="" autocomplete="off"
             placeholder="{{ __( 'Username', 'girfec' ) }}"/>
    </div>
    <div class="form-group">
      <input type="password" name="pwd" id="user_pass" class="form-control" value="" autocomplete="off"
             placeholder="{{ __( 'Password', 'girfec' ) }}"/>
    </div>

    @php( do_action('login_form') )

    <div class="form-group">
      <button class="btn btn-primary" type="submit" name="wp-submit" id="wp-submit">
        {{ __( 'Sign In', 'girfec' ) }}
      </button>
      <input type="hidden" name="redirect_to"
             value="{{ ! empty( $_REQUEST['redirect'] ) ? $_REQUEST['redirect'] : \App\get_intranet_page_link() }}">
    </div>
  </form>
</div>
