@php

  if ( ! is_home() && ! is_singular( 'post' ) && ! is_category( ) ) {
    return;
  }

  $uniqid = uniqid( 'sub-nav-' );

  $categories = get_categories();

  $current_term_id = 0;
  if ( ! empty(get_queried_object()->term_id)) {
    $current_term_id = get_queried_object()->term_id;
  }

@endphp

<section class="sub-nav sub-nav-main">

  <h4 class="sub-nav-title">{{ __('Categories', 'girfec') }}</h4>

  <div class="card card-default card-responsive">
    <h4 class="card-header" role="tab">
      <a class="collapsed" href="#{{ $uniqid }}" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="{{ $uniqid }}">
        {{ __('Categories', 'girfec') }}

        <button type="button" class="btn card-toggle">
          <span class="sr-only">{{ __( 'Open Navigation', 'girfec' ) }}</span>
          <i></i>
        </button>
      </a>
    </h4>
    <div id="{{ $uniqid }}" class="dropdown-content card-collapse collapse">
      <div class="card-block">
        <div class="sub-nav-inner">
          <ul class="nav flex-column">
            <li class="nav-item {{ is_home() ? 'active' : '' }}">
              <a class="nav-link" href="{{ get_the_permalink(get_option( 'page_for_posts' )) }}" title="{{ __('All', 'girfec') }}">
                {{ __('All', 'girfec') }}
              </a>
            </li>

            @foreach($categories as $category)
              <li class="nav-item {{ $category->term_id === $current_term_id ? 'active' : '' }}">
                <a class="nav-link" href="{{ get_term_link($category) }}" title="{{ $category->name }}">
                  {{ $category->name }}
                </a>
              </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>
