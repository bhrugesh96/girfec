import Modernizr from 'modernizr';

const scrollTo = () => {
  $('a').on('click', (e) => {

    if (/^#/.test($(e.currentTarget).attr('href')) && $(e.currentTarget).hasClass('scroll-to')) {
      let offset;
      const target = $(e.currentTarget).attr('href');

      if ($(target).length) {
        e.preventDefault();

        if (target === 'body') {
          offset = 0;
        } else {
          offset = $(target).offset().top;

          if (Modernizr.mq('(min-width: 768px)')) {
            offset = offset - 108;
          } else {
            offset = offset - 93;
          }
        }

        $('html, body').stop().animate({
          scrollTop: offset + 2,
        }, 1250, 'easeInOutExpo');
      }
    }
  });
};

export default scrollTo;
