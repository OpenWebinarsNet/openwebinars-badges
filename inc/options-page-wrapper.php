<div class="wrap">

	<div id="icon-options-general" class="icon32"></div>
	<h1><?php esc_attr_e( 'OpenWebinars Badges', 'wp_admin_style' ); ?></h1>

	<div id="poststuff">

		<div id="post-body" class="metabox-holder columns-2">

			<!-- main content -->
			<div id="post-body-content">

				<div class="meta-box-sortables ui-sortable">

					<?php if ( !isset( $openwebinars_email ) || $openwebinars_email == '' ): ?>

					<div class="postbox">

						<div class="handlediv" title="Click to toggle"><br></div>
						<!-- Toggle -->

						<h2 class="hndle"><span><?php esc_attr_e( 'Main Content Header', 'wp_admin_style' ); ?></span>
						</h2>

						<div class="inside">
              <form name="openwebinars_email_form" action="" method="post">

								<input type="hidden" name="openwebinars_form_submitted" value="Y">

                <table class="form-table">
                	<tr>
                    <td>
                      <label for="openwebinars_email">OpenWebinars email</label>
                    </td>
                    <td>
                      <input name="openwebinars_email" id="openwebinars_email" type="text" value="openwebinars_email" class="regular-text" /><br>
                    </td>
                  </tr>
                </table>

                <p>
                  <input class="button-primary" type="submit" name="openwebinars_email_submit" value="<?php esc_attr_e( 'Save' ); ?>" />
                </p>
              </form>
						</div>
						<!-- .inside -->

					</div>

				<?php else: ?>

					<!-- .postbox -->
          <div class="postbox">

						<div class="handlediv" title="Click to toggle"><br></div>
						<!-- Toggle -->

						<h2 class="hndle"><span><?php esc_attr_e( 'Most Recent Badges', 'wp_admin_style' ); ?></span>
						</h2>

						<div class="inside">
              <p>Below are your 20 most recent badges.</p>

							<ul class="openwebinars-badges">
									<?php for( $i = 0; $i < 20; $i++ ): ?>
									<li>
										<ul>
											<li>
												<img width="120px" src="<?php echo $plugin_url . '/images/web-navigator.png'; ?>">
											</li>
											<li class="openwebinars-badge-name">
												<a href="#">Badge Name</a>
											</li>
											<li class="openwebinars-project-name">
												<a href="#">Project Name</a>
											</li>
										</ul>
									</li>
									<?php endfor; ?>
							</ul>
						</div>
						<!-- .inside -->

					</div>
					<!-- .postbox -->

					<?php endif; ?>

				</div>
				<!-- .meta-box-sortables .ui-sortable -->

			</div>
			<!-- post-body-content -->

			<!-- sidebar -->
			<div id="postbox-container-1" class="postbox-container">

				<div class="meta-box-sortables">

					<?php if ( isset( $openwebinars_email ) && $openwebinars_email != '' ): ?>

					<div class="postbox">
						<h3><span>Chip' Profile</span></h3>
						<div class="inside">
							<p><img src="<?php echo $plugin_url . '/images/profile.png'; ?>" width='100%' class='openwebinars-gravatar' alt="Chip squirrel' Profile"></p>
							<ul class="openwebinars-badges-and-points">
								<li>Badges: <strong>200</strong></li>
								<li>Points: <strong>10000</strong></li>
							</ul>
							<form name="openwebinars_email_form" action="" method="post">
								<input type="hidden" name="openwebinars_form_submitted" value="Y">
								<p>
									<label for="openwebinars_email">OpenWebinars email</label>
								</p>
                <p>
									<input name="openwebinars_email" id="openwebinars_email" type="text" value="<?php echo $openwebinars_email; ?>"/>
								</p>
                <p>
                  <input class="button-primary" type="submit" name="openwebinars_email_submit" value="<?php esc_attr_e( 'Update' ); ?>" />
                </p>
              </form>
						</div>
						<!-- .inside -->
					</div>
					<!-- .postbox -->
					<?php endif; ?>
				</div>
				<!-- .meta-box-sortables -->

			</div>
			<!-- #postbox-container-1 .postbox-container -->

		</div>
		<!-- #post-body .metabox-holder .columns-2 -->

		<br class="clear">
	</div>
	<!-- #poststuff -->

</div> <!-- .wrap -->
