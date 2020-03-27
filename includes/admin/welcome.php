<div class="noptin-welcome">
	<div class="noptin-main-header">
		<h1>Noptin v1.2.6</h1>
		<a href="https://github.com/hizzle-co/noptin/issues/new/choose" target="_blank"><?php _e( 'Report a bug or request a feature', 'newsletter-optin-box' ); ?></a>
	</div>

	<div class="noptin-header">
		<h2><?php _e( 'Newsletter Subscribers', 'newsletter-optin-box' ); ?></h2>
		<hr/>
		<span title="<?php esc_attr_e( 'Your email subscribers', 'newsletter-optin-box' ); ?>" class="noptin-tip dashicons dashicons-info"></span>
	</div>

	<div class="noptin-cards-container">
		<ul class="noptin-cards-list">
				<li class="noptin-card">
					<span class="noptin-card-label"><?php _e( 'Total', 'newsletter-optin-box' ); ?></span>
					<span class="noptin-card-value"><?php echo $subscribers_total; ?></span>
				</li>
				<li class="noptin-card">
					<span class="noptin-card-label"><?php _e( 'Today', 'newsletter-optin-box' ); ?></span>
					<span class="noptin-card-value"><?php echo $subscribers_today_total; ?></span>
				</li>
				<li class="noptin-card">
					<span class="noptin-card-label"><?php _e( 'This Week', 'newsletter-optin-box' ); ?></span>
					<span class="noptin-card-value"><?php echo $subscribers_week_total; ?></span>
				</li>
		</ul>
		<div class="noptin-card-footer-links"><a href="<?php echo $subscribers_url; ?>"><?php _e( 'View all subscribers', 'newsletter-optin-box' ); ?></a> | <a href="<?php echo esc_url( get_noptin_new_newsletter_campaign_url() ); ?>"><?php _e( 'Send them an email', 'newsletter-optin-box' ); ?></a></div>
	</div>


	<div class="noptin-header">
		<h2><?php _e( 'Newsletter Subscription Forms', 'newsletter-optin-box' ); ?></h2>
		<hr/>
		<span title="<?php esc_attr_e( 'Active forms created via the Opt-In Forms Editor', 'newsletter-optin-box' ); ?>" class="noptin-tip dashicons dashicons-info"></span>
	</div>

	<div class="noptin-cards-container">
		<ul class="noptin-cards-list">
				<li class="noptin-card">
					<span class="noptin-card-label"><?php _e( 'Popup Forms', 'newsletter-optin-box' ); ?></span>
					<span class="noptin-card-value"><?php echo $popups; ?></span>
				</li>
				<li class="noptin-card">
					<span class="noptin-card-label"><?php _e( 'Shortcode Forms', 'newsletter-optin-box' ); ?></span>
					<span class="noptin-card-value"><?php echo $inpost; ?></span>
				</li>
				<li class="noptin-card">
					<span class="noptin-card-label"><?php _e( 'Widget Forms', 'newsletter-optin-box' ); ?></span>
					<span class="noptin-card-value"><?php echo $widget; ?></span>
				</li>
				<li class="noptin-card">
					<span class="noptin-card-label"><?php _e( 'Sliding Forms', 'newsletter-optin-box' ); ?></span>
					<span class="noptin-card-value"><?php echo $slide_in; ?></span>
				</li>
		</ul>
		<div class="noptin-card-footer-links"><a href="<?php echo $forms_url; ?>"><?php echo sprintf( 'View all forms', 'newsletter-optin-box' ); ?></a> | <a href="<?php echo $new_form_url; ?>"><?php echo sprintf( 'Create a new form', 'newsletter-optin-box' ); ?></a></div>
	</div>

	<div class="noptin-body">
		<hr/>
		<p><?php echo sprintf(
			__( 'Thousands of hours have gone into this plugin. If you love it, Consider %sgiving us a 5* rating on WordPress.org%s. It takes less than 5 minutes.', 'newsletter-optin-box' ),
			'<a href="https://wordpress.org/support/plugin/newsletter-optin-box/reviews/?filter=5" target="_blank">',
			'</a>'
		);?> </p>
	</div>


</div>
