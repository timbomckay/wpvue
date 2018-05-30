<?php

/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
add_image_size( 'thumb-600', 600, 150, true );
add_image_size( 'thumb-300', 300, 100, true );

add_filter( 'image_size_names_choose', 'base_custom_image_sizes' );

function base_custom_image_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'thumb-600' => __('600px by 150px'),
        'thumb-300' => __('300px by 100px'),
    ) );
}

/*
	Rebuild the image tag with only the stuff we want
	Credit: Brian Gottie
	Source: http://blog.skunkbad.com/wordpress/another-look-at-rebuilding-image-tags
*/

if ( ! class_exists( 'Base_img_rebuilder' ) ) :
	class Base_img_rebuilder {

	  public $caption_class   = 'wp-caption';
	  public $caption_p_class = 'wp-caption-text';
	  public $caption_id_attr = false;
	  public $caption_padding = 8; // Double of the padding on $caption_class

	  public function __construct() {
	    add_filter( 'img_caption_shortcode', array( $this, 'img_caption_shortcode' ), 1, 3 );
	    add_filter( 'get_avatar', array( $this, 'recreate_img_tag' ) );
	    add_filter( 'the_content', array( $this, 'the_content') );
	  }

	  public function recreate_img_tag( $tag ) {
        // Supress SimpleXML errors
        libxml_use_internal_errors( true );

        try {
            $x = new SimpleXMLElement( $tag );

            // We only want to rebuild img tags
            if ( $x->getName() == 'img' ) {

                // Get the attributes I'll use in the new tag
                $alt        = (string) $x->attributes()->alt;
                $src        = (string) $x->attributes()->src;
                $classes    = (string) $x->attributes()->class;
                $class_segs = explode(' ', $classes);

                // All images have a source
                $img = '<img src="' . $src . '"';

                // If alt not empty, add it
                if ( ! empty( $alt ) ) {
                  $img .= ' alt="' . $alt . '"';
                }

                // Filter Through Class Segments & Find Alignment Classes and Size Classes
                $filtered_classes = array();

                foreach ( $class_segs as $class_seg ) {
                    if ( substr( $class_seg, 0, 5 ) === 'align' || substr( $class_seg, 0, 4 ) === 'size' ) {
                        $filtered_classes[] = $class_seg;
                    }
                }

                // Add Rebuilt Classes and Close The Tag
                if ( count( $filtered_classes ) ) {
                    $img .= ' class="' . implode( $filtered_classes, ' ' ) . '" />';
                } else {
                    $img .= ' />';
                }

                return $img;
            }
        }

        catch ( Exception $e ) {
                if ( defined('WP_DEBUG') && WP_DEBUG ) {
                        if ( defined('WP_DEBUG_DISPLAY') && WP_DEBUG_DISPLAY ) {
                            echo 'Caught exception: ',  $e->getMessage(), "\n";
                        }
                }
            }

        // Tag not an img, so just return it untouched
        return $tag;
	  }

	  /**
	   * Search post content for images to rebuild
	   */
	  public function the_content( $html ) {
	    return preg_replace_callback(
	      '|(<img[^>]*>)|',
	      array( $this, 'the_content_callback' ),
	      $html
	    );
	  }

	  /**
	   * Rebuild an image in post content
	   */
	  private function the_content_callback( $match ) {
	    return $this->recreate_img_tag( $match[0] );
	  }

	  /**
	   * Customize caption shortcode
	   */
	  public function img_caption_shortcode( $output, $attr, $content ) {
	    // Not for feed
	    if ( is_feed() ) {
	      return $output;
      }

	    // Set up shortcode atts
	    $attr = shortcode_atts( array(
	      'align'   => 'alignnone',
	      'caption' => '',
	      'width'   => '',
	    ), $attr );

	    // Add id and classes to caption
	    $attributes = '';
			$caption_id_attr = '';

	    if ( $caption_id_attr && ! empty( $attr['id'] ) ) {
	      $attributes .= ' id="' . esc_attr( $attr['id'] ) . '"';
	    }

	    $attributes .= ' class="' . $this->caption_class . ' ' . esc_attr( $attr['align'] ) . '"';

	    // Set the max-width of the caption
	    $attributes .= ' style="max-width:' . ( $attr['width'] + $this->caption_padding ) . 'px;"';

	    // Create caption HTML
	    $output = '
	      <div' . $attributes .'>' .
	        do_shortcode( $content ) .
	        '<p class="' . $this->caption_p_class . '">' . $attr['caption'] . '</p>' .
	      '</div>
	    ';

	    return $output;
	  }
	}

	$base_img_rebuilder = new Base_img_rebuilder;

endif;

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images
 *
 * @since Twenty Sixteen 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function base_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];

	840 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 62vw, 840px';

	if ( 'page' === get_post_type() ) {
		840 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
	} else {
		840 > $width && 600 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 61vw, (max-width: 1362px) 45vw, 600px';
		600 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
	}

	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'base_content_image_sizes_attr', 10 , 2 );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails
 *
 * @since Twenty Sixteen 1.0
 *
 * @param array $attr Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size Registered image size or flat array of height and width dimensions.
 * @return string A source size value for use in a post thumbnail 'sizes' attribute.
 */
function base_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	if ( 'post-thumbnail' === $size ) {
		is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 60vw, (max-width: 1362px) 62vw, 840px';
		! is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 88vw, 1200px';
	}
	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'base_post_thumbnail_sizes_attr', 10 , 3 );

?>
