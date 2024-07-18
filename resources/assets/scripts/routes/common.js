// Utils
import initScrollTo from '../util/scrollTo';
import manageImgCover from '../util/imgCover';

// Components
import initAccessibility from '../src/accessibility';
import initImageGrid from '../src/imageGrid';
import initLoginCollapse from '../src/loginCollapse';
import initModule from '../src/module';
import initPostTypeCarousel from '../src/postTypeCarousel';
import initSideNav from '../src/sideNav';
import initSlider from '../src/slider';
import initSplitCards from '../src/splitCards';
import initStickyNav from '../src/stickyNav';
import initPieChart from '../src/pieChart';
import initVideoPopup from '../src/videoPopup';
import manageIntroBlock from '../src/introBlock';
import manageStickyNav from '../src/manageStickyNav';

export default {
  init() {
    initAccessibility();
    initImageGrid();
    initScrollTo();
    initLoginCollapse();
    initModule();
    initPostTypeCarousel();
    initSideNav();
    initSlider();
    initSplitCards();
    initStickyNav();
    initPieChart();
    initVideoPopup();
    manageImgCover();
    manageIntroBlock();

    $(window).on('resize', () => {
      manageImgCover();
      manageIntroBlock();
    });

    $(window).on('scroll touchstart touchend swipe', () => {
      manageStickyNav();

      setTimeout(function() {
        manageStickyNav();
      }, 0);
    });
  },
};
