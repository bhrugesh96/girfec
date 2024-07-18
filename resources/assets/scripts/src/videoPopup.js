import 'magnific-popup/dist/jquery.magnific-popup';

const videoPopup = () => {
  const $video = $('.content-layout-item.video .video-toggle');

  $video.magnificPopup({
    type: 'iframe',
    midClick: true,
    mainClass: 'mfp-fade',
    removalDelay: 300,
  });
};

export default videoPopup;
