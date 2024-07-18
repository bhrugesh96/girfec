<?php namespace Girfec\Plugins\GravityForms;

/**
 * Custom merge Tags
 */
add_action( 'gform_admin_pre_render', function ( $form ) {
    $quiz_fields = \GFFormsModel::get_fields_by_type( $form, array( 'quiz' ) );

    if ( empty( $quiz_fields ) ) {
        return $form;
    }

    ?>
    <script type="text/javascript">
        gform.addFilter('gform_merge_tags', 'add_merge_tags');

        function add_merge_tags(mergeTags, elementId, hideAllFields, excludeFieldTypes, isPrepop, option) {
            mergeTags["other"].tags.push({
                tag: '{quiz_fields_number}',
                label: '<?= __( "Quiz Fields Number", "girfec" ); ?>'
            });
            mergeTags["other"].tags.push({
                tag: '{quiz_pass_number}',
                label: '<?= __( "Quiz Pass Number", "girfec" ); ?>'
            });
            mergeTags["other"].tags.push({
                tag: '{quiz_reset_form_button}',
                label: '<?= __( "Reset Form Button", "girfec" ); ?>'
            });

            return mergeTags;
        }
    </script>
    <?php

    return $form;
} );

/**
 * Render Merge Tags
 */
add_filter( 'gform_replace_merge_tags', function ( $text, $form, $entry, $url_encode, $esc_html, $nl2br, $format ) {

    if ( empty( $entry ) || empty( $form ) || ! class_exists( 'GFQuiz' ) ) {
        return $text;
    }

    $quiz_fields = \GFFormsModel::get_fields_by_type( $form, array( 'quiz' ) );
    if ( empty ( $quiz_fields ) ) {
        return $text;
    }

    // Fields Number
    $text = str_replace( '{quiz_fields_number}', count( $quiz_fields ), $text );

    // Pass Number
    $GFQuiz       = new \GFQuiz();
    $pass_percent = $GFQuiz->get_form_setting( $form, 'passPercent' );

    $text = str_replace( '{quiz_pass_number}', floor( count( $quiz_fields ) * ( $pass_percent / 100 ) ), $text );

    // Reset Form Button
    $form_button_link      = get_the_permalink();
    $form_button_title     = __( 'Reset The Form', 'girfec' );
    $form_button_placement = '';

    if ( isset( $form['submit_button_placement'] ) ) {
        $form_button_placement = $form['submit_button_placement'];
    }

    $button_markup = "<div class='qquiz-reset-button-wrap {$form_button_placement}'><a href='{$form_button_link}' class='btn btn-primary' title='{$form_button_title}'>{$form_button_title}</a></div>";

    $text = str_replace( '{quiz_reset_form_button}', $button_markup, $text );

    return $text;
}, 100, 7 );

/**
 * Confirmation Changes
 */
add_filter( 'gform_confirmation', function ( $confirmation, $form, $lead, $ajax ) {

    if ( ! class_exists( 'GFQuiz' ) ) {
        return $confirmation;
    }

    $GFQuiz  = new \GFQuiz();
    $grading = $GFQuiz->get_form_setting( $form, 'grading' );

    if ( $grading != 'none' ) {

        $display_confirmation = $GFQuiz->get_form_setting( $form, 'passfailDisplayConfirmation' );
        if ( false === $display_confirmation ) {
            return $confirmation;
        }

        $results = $GFQuiz->get_quiz_results( $form, $lead );

        if ( ! empty( $form['confirmation']['type'] ) && ( $form['confirmation']['type'] === 'page' ) && $results['is_pass'] ) {
            $confirmation = [
                'redirect' => get_the_permalink( $form['confirmation']['pageId'] )
            ];
        }
    }

    return $confirmation;
}, 100, 4 );

/**
 * Submit Button
 */
add_filter( 'gform_submit_button', function ( $button, $form ) {

    $ty_form  = get_field( 't_thank_you_form', 'option' );
    $c_button = get_field( 't_certificate_button', 'option' );

    if ( ! empty( $ty_form ) && ! empty( $c_button ) && ( $ty_form['id'] === $form['id'] ) ) {
        $button .= \App\get_the_wpc_button( [
            'data'    => $c_button,
            'classes' => [ 'btn-link' ]
        ] );
    }

    return $button;
}, 100, 2 );
