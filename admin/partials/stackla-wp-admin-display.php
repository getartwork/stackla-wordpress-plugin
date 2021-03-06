<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://stackla.com
 * @since      1.0.0
 *
 * @package    Stackla_WP
 * @subpackage Stackla_WP/admin/partials
 */
?>
<?php
$redirect_url = Stackla_WP_SDK_Wrapper::getRedirectUrl();
?>

<div id='wpbody' class="stacklaAdmin">
    <div id='wpbody-content' aria-label='Main content' tabindex='0'>
        <div class='wrap'>
            <h1 class="stacklaAdmin-header">Stackla For WordPress</h1>
            <?php
            if ($enableAuthorize) :
                if($state == 'init'):
            ?>
                <div class='auth-notification prompt'>
                    <h3>Autorization Required</h3>
                    <li>
                        Your WordPress Account is not authorized with Stackla. Enter your app details below to authorize this plugin.
                    </li>
                </div>
            <?php
                elseif($state == 'authenticated'):
            ?>
                <div class='auth-notification prompt'>
                    <h3>Authorization Required</h3>
                    <li>
                        Your WordPress Account is not authorized with Stackla.
                    </li>
                </div>
            <?php
                else:
            ?>
                <div class='auth-notification success'>
                    <h3>
                        Authorization Successful
                    </h3>
                    <ul>
                        <li>Your WordPress account is authorized with Stackla</li>
                    </ul>
                </div>
            <?php
                endif;
            endif;
            ?>
            <form
                id='stackla-settings-form'
                class='settings-form'
                method='POST'
                data-accessuri=""
                data-state="<?php echo $state?>"
            >
                <section>
                    <h2>Step 1: Configure Stackla</h2>

                    <p>Before you can configure WordPress, you need to first configure Stackla.</p>
                    <p>Copy the 'Redirect URL' below and paste it in the relevant field in the WordPress plugin configuration screen in Stackla.</p>

                    <div class="input-group">
                        <label for="redirect">Redirect URL</label>
                        <input type='text' class='widefat' name='redirect' id='redirect' readonly="readonly" value="<?php echo $redirect_url; ?>">
                        <p class="description">Please copy + paste this URL into the 'Redirect URL' field in the WordPress plugin configuration screen in Stackla.</p>
                        <div class='error-message'></div>
                    </div>
                </section>

                <section>
                    <h2>Step 2: Configure WordPress</h2>

                    <p>You can retrieve <b>these details</b> from the WordPress plugin configuration screen.</p>

                    <div class="input-group">
                        <label for="stack">Stack Shortname</label>
                        <input type='text' class='widefat' name='stack' id='stack' value="<?php echo esc_attr(($settings['current']) ? $settings['current']['stackla_stack'] : '') ?>">
                        <div class='error-message'></div>
                    </div>

                    <div class="input-group">
                        <label for="client_id">Client ID</label>
                        <input type='text' class='widefat' name='client_id' id='client_id' value="<?php echo esc_attr(($settings['current']) ? $settings['current']['stackla_client_id'] : '') ?>">
                        <div class='error-message'></div>
                    </div>

                    <div class="input-group">
                        <label for="client_secret">Client secret</label>
                        <input type='text' class='widefat' name='client_secret' id='client_secret' value="<?php echo esc_attr(($settings['current']) ? $settings['current']['stackla_client_secret'] : '') ?>">
                        <div class='error-message'></div>
                    </div>
                </section>

                <section>
                    <h2>Step 3: Activate on post type</h2>

                    <p>Choose the WordPress post types you would like to add the Stackla Widget creation meta box to.</p>

                    <div class="input-group">
                    <?php
                        foreach($settings['post_type_options'] as $option):
                            $mandatoryChecked = '';
                            $typeChecked = '';
                            if ($settings['post_types'] && isset($settings['post_types'][$option]) && $settings['post_types'][$option]['mandatory']) {
                                $mandatoryChecked = 'checked';
                            }
                            if ($settings['post_types'] && isset($settings['post_types'][$option]) && $settings['post_types'][$option]['enabled']) {
                                $typeChecked = 'checked';
                            }
                    ?>
                        <label class="input-checkbox">
                            <input
                                type='checkbox' name='types[]'
                                <?php echo $typeChecked ?>
                                <?php echo $enableAuthorize ? '' : 'disabled' ?>
                                value="<?php echo $option ?>">
                            <?php echo ucfirst($option) ?>s
                        </label>
                    <?php endforeach; ?>
                    </div>
                </section>

                <section>
                    <h2>Step 4: Authorize</h2>

                    <p>You need to authorize WordPress to access your Stackla account. Click 'Authorize' below, you'll be prompted to log in to Stackla to provide authorization.

                    <div>
                        <?php $generateTokenText = "Authorize"; ?>
                        <?php if ($state == 'authorized') : ?>
                            <?php $generateTokenText = "Reauthorize"; ?>
                        <input type='button'
                            id="js-revoke-token"
                            value='Revoke authorization'
                            class='button button-danger button-large'
                            data-url="<?php echo $redirect_url ?>">
                        <?php endif; ?>
                        <input type='button'
                            id="js-regenerate-token"
                            value='<?php echo $generateTokenText ?>'
                            class='button button-primary button-large'
                            <?php echo $enableAuthorize ? '' : 'disabled' ?>
                            data-url="<?php echo $access_uri ?>">
                    </div>
                </section>

                <section>
                    <input type='submit' value='Save' class='button'>
                </section>
            </form>
            <div id='feedback'></div>
        </div>
    </div>
    <div class='clear'></div>
</div>
