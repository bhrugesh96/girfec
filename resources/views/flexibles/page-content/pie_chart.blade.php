@php
  $fields = [
    'layout_id' => get_sub_field( 'layout_id' ) ? get_sub_field( 'layout_id' ) : uniqid( get_row_layout() . '-' ),
    'items' => get_sub_field( 'items' ),
  ];

  $index = 0;
  $uniqid = uniqid( 'chart-' );
@endphp

@if( ! empty( $fields['items'] ) )
  <section id="{{ $fields['layout_id'] }}" class="content-layout-item {{ get_row_layout() }}">
    <div class="row">
      <div class="col-lg-8 col-xl-7">
        <div class="chart-wrap">
          <div class="chart-container">
            <div class="chart-div" id="{{ $uniqid }}"></div>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-xl-5 align-self-center">
        <div class="chart-items">
          @foreach( $fields['items'] as $item )
            @if( ! empty( $item['title'] ) && ! empty( $item['color'] ) )
              <div class="chart-item chart-item-{{ $index }}" data-title="{{ $item['title'] }}" data-color="{{ $item['color'] }}">
                <h4 class="chart-item-title">{{ $item['title'] }}</h4>
                <div class="chart-item-text rlpm">
                  {!! $item['text'] !!}
                </div>
              </div>
              @php( $index ++ )
            @endif
          @endforeach
        </div>
      </div>
    </div>
  </section>
@endif
