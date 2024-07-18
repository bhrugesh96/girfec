import Modernizr from 'modernizr';

const introBlock = () => {
  const $carousels = $('.layout-item.intro_block');

  $carousels.each((index, container) => {
    const $carousel = $('.ib-pages', container);
    const carouselSettings = {
      arrows: false,
      mobileFirst: true,
      dots: true,
      autoplay: false,
      swipe: true,
      infinite: false,
      slidesToScroll: 1,
      slidesToShow: 1,
      responsive: [
        {
          breakpoint: 575,
          settings: {
            slidesToShow: 2,
          },
        },
        {
          breakpoint: 768,
          settings: 'unslick',
        },
      ],
    };

    if ($carousel.hasClass('slick-initialized')) {
      if (Modernizr.mq('(min-width: 768px)')) {
        $carousel.slick('unslick');
      }
    } else if (!$carousel.hasClass('slick-initialized')) {
      $carousel.slick(carouselSettings);
    }
  });
};

export default introBlock;
