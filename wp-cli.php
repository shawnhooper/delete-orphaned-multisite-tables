<?php
/**
 * Finds and delete orphaned tables in a WordPress Multisite network.
 */
class SMH_WPCLI_Clean_MultisiteDB extends WP_CLI_Command {

	/**
	 * List orphaned tables
	 *
	 * @subcommand list
	 */
	function list_orphaned_tables( $args, $assoc_args ) {

		$orphanTables = $this->get_orphan_tables();

		$formatter = new \WP_CLI\Formatter( $assoc_args, array('Orphaned Table Name') );
		$formatter->display_items( $orphanTables );

		// Print a success message
		WP_CLI::success( sprintf("Found %d orphaned tables in the database.", count($orphanTables)) );

	}

	/*
	 * @synopsis [--force]
	 */
	function delete($args, $assoc_args) {
		if (!isset($assoc_args['force'])) {
			WP_CLI::error('Use the --force');
			return;
		}

		$orphanTables = $this->get_orphan_tables();

		if (count($orphanTables) == 0 ) {
			WP_CLI::success('No orphan tables were found');
			return;
		}

		global $wpdb;
		$i = 0;
		foreach ($orphanTables as $tableName) {
			$tableName = $tableName['Orphaned Table Name'];

			$result = $wpdb->query('DROP TABLE ' . $tableName);

			if ($result === false ) {
				WP_CLI::error('Could not drop table ' . $tableName . ' - ' . $wpdb->last_error);
				continue;
			}

			WP_CLI::success('Dropped Table ' . $tableName);
			$i++;
		}
		WP_CLI::success('Dropped ' . $i . ' orphaned tables.');

	}

	private function get_orphan_tables() {
		global $wpdb;

		$orphanTables = [];
		$allTables = $wpdb->get_col("SHOW TABLES");
		$sites = $wpdb->get_col("SELECT blog_id FROM " . $wpdb->prefix . "blogs");

		foreach ($allTables as $tableName) {
			if (! preg_match('/^' . $wpdb->prefix . '([0-9]+)[_](.+)/', $tableName)) continue;

			if (!in_array( $this->get_number_from_table_name($tableName) , $sites)) {
				array_push($orphanTables, array('Orphaned Table Name' => $tableName));
			}
		}

		return $orphanTables;
	}

	private function get_number_from_table_name($tableName) {
		global $wpdb;
		$noPrefix = preg_replace('/^' . $wpdb->prefix . '/', '', $tableName);
		return (int)substr($noPrefix, 0, strpos($noPrefix, '_'));
	}


}
WP_CLI::add_command( 'multisite-db', 'SMH_WPCLI_Clean_MultisiteDB' );
