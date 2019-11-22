<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://rahicodes.wordpress.com
 * @since      1.0.0
 *
 * @package    Rahi_wpbook
 * @subpackage Rahi_wpbook/admin/partials
 */

/**
 * This function renders the custom settings page for 'book settings'
 * 
 * @since      1.0.5
 */
function book_render_settings_page() {
    global $book_options;
   
    $currencies = array( 'USD', 'INR', 'EUR', 'GBP', 'JPY', 'CAD', 'AUD' );
    echo '<h1>Book Settings</h1>
        <h3 class="title">Manage Options</h3>
       
        <form method="post" action="options.php">';
       
        settings_fields( 'book-settings-group' );
    echo '<div class="book-settings-content">
        <p>
            <label class="description" for="book_settings[currency]"> Select the currency : </label>
           
            <select id="book_settings[]" name="book_settings[currency]">';
                $selected_currency = esc_attr( $book_options[ 'currency' ] );
            foreach ( $currencies as $currency ) {
                if ( $selected_currency != $currency ) {
                    echo '<option value="' . $currency . '">' . $currency . '</option>';
                } else {
                    echo '<option selected value="' . $currency . '">' . $currency . '</option>';
                }
            }
            echo '</select></p>';
               
        echo '<p>
            <label class="description" for="book_settings[num_of_books]"> Number of books per page : </label>
            <input type="number" min="0" max="100" step="1" id="book_settings[num_of_books]" name="book_settings[num_of_books]" value="' . esc_attr( $book_options[ 'num_of_books' ] ) .'"/>
        </p>
        <p class="submit">
            <input type="submit" class="button-primary" value="Save Options" />
        </p>
       
        </div>
    </form>';
}

/**
 * Helper Function for rendering book info 
 * for shortcode
 * 
 * @since    1.0.6
 */
function render_custom_metadata( $all_info ) {

    global $book_options;
    ?>
    <!-- labels -->
    <ul class="meta-wrapper">
        <li>
            <label for="book_author_name_field">Author's Name</label>
            <input type="text" id="book_author_name_field" name="book_author_name_field" value="<?php echo esc_attr( $all_info[ 'author_name' ] ); ?>"/>
        </li>

        <li>
            <label for="book_price_field">Price</label>
            <input class="currency-input" type="number" step="0.01" min="0" id="book_price_field" name="book_price_field" value=" <?php echo esc_attr( $all_info[ 'price' ] ); ?> "/>
            <a title="Change Currency" href=" <?php echo( get_site_url() . '/wp-admin/admin.php?page=book-settings' ); ?>">
                <div class="currency .bg-secondary"><span> <?php echo $book_options[ 'currency' ] ?> </span> </div>
            </a>
        </li>

        <li>
            <label for="book_publisher_field">Publisher</label>
            <input type="text" id="book_publisher_field" name="book_publisher_field" value=" <?php echo esc_attr( $all_info[ 'publisher' ] ); ?>"/>
        </li>
            
        <li>
            <label for="book_year_field">Year</label>
            <input type="number" min="1900" max="2099" step="1" id="book_year_field" name="book_year_field" value=" <?php echo esc_attr( $all_info[ 'year' ] ); ?> "/>
        </li>
            
        <li>
            <label for="book_edition_field">Edition</label>
            <input type="number" min="0" id="book_edition_field" name="book_edition_field" value=" <?php echo esc_attr( $all_info[ 'edition' ] ); ?> "/>
        </li>

        <li>
            <label for="book_url_field">URL</label>
            <input type="text" id="book_url_field" name="book_url_field" value=" <?php echo esc_attr( $all_info[ 'url' ] ); ?> "/>
        </li>
            
    </ul>

    <?php
}
 
/**
 * Helper Function for rendering book info 
 * for shortcode
 * 
 * @since    1.0.6
 * @param    $args arguments passed from the base function which passes custom wp_query args.
 */
function render_book_info_shortcode( $args ) {

    global $book_options;

    $html = '';

    $the_query = new WP_Query( $args );

    if ( $the_query->have_posts() ) {

        while ( $the_query->have_posts() ) {

            $the_query->the_post();

            $all_info = get_metadata( 'bookinfo', get_the_id(), '_additional_info_key' )[0];
            
            $html .= '<ul>';

            if ( get_the_title() != '' )
                $html .= '<li>Title : <a href=' . get_post_permalink() . '/>' . get_the_title() . '</a></li>';
            
            if ( $all_info[ 'author_name' ] != '' ) 
                $html .= '<li>Author : <a href=' . get_the_author_link() . '/>'  . $all_info[ 'author_name' ] . '</a></li>';
            else 
                $html .= '<li>Author : ' . get_the_author() . '</li>';
    
            if ( ( $all_info[ 'price' ] != '' ) && ( $book_options[ 'currency' ] != '') ) 
                $html .= '<li>Price : ' . $all_info[ 'price' ] . ' ' . $book_options[ 'currency' ] . '</li>';

            if ( $all_info[ 'publisher' ] != '' ) 
                $html .= '<li>Publisher : ' . $all_info[ 'publisher' ] . '</li>';

            if ( $all_info[ 'year' ] != '' ) 
                $html .= '<li>Year : ' . $all_info[ 'year' ] . '</li>';
            else
                $html .= '<li>Year : ' . get_the_date('Y') . '</li>';

            if ( $all_info[ 'edition' ] != '' ) 
                $html .= '<li>Edition : ' . $all_info[ 'edition' ] . '</li>';

            if ( $all_info[ 'url' ]  != '' ) 
                $html .= '<li>Url : <a href="' . $all_info[ 'url' ] . '">' . $all_info[ 'url' ] . '</a></li>';
                
            if ( get_the_content() != '' ) 
                $html .= '<li>Content : ' . get_the_content() . '</li>';

            $html .= '</ul>';
        }

        wp_reset_postdata();
    } else {
        $html .= '<h2>No books found</h2>';
    }
    
    wp_reset_query();

    return $html;
}

/**
 * Helper Function for rendering dashboard widget 
 * 
 * @since    1.1.0
 */
function book_render_dash_widget() {

    $categories = get_terms( array(
        'taxonomy'   => 'book_category',
        'hide_empty' => false,
        'number'     => '5',
        'orderby'    => 'count',
        'order'      => 'DESC',
    ) );
    
    if ( ! empty( $categories ) ) : ?>
        <p class="book-dash-head">
            <span><b>Category Name</b></span>
            <span><b>Count</b></span>
        </p>
        
        <ul class="book-dash-list">
        <?php
        // render out categories
        foreach ( $categories as $category ) { ?>
            <li><a 
                href="<?php echo get_category_link( $category->term_id );?>" 
                alt="<?php echo $category->name; ?>">
                <?php echo $category->name; ?>
                </a>
                <span class="count"><?php echo $category->count; ?></span>
            </li>
        <?php } ?>

        </ul>
    <?php else : ?>
        <p><i>Add new book categories to see your top 5 book categories here!</i></p>
    <?php
    endif;
}
