const module = () => {
  const $modules = $('.content-layout-item.module');

  $modules.each((index, container) => {
    const $tab = $('.nav-tabs a[data-toggle="tab"]', container);
    const $stepButton = $('.btn.btn-step', container);

    $tab.on('show.bs.tab', (e) => {
      const $activeTab = $(e.target);
      const $activeTabParent = $activeTab.parent();

      $tab.removeClass('activated');
      $activeTabParent.prevAll().find('a[data-toggle="tab"]').addClass('activated');
    });

    $stepButton.click((e) => {
      e.preventDefault();
      const $currentButton = $(e.currentTarget);

      $('.nav-tabs a[href="' + $currentButton.attr('href') + '"]', container).click();
    });
  });
};

export default module;
