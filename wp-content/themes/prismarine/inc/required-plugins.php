<?php
/**
 * Protect required plugins by the theme for being deactivated, deleted or edited.
 *
 * @package     bvbj
 * @author      Very LLC - Frontend Software Engineer Esteban Rocha
 * @link        https://verypossible.com/
 * @since       1.0.0
 */

/**
 * λ plugin_action_links => Filters the action links displayed for each plugin in the Plugins list table.
 * apply_filters( 'plugin_action_links', array $actions, string $plugin_file, array $plugin_data, string $context )
 *
 * @param    $actions(array) An array of plugin action links.
 *           By default this can include 'activate', 'deactivate', and 'delete'.
 * @param    $plugin_file(string) Path to the plugin file relative to the plugins directory.
 * @param    $plugin_data(array) An array of plugin data. See get_plugin_data().
 * @param    $context(string) The plugin context. By default this can include
 *           'all', 'active', 'inactive', 'recently_activated', 'upgrade', 'mustuse',
 *           'dropins', and 'search'.
 * @return   array $actions
 */
add_filter( 'plugin_action_links', function( $actions, $plugin_file, $plugin_data, $context ) {
	$essentialPlugins = [
		'advanced-custom-fields-pro/acf.php',
		'classic-editor/classic-editor.php',
		'custom-post-type-ui/custom-post-type-ui.php',
		'wp-cerber/wp-cerber.php',
	];

	// Remove edit link for all plugins
	if ( array_key_exists( 'edit', $actions ) ) {
		unset( $actions['edit'] );
	}

	// Remove deactivate link for important plugins
	if ( array_key_exists( 'deactivate', $actions ) && in_array($plugin_file, $essentialPlugins)) {
		unset( $actions ['deactivate'] );
	}

	// Remove deactivate link for important plugins
	if ( array_key_exists( 'delete', $actions ) && in_array($plugin_file, $essentialPlugins)) {
		unset( $actions ['delete'] );
	}
	return $actions;
}, 10, 4 );

/**
 * λ bulk_actions-{$this->screen->id} => Filters the list table Bulk Actions drop-down.
 * This filter can currently only be used to remove bulk actions.
 *
 * apply_filters( "bulk_actions-{$this->screen->id}", array $actions )
 *
 * @param    $actions(array) An array of the available bulk actions.
 * @return   array $bulk_actionsSelectBox
 */
add_filter( 'bulk_actions-' . 'plugins', function( $bulk_actionsSelectBox ) {
	global $current_user;
	get_currentuserinfo();

	$super_admons = [
		'erocha'
	];

	if ( !in_array($current_user->user_login, $super_admons) ) {
		unset( $bulk_actionsSelectBox ['activate-selected'] );
		unset( $bulk_actionsSelectBox ['deactivate-selected'] );
		unset( $bulk_actionsSelectBox ['delete-selected'] );
		unset( $bulk_actionsSelectBox ['update-selected'] );
	}

	return $bulk_actionsSelectBox;
});
