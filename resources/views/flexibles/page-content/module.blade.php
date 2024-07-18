@php
  $fields = [
    'layout_id' => get_sub_field( 'layout_id' ) ? get_sub_field( 'layout_id' ) : uniqid( get_row_layout() . '-' ),
    'steps_title' => get_sub_field( 'steps_title' ),
    'steps' => get_sub_field( 'steps' ),
    'next_button' => get_sub_field( 'next_button' ),
  ];

  $step_count = count( $fields['steps'] );
  $uniqid = uniqid( 'tab-' );
@endphp

@if( ! empty( $fields['steps'] ) )
  <section id="{{ $fields['layout_id'] }}" class="content-layout-item {{ get_row_layout() }}">
    @if( ! empty( $steps_title = get_sub_field( 'steps_title' ) ) )
      <p class="nav-tabs-title">{{ $steps_title }}</p>
    @endif

    <ul class="nav nav-tabs" role="tablist">
      @php( $i = 0 )
      @while ( have_rows( 'steps'  ) ) @php( the_row() )
        @if( ! empty( $step_title = get_sub_field( 'step_title' ) ) )
          <li class="nav-item">
            <a class="nav-link {{ ( $i === 0 ) ? 'active' : '' }}" href="#{{ $uniqid }}-{{ $i }}"
               role="tab" data-toggle="tab" aria-controls="{{ $uniqid }}-{{ $i }}">
              {{ sprintf( __( 'Step %s', 'girfec' ), $step_title ) }}
            </a>
          </li>
          @php( $i++ )
        @endif
      @endwhile
    </ul>

    <div class="tab-content">
      @php( $i = 0 )
      @while ( have_rows( 'steps'  ) ) @php( the_row() )
        @if( ! empty( $step_title = get_sub_field( 'step_title' ) ) )
          <div role="tabpanel" class="tab-pane {{ ( $i === 0 ) ? 'show active' : '' }}"
               id="{{ $uniqid }}-{{ $i }}">
            @if( have_rows( 'step_content_layouts' ) )
              @while( have_rows( 'step_content_layouts' ) ) @php( the_row() )
                @include( 'flexibles.page-content.' . get_row_layout() )
              @endwhile
            @endif

            <nav class="tab-nav">
              @if( $i !== 0 )
                <a href="#{{ $uniqid }}-{{ $i - 1 }}" class="btn btn-sm btn-default btn-step" title="{{ __( 'Next Step', 'girfec' ) }}">
                  {{ __( 'Back a Step', 'girfec' ) }}
                </a>
              @endif

              @if( ( $i + 1 ) !== $step_count )
                <a href="#{{ $uniqid }}-{{ $i + 1 }}" class="btn btn-sm btn-primary btn-step next-step" title="{{ __( 'Next Step', 'girfec' ) }}">
                  {{ __( 'Next Step', 'girfec' ) }}
                </a>
              @endif

              @if( ( $i + 1 ) === $step_count )
                {!! \App\the_wpc_button([
                  'data' => $fields['next_button'],
                  'classes' => ['btn', 'btn-primary', 'btn-sm', 'next-page']
                ]) !!}
              @endif
            </nav>
          </div>
          @php( $i++ )
        @endif
      @endwhile
    </div>
  </section>
@endif
