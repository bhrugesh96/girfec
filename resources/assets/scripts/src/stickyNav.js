import 'jquery-sticky';

const stickyNav = () => {
  const $sticky = $('.banner .bottom');
  $sticky.sticky({
    topSpacing: 1,
  });

  $sticky.on('sticky-start', () => {
    $('body').addClass('sticky-active');
  });

  $sticky.on('sticky-end', () => {
    $('body').removeClass('sticky-active');
  });
};

export default stickyNav;
