@php
  $fields = [
    'layout_id' => uniqid( 'feedback_form' . '-' ),
    'form' => get_field( 'feedback_form', 'option' ),
    'active' => get_field( 'feedback_form' ),
  ];
@endphp

@if( ! empty( $fields['form'] ) && ( $fields['active'] === 'enabled' ) )
  <section id="{{ $fields['layout_id'] }}" class="content-layout-item feedback_form">
    @php
      gravity_form( $fields['form']['id'], false, false, false, '', true, 1 );
    @endphp
  </section>
@endif
