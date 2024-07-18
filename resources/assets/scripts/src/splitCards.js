import 'slick-carousel';

const splitCards = () => {
  const $carousels = $('.layout-item.split_cards');

  $carousels.each((index, container) => {
    const $carousel = $('.sc-cards', container);

    $carousel.slick({
      arrows: false,
      dots: true,
      autoplay: false,
      swipe: true,
      infinite: false,
      slidesToScroll: 1,
      slidesToShow: 2,
      responsive: [
        {
          breakpoint: 767,
          settings: {
            slidesToShow: 1,
          },
        },
      ],
    });
  });
};

export default splitCards;
