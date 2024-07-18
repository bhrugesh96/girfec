import 'magnific-popup/dist/jquery.magnific-popup';

const imageGrid = () => {
  const $images = $('.content-layout-item.image_grid .image-grid-image');

  $images.magnificPopup({
    type: 'image',
    midClick: true,
    mainClass: 'mfp-fade',
    removalDelay: 300,
    gallery: {
      enabled: true,
    },
    image: {
      titleSrc: item => item.el.parent().find('figcaption').html(),
    },
  });
};

export default imageGrid;
