import 'jquery.cookie';

const changeTheme = (conf) => {

  const defaults = {
    theme: 'main',
    cookieChange: true,
  };

  const config = {
    ...defaults,
    ...conf,
  };

  const $body = $('body');

  const $mainCSS = $('[rel="stylesheet"][title="main-css"]');
  const actualTheme = $body.attr('preview') ? $body.attr('preview') : ($.cookie('theme') ? $.cookie('theme') : 'main');
  let href = $mainCSS.attr('href');

  href = href.replace(new RegExp(actualTheme, 'g'), config.theme);
  $mainCSS.attr('href', href);

  if (config.cookieChange) {
    $body.removeAttr('preview');
    if (config.theme === 'main') {
      $.removeCookie('theme', {path: '/'});
    } else {
      $.cookie('theme', config.theme, {path: '/'});
    }
  } else {
    $body.attr('preview', config.theme);
  }
};

const accessibility = () => {
  const $body = $('body');

  // Banner Font size
  $('.banner .btn-font-size').click((e) => {
    e.preventDefault();

    if ($body.hasClass('font-default')) {
      $body.removeClass('font-default').addClass('font-medium');
      $.cookie('font', 'font-medium', {path: '/'});
    } else if ($body.hasClass('font-medium')) {
      $body.removeClass('font-medium').addClass('font-large');
      $.cookie('font', 'font-large', {path: '/'});
    } else {
      $body.removeClass('font-large').addClass('font-default');
      $.removeCookie('font', {path: '/'});
    }
  });

  // Banner Contrast
  $('.banner .btn-contrast').click(function (e) {
    e.preventDefault();

    let nextTheme = '';

    if ($.cookie('theme') === 'main-cream') {
      nextTheme = 'main';
    } else if ($.cookie('theme') === 'main-contrast') {
      nextTheme = 'main-contrast-blue';
    } else if ($.cookie('theme') === 'main-contrast-blue') {
      nextTheme = 'main-cream';
    } else {
      nextTheme = 'main-contrast';
    }

    changeTheme({theme: nextTheme});
  });

  // Accessibility page
  $('.access-buttons .btn').click(function (e) {
    e.preventDefault();

    const $button = $(e.currentTarget);
    const $fontForm = $('form.fonts');
    const $coloursForm = $('form.colours');
    const font = $('select[name=font] option:selected', $fontForm).val();
    const theme = $('input[name=colour]:checked', $coloursForm).val();

    $body.removeClass(function (index, css) {
      return (css.match(/(^|\s)font-\S+/g) || []).join(' ');
    });

    if ($button.hasClass('btn-use')) { // use
      $body.addClass(font);

      if (font !== 'font-default') {
        $.cookie('font', font, {path: '/'});
      } else {
        $.removeCookie('font', {path: '/'});
      }

      changeTheme({theme: theme});
    } else if ($button.hasClass('btn-preview')) { // preview
      $body.addClass(font);
      changeTheme({theme: theme, cookieChange: false});
    } else { // reset
      $('input[name=colour][value=main]', $coloursForm).prop('checked', true);
      $('select[name=font] option[value=font-default]', $fontForm).prop('selected', true);
      changeTheme();
    }
  });
};

export default accessibility;
