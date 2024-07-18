import bouncefix from 'bouncefix.js/dist/bouncefix';

const loginCollapse = () => {
  const $body = $('body');
  const $collapse = $('#login-collapse');

  bouncefix.add('login-collapse');
  bouncefix.add('login-collapse-backdrop');

  $collapse.on('show.bs.collapse', function () {
    $body.addClass('login-active');
  });

  $collapse.on('hide.bs.collapse', function () {
    $body.removeClass('login-active');
  });

  $('.login-collapse-backdrop').on('click touchend', () => {
    $collapse.collapse('hide');
  });
};

export default loginCollapse;
