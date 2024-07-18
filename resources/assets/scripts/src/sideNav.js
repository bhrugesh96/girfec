import bouncefix from 'bouncefix.js/dist/bouncefix';

const sideNav = () => {
  const $body = $('body');

  bouncefix.add('side-nav');
  bouncefix.add('side-nav-backdrop');

  $('[data-toggle="side-nav"]').on('click touchend', (e) => {
    e.preventDefault();
    $body.toggleClass('side-nav-active');
  });

  $('.side-nav-backdrop').on('click touchend', () => {
    $body.removeClass('side-nav-active');
  });

  $('.banner .mobile-banner [data-toggle="side-nav"]').on('mouseenter', () => {
    $('.side-nav-toggle').addClass('hover');
  });

  $('.banner .mobile-banner [data-toggle="side-nav"]').on('mouseleave', () => {
    $('.side-nav-toggle').removeClass('hover');
  });
};

export default sideNav;
