import 'slick-carousel';

const postTypeCarousel = () => {
  const $carousels = $('.layout-item.post_type_carousel');

  $carousels.each((index, container) => {
    const $carousel = $('.ptc-posts', container);

    $carousel.slick({
      arrows: false,
      dots: true,
      autoplay: false,
      swipe: true,
      infinite: false,
      slidesToScroll: 1,
      slidesToShow: 3,
      responsive: [
        {
          breakpoint: 991,
          settings: {
            slidesToShow: 2,
          },
        },
        {
          breakpoint: 479,
          settings: {
            slidesToShow: 1,
          },
        },
      ],
    });
  });
};

export default postTypeCarousel;
