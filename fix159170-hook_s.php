<?php
/**
 * Plugin Name:     Fixonweb hook_s
 * Plugin URI:      https://fixonweb.com.br/plugin/fix159170-hook_s
 * Description:     Ref: 159170 - Altera o comportamento padrão de busca do wordpress
 * Author:          FIXONWEB
 * Author URI:      https://fixonweb.com.br
 * Text Domain:     fix159170
 * Domain Path:     /languages
 * Version:         0.1.5
 *
 * @package         Fix159170
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

require 'plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker('https://github.com/fixonweb/fix159170-hook_s',__FILE__, 'fix159154-search/fix159170-hook_s');

add_filter( 'posts_where' , 'fix159170_posts_where' );
function fix159170_posts_where( $where ) {
	$busca = isset($_GET['s']) ? $_GET['s'] : '';
	if($busca){
		$where = '';
		$where .= " 
			AND
			(
				post_title LIKE '$busca %' 
				or post_title LIKE '$busca' 
				or post_title LIKE '% $busca %' 
				or post_title LIKE '% $busca' 
				or post_title LIKE '% $busca.'	
			)
			AND post_status = 'publish'

		";
	}
	
	return $where;
}

