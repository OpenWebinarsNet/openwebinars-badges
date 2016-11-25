<h2><?php esc_attr_e( '2 Columns Layout: static (px)', 'wp_admin_style' ); ?></h2>

<div class="wrap">

	<div id="icon-options-general" class="icon32"></div>
	<h1><?php esc_attr_e( 'OpenWebinars Badges', 'wp_admin_style' ); ?></h1>

	<div id="poststuff">

		<div id="post-body" class="metabox-holder columns-2">

			<!-- main content -->
			<div id="post-body-content">

				<div class="meta-box-sortables ui-sortable">

					<div class="postbox">

						<div class="handlediv" title="Click to toggle"><br></div>
						<!-- Toggle -->

						<h2 class="hndle"><span><?php esc_attr_e( 'Main Content Header', 'wp_admin_style' ); ?></span>
						</h2>

						<div class="inside">
              <form class="" action="" method="post">
                <table class="form-table">
                	<tr>
                    <td>
                      <label for="openwebinars_username">OpenWebinars username</label>
                    </td>
                    <td>
                      <input name="openwebinars_username" id="openwebinars_username" type="text" value="openwebinars_username" class="regular-text" /><br>
                    </td>
                  </tr>
                </table>

                <p>
                  <input class="button-primary" type="submit" name="openwebinars_username_submit" value="<?php esc_attr_e( 'Save' ); ?>" />
                </p>
              </form>
						</div>
						<!-- .inside -->

					</div>
					<!-- .postbox -->
          <div class="postbox">

						<div class="handlediv" title="Click to toggle"><br></div>
						<!-- Toggle -->

						<h2 class="hndle"><span><?php esc_attr_e( 'Most Recent Badges', 'wp_admin_style' ); ?></span>
						</h2>

						<div class="inside">
              <p>Below are your 20 most recent badges.</p>

							<ul class="openwebinars-badges">
								<li>
									<?php for ($i=0; $i < 20; $i++) :?>
									<ul>
										<li>
											<img src="<?php echo $plugin_url . '/images/web-navigator.png'; ?>" width="120px">
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

				</div>
				<!-- .meta-box-sortables .ui-sortable -->

			</div>
			<!-- post-body-content -->

			<!-- sidebar -->
			<div id="postbox-container-1" class="postbox-container">

				<div class="meta-box-sortables">

					<div class="postbox">
						<h3><span>Jose Arcos' Profile</span></h3>
						<div class="inside">
							<p><img src="<?php echo $plugin_url . '/images/profile.png'; ?>" width='100%' class='openwebinars-gravatar' alt="Jose Arcos' Profile"></p>
							<ul class="openwebinars-badges-and-points">
								<li>Badges: <strong>200</strong></li>
								<li>Points: <strong>10000</strong></li>
							</ul>
						</div>
						<!-- .inside -->
					</div>
					<!-- .postbox -->

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
