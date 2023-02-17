<?php

namespace RalfHortt\MetaBoxAddress;

use RalfHortt\MetaBoxes\MetaBox;
use RalfHortt\TranslatorService\Translator;

class MetaBoxAddress extends MetaBox
{
    public function __construct(array $screen = [], string $context = 'advanced', string $priority = 'default')
    {
        $this->identifier = \apply_filters('wp-meta-box-address-meta-box-identifier', 'address-data');
        $this->name = \apply_filters('wp-meta-box-address-meta-box-label', \__('Address', 'wp-meta-box-address'));
        $this->screen = $screen;
        $this->context = $context;
        $this->priority = $priority;

        (new Translator('wp-meta-box-address', dirname(\plugin_basename(__FILE__)).'/../languages/'))->register();
    }

    protected function render(\WP_Post $post, array $callbackArgs): void
    {
        $street = \get_post_meta($post->ID, '_address-street', true);
        $streetnumber = \get_post_meta($post->ID, '_address-streetnumber', true);
        $addressAdditional = \get_post_meta($post->ID, '_address-additional', true);
        $zip = \get_post_meta($post->ID, '_address-zip', true);
        $city = \get_post_meta($post->ID, '_address-city', true);
        $country = \get_post_meta($post->ID, '_address-country', true);
        $latitude = \get_post_meta($post->ID, '_address-latitude', true);
        $longitude = \get_post_meta($post->ID, '_address-longitude', true);
        $address = "$street $streetnumber $zip $city $country"; ?>
        <table class="form-table">

            <?php \do_action('wp-meta-box-address/before') ?>

            <?php if (\apply_filters('wp-meta-box-address/street-'.$post->post_type, true)) { ?>
                <tr>
                    <th><label for="wp-meta-box-address-street"><?php \_e('Street', 'wp-meta-box-address') ?></label></th>
                    <td><input class="regular-text" type="text" name="wp-meta-box-address-street" id="wp-meta-box-address-street" value="<?= \esc_attr($street) ?>"></td>
                </tr>
            <?php } ?>

            <?php if (\apply_filters('wp-meta-box-address/streetnumber-'.$post->post_type, true)) { ?>
                <tr>
                    <th><label for="wp-meta-box-address-streetnumber"><?php \_e('Number', 'wp-meta-box-address') ?></label></th>
                    <td><input class="regular-text" type="text" name="wp-meta-box-address-streetnumber" id="wp-meta-box-address-streetnumber" value="<?= \esc_attr($streetnumber) ?>"></td>
                </tr>
            <?php } ?>

            <?php if (\apply_filters('wp-meta-box-address/address-additional-'.$post->post_type, true)) { ?>
                <tr>
                    <th><label for="wp-meta-box-address-additional"><?php \_e('Address additional', 'wp-meta-box-address') ?></label></th>
                    <td><input class="regular-text" type="text" name="wp-meta-box-address-additional" id="wp-meta-box-address-additional" value="<?= \esc_attr($addressAdditional) ?>"></td>
                </tr>
            <?php } ?>

            <?php if (\apply_filters('wp-meta-box-address/zip-'.$post->post_type, true)) { ?>
                <tr>
                    <th><label for="wp-meta-box-address-zip"><?php \_e('ZIP Code', 'wp-meta-box-address') ?></label></th>
                    <td><input class="regular-text" type="text" name="wp-meta-box-address-zip" id="wp-meta-box-address-zip" value="<?= \esc_attr($zip) ?>"></td>
                </tr>
            <?php } ?>

            <?php if (\apply_filters('wp-meta-box-address/city-'.$post->post_type, true)) { ?>
                <tr>
                    <th><label for="wp-meta-box-address-city"><?php \_e('City', 'wp-meta-box-address') ?></label></th>
                    <td><input class="regular-text" type="text" name="wp-meta-box-address-city" id="wp-meta-box-address-city" value="<?= \esc_attr($city) ?>"></td>
                </tr>
            <?php } ?>

            <?php if (\apply_filters('wp-meta-box-address/country-'.$post->post_type, true)) { ?>
                <tr>
                    <th><label for="wp-meta-box-address-country"><?php \_e('Country', 'wp-meta-box-address') ?></label></th>
                    <td>
                        <input class="regular-text" type="text" name="wp-meta-box-address-country" id="wp-meta-box-address-country" value="<?= \esc_attr($country) ?>" list="countries">
                        <datalist id="countries">
                            <option><?php \_e('Albania', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Algeria', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Argentina', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Australia', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Austria', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Azerbaijan', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Bahrain', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Basque', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Belarus', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Belgium', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Bolivia', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Bosnia and Herzegovina', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Brazil', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Bulgaria', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Canada', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Chile', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('China', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Colombia', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Costa Rica', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Croatia', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Czech Republic', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Denmark', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Dominican Republic', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Ecuador', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Egypt', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('El Salvador', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Espana', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Estonia', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Faroe Islands', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Finland', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Former Yugoslav Republic of Macedonia', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('France', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Germany', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Greece', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Guatemala', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Honduras', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Hong Kong S.A.R.', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Hungary', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Iceland', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('India', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Indonesia', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Iran', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Iraq', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Ireland', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Israel', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Italy', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Japan', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Jordan', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Kazakhstan', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Korea', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Kuwait', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Kyrgyzstan', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Latvia', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Lebanon', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Libya', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Lithuania', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Luxembourg', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Macau S.A.R.', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Mexico', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Mongolia', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Morocco', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Netherlands', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('New Zealand', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Nicaragua', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Norway', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Oman', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Panama', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Paraguay', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Peru', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Philippines', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Poland', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Portugal', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Puerto Rico', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Qatar', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Republic of the Philippines', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Romania', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Russia', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Saudi Arabia', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Serbia and Montenegro', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Serbia', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Singapore', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Slovakia', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Slovenia', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('South Africa', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Spain', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Spain', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Sweden', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Switzerland', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Syria', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Taiwan', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Thailand', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Tunisia', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Turkey', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('U.A.E.', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Ukraine', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('United Kingdom', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('United States', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Uruguay', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Venezuela', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Viet Nam', 'wp-meta-box-address') ?></option>
                            <option><?php \_e('Yemen', 'wp-meta-box-address') ?></option>
                        </datalist>
                    </td>
                </tr>
            <?php } ?>

            <?php if (\apply_filters('wp-meta-box-address/latitude-'.$post->post_type, true)) { ?>
                <tr>
                    <th><label for="wp-meta-box-address-latitude"><?php \_e('Latitude', 'wp-meta-box-address') ?></label></th>
                    <td><input class="regular-text" type="text" name="wp-meta-box-address-latitude" id="wp-meta-box-address-latitude" value="<?= \esc_attr($latitude) ?>"></td>
                </tr>
            <?php } ?>

            <?php if (\apply_filters('wp-meta-box-address/longitude-'.$post->post_type, true)) { ?>
                <tr>
                    <th><label for="wp-meta-box-address-longitude"><?php \_e('Longitude', 'wp-meta-box-address') ?></label></th>
                    <td><input class="regular-text" type="text" name="wp-meta-box-address-longitude" id="wp-meta-box-address-longitude" value="<?= \esc_attr($longitude) ?>"></td>
                </tr>
            <?php } ?>

            <?php
            if (\apply_filters('wp-meta-box-address/map-'.$post->post_type, true)) {
                ?>
                <tr>
                    <th><?php \_e('Preview', 'wp-meta-box-address') ?></th>
                    <td>
                        <iframe class="wp-meta-box-address-map" style="height: 400px; width: 100%;" src="https://maps.google.de/maps?q=<?= urlencode($address) ?>&amp;output=embed"></iframe>
                    </td>
                </tr>
                <?php
            } ?>

            <?php \do_action('wp-meta-box-address/after') ?>

        </table>
		<?php
    }

    protected function save(int $postId, \WP_Post $post, bool $update): void
    {
        if (\apply_filters('wp-meta-box-address/street-'.$post->post_type, true)) {
            \update_post_meta($postId, '_address-street', \sanitize_text_field($_POST['wp-meta-box-address-street']));
        }

        if (\apply_filters('wp-meta-box-address/streetnumber-'.$post->post_type, true)) {
            \update_post_meta($postId, '_address-streetnumber', \sanitize_text_field($_POST['wp-meta-box-address-streetnumber']));
        }

        if (\apply_filters('wp-meta-box-address/address-additional-'.$post->post_type, true)) {
            \update_post_meta($postId, '_address-additional', \sanitize_text_field($_POST['wp-meta-box-address-additional']));
        }

        if (\apply_filters('wp-meta-box-address/zip-'.$post->post_type, true)) {
            \update_post_meta($postId, '_address-zip', \sanitize_text_field($_POST['wp-meta-box-address-zip']));
        }

        if (\apply_filters('wp-meta-box-address/city-'.$post->post_type, true)) {
            \update_post_meta($postId, '_address-city', \sanitize_text_field($_POST['wp-meta-box-address-city']));
        }

        if (\apply_filters('wp-meta-box-address/country-'.$post->post_type, true)) {
            \update_post_meta($postId, '_address-country', \sanitize_text_field($_POST['wp-meta-box-address-country']));
        }

        if (\apply_filters('wp-meta-box-address/latitude-'.$post->post_type, true)) {
            \update_post_meta($postId, '_address-latitude', \sanitize_text_field($_POST['wp-meta-box-address-latitude']));
        }

        if (\apply_filters('wp-meta-box-address/longitude-'.$post->post_type, true)) {
            \update_post_meta($postId, '_address-longitude', \sanitize_text_field($_POST['wp-meta-box-address-longitude']));
        }

        \do_action('wp-meta-address-save', $postId, $post);
    }
}
