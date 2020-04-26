<?php
/**
 * Wds Advance widgets
 */
use \Elementor\Widget_Base;
class Wds_advance_widgets extends Widget_Base {



	/**
	 * Get widget name.
	 */
	public function get_name() {
		return 'Wds_advance_widgets';
	}



	/**
	 * Get widget title.
	 */
	public function get_title() {
		return __( 'Advance widget', 'wds_ele_textdomain' );
	}



	/**
	 * Get widget icon.
	 */
	public function get_icon() {
		return 'fas fa-rocket';
	}



	/**
	 * Get widget categories.
	 */
	public function get_categories() {
		return [ 'basic' ];
	}


	
	/**add Stylesheet  Dependency in weidget */
	public function get_style_depends(){
		return ["wds-widget-css"];
	}



	/**add Javascript Dependency in weidget */
	public function get_script_depends(){
		return ["wds-custom-js"];
	}

// Registert contorls
//start Content paragraph
		protected function _register_controls(){
			$this->start_controls_section(
				'wds-pragraphps',
				[
					'label' => __('Advance Widget','wds_ele_textdomain'),
					'tab' 	=> \Elementor\Controls_Manager::TAB_CONTENT,
				]
			);	
//start Content paragraph title	
			$this->add_control(
				'paragaph_Head',
				[
					'label' => __( 'Heaing', 'plugin-domain' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					
					]
				
			);
//start Content paragraph title	alingment
			$this->add_control(
				'text_align',
				[
					'label' => __( 'Alignment', 'plugin-domain' ),
					'type' => \Elementor\Controls_Manager::CHOOSE,
					'options' => [
						'left' => [
							'title' => __( 'Left', 'plugin-domain' ),
							'icon' => 'fa fa-align-left',
						],
						'center' => [
							'title' => __( 'Center', 'plugin-domain' ),
							'icon' => 'fa fa-align-center',
						],
						'right' => [
							'title' => __( 'Right', 'plugin-domain' ),
							'icon' => 'fa fa-align-right',
						],
					],
					'default' => 'center',
					'toggle' => true,
				]
			);
//start Content paragraph title	Color
			$this->add_control(
				'title_color',
				[
					'label' => __( 'Title Color', 'plugin-domain' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'scheme' => [
						'type' => \Elementor\Scheme_Color::get_type(),
						'value' => \Elementor\Scheme_Color::COLOR_1,
					],
					'selectors' => [
						'{{WRAPPER}} .title' => 'color: {{VALUE}}',
					],
				]
			);

			
		$this->add_control(
			'entrance_animation',
			[
				'label' => __( 'Entrance Animation', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::ANIMATION,
				'prefix_class' => 'animated ',
			]
		);

		$this->add_control(
			'hover_animation',
			[
				'label' => __( 'Hover Animation', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::HOVER_ANIMATION,
				'prefix_class' => 'elementor-animation-',
			]
		);
// Repetar 


$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'list_title', [
				'label' => __( 'Title', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'List Title' , 'plugin-domain' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'list_content', [
				'label' => __( 'Content', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => __( 'List Content' , 'plugin-domain' ),
				'show_label' => false,
			]
		);

		$repeater->add_control(
			'list_color',
			[
				'label' => __( 'Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'color: {{VALUE}}'
				],
			]
		);

		$this->add_control(
			'list',
			[
				'label' => __( 'Repeater List', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'list_title' => __( 'Title #1', 'plugin-domain' ),
						'list_content' => __( 'Item content. Click the edit button to change this text.', 'plugin-domain' ),
					],
					[
						'list_title' => __( 'Title #2', 'plugin-domain' ),
						'list_content' => __( 'Item content. Click the edit button to change this text.', 'plugin-domain' ),
					],
				],
				'title_field' => '{{{ list_title }}}',
			]
		);


		$this->end_controls_section();
		}

		
// register control section end here
//start Render

		protected function render(){
			$settings = $this ->get_settings_for_display();
			echo '<h2 style="text-align:  '.$settings['text_align'].'; color:'.$settings['title_color'].'; ' . $settings['hover_animation'] . ';' . $settings['entrance_animation'] . ';"> '.$settings['paragaph_Head'].' </h2>';
			if ( $settings['list'] ) {
				echo '<dl>';
				foreach (  $settings['list'] as $item ) {
					echo '<dt class="elementor-repeater-item-' . $item['_id'] . '">' . $item['list_title'] . '</dt>';
					echo '<dd>' . $item['list_content'] . '</dd>';
				}
				echo '</dl>';
			}
		}

		protected function _content_template() {
		?>
			<h2  class="title {{ settings.hover_animation }}{{settings.entrance_animation}}" style="text-align: {{ settings.text_align }}; color: {{ settings.title_color }}; {{ settings.entrance_animation }}" > {{ settings.paragaph_Head }}</h2>
		<?php
			
		}
	
		







	}


