@php
  $fields = [
    'layout_id' => get_sub_field( 'layout_id' ) ? get_sub_field( 'layout_id' ) : uniqid( get_row_layout() . '-' ),
    'background_color' => get_sub_field( 'background_color' ),
  ];

	$classes = [
	  'layout-item',
    get_row_layout(),
	  $fields['background_color'],
	];
@endphp

<section id="{{ $fields['layout_id'] }}" class="{{ implode( ' ', $classes ) }}"></section>
