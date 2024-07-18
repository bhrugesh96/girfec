import 'imagesloaded';
import Modernizr from 'modernizr';
import _ from 'lodash';

const imgCover = (conf) => {
  const defaults = {
    base: 'body',
    selector: '.img-cover',
  };

  const config = {
    ...defaults,
    ...conf,
  };

  $(config.selector, config.base).each((index, item) => {
    const $container = $(item);
    const $img = $('img', $container);
    const minWidth = parseInt($(item).data('min'), 10) || 0;

    $container.removeClass('img-cover-active');

    if (Modernizr.mq(`(min-width: ${minWidth}px)`)) {
      $(item).imagesLoaded(() => {

        $img.css({
          width: '101%',
          height: 'auto',
          'min-width': 0,
          'min-height': 0,
        });

        if ($img.outerHeight() < $container.outerHeight()) {
          $img.css({
            width: 'auto',
            height: '101%',
          });
        }

        $container.addClass('img-cover-active');
      });
    } else {
      $img.css({
        width: 'auto',
        height: 'auto',
        'min-width': 0,
        'min-height': 0,
      });
    }
  });
};

const imgCoverDebounced = _.debounce(imgCover, 150);

export default imgCoverDebounced;
