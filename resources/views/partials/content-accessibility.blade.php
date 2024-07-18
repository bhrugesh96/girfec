<div class="accessibility">
  <h2>{{ __('Change Fonts', 'girfec') }}</h2>

  <form action="" class="fonts">
    <label for="font">{{ __('Text size', 'girfec') }}</label>

    <div class="form-group">
      <div class="girfec-select font-select-container">
        <select name="font" class="form-control font-select">
          <option value="font-default" {{ (!isset($_COOKIE['font'])) ? 'selected' : '' }}>
            <?php _e('Default font size', 'girfec') ?>
          </option>
          <option value="font-medium" {{ ((isset($_COOKIE['font']) && ($_COOKIE['font']) === 'font-medium')) ? 'selected' : '' }}>
            <?php _e('Medium font size', 'girfec') ?>
          </option>
          <option value="font-large" {{ ((isset($_COOKIE['font']) && ($_COOKIE['font']) === 'font-large')) ? 'selected' : '' }}>
            <?php _e('Large font size', 'girfec') ?>
          </option>
        </select>
      </div>
    </div>
  </form>

  <hr>

  <h2>{{ __('Change Colours', 'girfec') }}</h2>

  <form action="" class="colours row">
    <div class="col-12">
      <div class="radio">
        <label>
          <input type="radio" name="colour" value="main" {{ (!isset($_COOKIE['theme'])) ? 'checked' : '' }}>
          <span>{{ __('Default', 'girfec') }}</span>
        </label>
      </div>

      <div class="radio contrast">
        <label>
          <input type="radio" name="colour" value="main-contrast" {{ ((isset($_COOKIE['theme']) && ($_COOKIE['theme']) === 'main-contrast')) ? 'checked' : '' }}>
          <span>{{ __('Contrast', 'girfec') }}</span>
        </label>
      </div>
    </div>
    <div class="col-12">
      <div class="radio contrast-blue mb-sm-0">
        <label>
          <input type="radio" name="colour" value="main-contrast-blue" {{ ((isset($_COOKIE['theme']) && ($_COOKIE['theme']) === 'main-contrast-blue')) ? 'checked' : '' }}>
          <span>{{ __('Contrast Blue', 'girfec') }}</span>
        </label>
      </div>

      <div class="radio cream mb-0">
        <label>
          <input type="radio" name="colour" value="main-cream" {{ ((isset($_COOKIE['theme']) && ($_COOKIE['theme']) === 'main-cream')) ? 'checked' : '' }}>
          <span>{{ __('Cream', 'girfec') }}</span>
        </label>
      </div>
    </div>
  </form>

  <hr>

  <div class="access-buttons">
    <button type="button" class="btn btn-secondary btn-reset" role="button">
      {{ __('Reset site settings', 'girfec') }}
    </button>

    <button type="button" class="btn btn-default btn-preview" role="button">
      {{ __('Preview', 'girfec') }}
    </button>

    <button type="button" class="btn btn-primary btn-use" role="button">
      {{ __('Use these settings', 'girfec') }}
    </button>
  </div>
</div>
