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

function useless_condition ( $where ) { return $where . ' AND 1=1 '; }

add_filter( 'posts_where' , 'fix159170_posts_where' );
function fix159170_posts_where( $where ) {
	// global $query;
	$busca = isset($_GET['s']) ? $_GET['s'] : '';
	if($busca){
		// wp_reset_query();
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
		// remove_all_actions ( '__after_loop');
		// echo $where;
	}
	
	return $where;
}

/*

AND 
( 
	post_title LIKE 'Movimente-se %' 
	or post_title LIKE '% Movimente-se %' 
	or post_title LIKE '% Movimente-se' 
	or post_title LIKE '% Movimente-se.' 
) 
AND 
( 
	post_title LIKE 'Movimente-se %' 
	or post_title LIKE '% Movimente-se %' 
	or post_title LIKE '% Movimente-se' 
	or post_title LIKE '% Movimente-se.' 
)




AND 
(
	(
		(wp_posts.post_title LIKE '{7aefc694b9dcb33fec06f4bed248c0aa85e54c689f4b66843c89e4bdad8b73bf}Movimente-se{7aefc694b9dcb33fec06f4bed248c0aa85e54c689f4b66843c89e4bdad8b73bf}')

		OR (
		wp_posts.post_excerpt LIKE '{7aefc694b9dcb33fec06f4bed248c0aa85e54c689f4b66843c89e4bdad8b73bf}Movimente-se{7aefc694b9dcb33fec06f4bed248c0aa85e54c689f4b66843c89e4bdad8b73bf}'
		) 
		OR (
		wp_posts.post_content LIKE '{7aefc694b9dcb33fec06f4bed248c0aa85e54c689f4b66843c89e4bdad8b73bf}Movimente-se{7aefc694b9dcb33fec06f4bed248c0aa85e54c689f4b66843c89e4bdad8b73bf}'
		)
	)
) 
AND 
(
	wp_posts.post_password = ''
) 
AND 
wp_posts.post_type IN ('post', 'page', 'attachment', 'meu_espaco') 
AND (wp_posts.post_status = 'publish') 
AND wp_posts.post_type = 'elementor_font' 
AND (wp_posts.post_status = 'publish')

*/