import 'slick-carousel';

const slider = () => {
  const $sliders = $('.layout-item.slider');

  $sliders.each((index, container) => {
    const $carousel = $('.slider-body', container);

    $carousel.slick({
      arrows: $carousel.data('arrows') === 'enabled',
      dots: $carousel.data('dots') === 'enabled',
      autoplay: $carousel.data('autoplay') === 'enabled',
      autoplaySpeed: $carousel.data('interval'),
      prevArrow: '<button type="button" class="slick-prev"><i class="girfec-icon-arrow-left" aria-hidden="true"></i></button>',
      nextArrow: '<button type="button" class="slick-next"><i class="girfec-icon-arrow-right" aria-hidden="true"></i></button>',
      fade: true,
      cssEase: 'linear',
      swipe: $carousel.data('arrows') === 'enabled' || $carousel.data('dots') === 'enabled',
      infinite: true,
      pauseOnHover: true,
      pauseOnFocus: false,
      draggable: false,
      responsive: [
        {
          breakpoint: 767,
          settings: {
            arrows: false,
          },
        },
      ],
    });
  });
};

export default slider;
