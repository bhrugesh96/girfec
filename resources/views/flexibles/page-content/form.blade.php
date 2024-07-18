@php
  $fields = [
    'layout_id' => get_sub_field( 'layout_id' ) ? get_sub_field( 'layout_id' ) : uniqid( get_row_layout() . '-' ),
    'form' => get_sub_field( 'form' ),
  ];
@endphp

@if( ! empty( $fields['form'] ) )
  <section id="{{ $fields['layout_id'] }}" class="content-layout-item {{ get_row_layout() }}">
      <div class="form-wrap">
        @php
          gravity_form($fields['form']['id'], false, false, false, '', true, 1);
        @endphp
      </div>
  </section>
@endif
