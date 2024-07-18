const manageStickyNav = () => {
  const $body = $('body');
  const scrollTop = $(window).scrollTop();

  if (scrollTop > 0) {
    $body.addClass('sticky-nav-shadow');
  } else {
    $body.removeClass('sticky-nav-shadow');
  }
};

export default manageStickyNav;
