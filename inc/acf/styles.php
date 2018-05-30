<?php function base_acf_styles() { ?>
	<style type="text/css">

    /* Label - Hide */
    .acf-field.label-hide:not(tr) > .acf-label {
      display: none;
    }
    .acf-field.label-hide[data-type="message"] p:first-child {
      margin-top: 0;
    }
    .acf-field.label-hide[data-type="message"] p:last-child {
      margin-bottom: 0;
    }

    /* Label - Inline */
    .acf-field.label-inline {
      display: flex;
      align-items: center;
    }
    .acf-repeater .acf-row.-collapsed > .acf-fields > .acf-field.label-inline.acf-field.-collapsed-target {
      display: flex !important;
    }
    .acf-field.label-inline > .acf-label {
      margin-bottom: 0;
      margin-right: 1em;
    }
    .acf-field.label-inline > .acf-label label {
      margin: 0;
    }
    .acf-field.label-inline > .acf-input {
      flex: 1;
    }

    /* Border - None */
    .acf-fields > .acf-field.border-none > .acf-input > .-border {
      border: 0;
    }

    /* Border - Left */
    .acf-fields > .acf-field.border-left {
      border: 0 solid #eeeeee;
      border-left-width: 1px;
    }

    /* Padding - None */
    .acf-fields > .acf-field.padding-none,
    .acf-fields > .acf-field.padding-none.acf-field-repeater {
      padding: 0;
    }
    .acf-fields > .acf-field.padding-none.border-none > .acf-relationship .filters,
    .acf-fields > .acf-field.padding-none.border-none > .acf-relationship .selection {
      border-left: 0;
      border-right: 0;
      border-bottom: 0;
    }
    .acf-fields > .acf-field.padding-none.border-none > .acf-gallery {
      border-left: 0;
      border-right: 0;
      border-bottom: 0;
    }
    .acf-fields > .acf-field.padding-none.border-none > .acf-google-map,
    .acf-fields > .acf-field.padding-none.border-none > .acf-oembed {
      border: 0;
    }

    /* Additional Fields checkboxes */

    .acf-field[data-name="additional_fields"] .acf-checkbox-list li {
      display: inline-block;
      width: 48%;
    }

	</style>
<?php }

add_action('acf/input/admin_head', 'base_acf_styles');
