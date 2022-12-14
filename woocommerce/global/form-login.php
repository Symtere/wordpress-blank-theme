    <?php
    /**
    * Login form
    *
    * This template can be overridden by copying it to yourtheme/woocommerce/global/form-login.php.
    *
    * HOWEVER, on occasion WooCommerce will need to update template files and you
    * (the theme developer) will need to copy the new files to your theme to
    * maintain compatibility. We try to do this as little as possible, but it does
    * happen. When this occurs the version of the template file will be bumped and
    * the readme will list any important changes.
    *
    * @see         https://docs.woocommerce.com/document/template-structure/
    * @package     WooCommerce\Templates
    * @version     3.6.0
    */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

if ( is_user_logged_in() ) {
    return;
}

?>
<form class="woocommerce-form woocommerce-form-login login" method="post" <?php echo ( $hidden ) ? 'style="display:none;"' : ''; ?>>

    <?php do_action( 'woocommerce_login_form_start' ); ?>

    <strong><?php echo ( $message ) ? wpautop( wptexturize( $message ) ) : ''; // @codingStandardsIgnoreLine ?></strong>

    <div class="row">
        <div class="col-md-6">
            <p class="form-row">
                <label for="username"><?php esc_html_e( 'Username or email', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
                <input type="text" class="input-text form-control" name="username" id="username" autocomplete="username" />
            </p>
        </div>
        <div class="col-md-6">
            <p class="form-row">
                <label for="password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
                <input class="input-text form-control" type="password" name="password" id="password" autocomplete="current-password" />
            </p>
        </div>
    </div>

    <?php do_action( 'woocommerce_login_form' ); ?>

    <div class="row">
        <div class="col-md-6">
            <div class="form-check form-group">
                <label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme form-check-label">
                    <input class="woocommerce-form__input woocommerce-form__input-checkbox form-check-input" name="rememberme" type="checkbox" id="rememberme" value="forever" />
                    <span><?php esc_html_e( 'Remember me', 'woocommerce' ); ?></span>
                </label>
            </div>
        </div>
        <div class="col-md-6">
            <p class="lost_password form-group">
                <a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'woocommerce' ); ?></a>
            </p>
        </div>
    </div>
    <p class="form-row px-0">
        <?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
        <input type="hidden" name="redirect" value="<?php echo esc_url( $redirect ); ?>" />
        <button type="submit" class="woocommerce-button btn btn-primary" name="login" value="<?php esc_attr_e( 'Login', 'woocommerce' ); ?>"><?php esc_html_e( 'Login', 'woocommerce' ); ?></button>
    </p>

    <?php do_action( 'woocommerce_login_form_end' ); ?>

</form>
</form>
