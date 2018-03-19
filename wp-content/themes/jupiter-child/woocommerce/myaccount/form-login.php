<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php wc_print_notices(); ?>

<?php do_action( 'woocommerce_before_customer_login_form' ); ?>

<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>

<div class="u-columns col2-set" id="customer_login">

	<div class="u-column1 col-1" id="page1">

<?php endif; ?>

		<!-- <h2><?php _e( 'Login', 'woocommerce' ); ?></h2> -->

		<form class="woocommerce-form woocommerce-form-login login " method="post">

			<?php do_action( 'woocommerce_login_form_start' ); ?>
            <p class="account_logo"> <img src="http://envisionmt.org/liven/wp-content/uploads/2017/10/about-s1log.png" alt="" /></p>
			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<!-- <label for="username"><?php _e( 'Username or email address', 'woocommerce' ); ?> <span class="required">*</span></label> -->
				<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" placeholder="用戶名" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( $_POST['username'] ) : ''; ?>" />
			</p>
			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<!-- <label for="password"><?php _e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label> -->
				<input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" placeholder="密碼" />
			</p>

			<?php do_action( 'woocommerce_login_form' ); ?>

			<p class="form-row liven_submit">
				<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
				<input type="submit" class="woocommerce-Button button" name="login" value="登錄" />
				<!-- <label class="woocommerce-form__label woocommerce-form__label-for-checkbox inline">
					<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span><?php _e( 'Remember me', 'woocommerce' ); ?></span> 
				</label> -->
			</p>
			<p class="liven_login" onclick="changepag('2','1')"><span>註冊</span></p>

			<!--  <p class="woocommerce-LostPassword lost_password">
				<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php _e( 'Lost your password?', 'woocommerce' ); ?></a>
			</p>  -->

			<?php do_action( 'woocommerce_login_form_end' ); ?>

		</form>

<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>

	</div>

	<div class="u-column2 col-2" id="page2" style="display: none">

		<!-- <h2><?php _e( 'Register', 'woocommerce' ); ?></h2> -->
         
		<form method="post" class="register">
              <p class="account_logo"> <img src="http://envisionmt.org/liven/wp-content/uploads/2017/10/about-s1log.png" alt="" /></p>
			<?php do_action( 'woocommerce_register_form_start' ); ?>
             
			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
					<!--  <label for="reg_username"><?php _e( 'Username', 'woocommerce' ); ?> <span class="required">*</span></label>  -->
					<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" placeholder="用戶名" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( $_POST['username'] ) : ''; ?>" />
				</p>

			<?php endif; ?>

			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<!-- <label for="reg_email"><?php _e( 'Email address', 'woocommerce' ); ?> <span class="required">*</span></label> -->
				<input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" placeholder="電子郵箱地址" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( $_POST['email'] ) : ''; ?>" />
			</p>

			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>
                
				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<!-- 	<label for="reg_password"><?php _e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label> -->
					<input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" placeholder="密碼" />
				</p>

			<?php endif; ?>

			<?php do_action( 'woocommerce_register_form' ); ?>

			<p class="woocommerce-FormRow form-row liven_submit">
				<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
				<input type="submit" class="woocommerce-Button button" name="register" value="註冊 " />
			</p>
			<p class="liven_register" onclick="changepag('1','2')"><span>登錄</span></p>

			<?php do_action( 'woocommerce_register_form_end' ); ?>

		</form>

	</div>

</div>
<?php endif; ?>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>

<script>
	function changepag(show,hide){
		var sho=document.getElementById('page'+show);
		var hid=document.getElementById('page'+hide);
		sho.style.display="block";
		hid.style.display="none";
	}
</script>