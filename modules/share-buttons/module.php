<?php
namespace ElementorPro\Modules\ShareButtons;

use ElementorPro\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Module extends Module_Base {

	private static $networks = [
		'facebook' => [
			'title' => 'Facebook',
			'has_counter' => true,
		],
		'twitter' => [
			'title' => 'Twitter',
		],
		'linkedin' => [
			'title' => 'LinkedIn',
			'has_counter' => true,
		],
		'pinterest' => [
			'title' => 'Pinterest',
			'has_counter' => true,
		],
		'reddit' => [
			'title' => 'Reddit',
			'has_counter' => true,
		],
		'vk' => [
			'title' => 'VK',
			'has_counter' => true,
		],
		'odnoklassniki' => [
			'title' => 'OK',
			'has_counter' => true,
		],
		'tumblr' => [
			'title' => 'Tumblr',
		],
		'digg' => [
			'title' => 'Digg',
		],
		'skype' => [
			'title' => 'Skype',
		],
		'stumbleupon' => [
			'title' => 'StumbleUpon',
			'has_counter' => true,
		],
		'mix' => [
			'title' => 'Mix',
		],
		'telegram' => [
			'title' => 'Telegram',
		],
		'pocket' => [
			'title' => 'Pocket',
			'has_counter' => true,
		],
		'xing' => [
			'title' => 'XING',
			'has_counter' => true,
		],
		'whatsapp' => [
			'title' => 'WhatsApp',
		],
		'email' => [
			'title' => 'Email',
		],
		'print' => [
			'title' => 'Print',
		],
	];

	public static function get_networks( $network_name = null ) {
		// TODO: Remove the class_exists check and move X-twitter and Threads to self::$networks permanently when Elementor 3.22 is released.
		if ( class_exists( 'Elementor\Widget_Share_Buttons' ) ) {
			self::$networks = array_merge( self::$networks, [
				'x-twitter' => [
					'title' => 'X',
				],
				'threads' => [
					'title' => 'Threads',
				],
			] );

			$supported_networks = \Elementor\Widget_Share_Buttons::get_supported_networks();

			self::$networks = array_filter( self::$networks, function( $network_name ) use ( $supported_networks ) {
				return in_array( $network_name, $supported_networks, true );
			}, ARRAY_FILTER_USE_KEY );
		}

		if ( $network_name ) {
			return self::$networks[ $network_name ] ?? null;
		}

		return self::$networks;
	}

	public function get_widgets() {
		return [
			'Share_Buttons',
		];
	}

	public function get_name() {
		return 'share-buttons';
	}

	public function add_localize_data( $settings ) {
		$settings['shareButtonsNetworks'] = self::get_networks();

		return $settings;
	}

	public function __construct() {
		parent::__construct();

		add_filter( 'elementor_pro/frontend/localize_settings', [ $this, 'add_localize_data' ] );

		add_filter( 'elementor_pro/editor/localize_settings', [ $this, 'add_localize_data' ] );
	}
}
