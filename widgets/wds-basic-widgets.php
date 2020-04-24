<?php
/**
 * Wds Basic widgets
 */
use \Elementor\Widget_Base;
class Wds_Basic_widgets extends Widget_Base {



	/**
	 * Get widget name.
	 */
	public function get_name() {
		return 'Wds_Basic_widget';
	}



	/**
	 * Get widget title.
	 */
	public function get_title() {
		return __( 'Basic widget', 'wds_ele_textdomain' );
	}



	/**
	 * Get widget icon.
	 */
	public function get_icon() {
		return 'fa fa-battery-three-quarters';
	}



	/**
	 * Get widget categories.
	 */
	public function get_categories() {
		return [ 'wds-custom-cat' ];
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
			 'wds-pragraphp',
			 [
				 'label' => __('Cwm paragaraph','wds_ele_textdomain'),
				 'tab' 	=> \Elementor\Controls_Manager::TAB_CONTENT,
			 ]
		 );		
//Content paragraph---> Heading
		 $this->add_control(
			 'wds-par-title',
			 [
				 'label' => __('Heading','wds_ele_textdomain'),
				 'type' => \Elementor\Controls_Manager::TEXT,
				 'label_block' => true,
			 ]
		 );	 

		 $this->add_control(
			'border_style',
			[
				'label' => __( 'Border Style', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'solid',
				'options' => [
					'solid'  => __( 'Solid', 'plugin-domain' ),
					'dashed' => __( 'Dashed', 'plugin-domain' ),
					'dotted' => __( 'Dotted', 'plugin-domain' ),
					'double' => __( 'Double', 'plugin-domain' ),
					'none' => __( 'None', 'plugin-domain' ),
				],
			]
		);


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




//Content paragraph---> WYSIWYG
		$this->add_control(
			'paragraph-text-area',
			[
				'label' => __('Content','wds_ele_textdomain'),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
			]
		);
	
	   $this->end_controls_section();







//start content Image secton
		$this->start_controls_section(
			'wds-imag',
			[
				'label' => __('Cwm Image','wds_ele_textdomain'),
				'tab' 	=> \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		
//add swithcher For Content Image Title
	   $this->add_control(
		   'wds-switch',
		   [
		   'label' => __('hide or show paragaraph','wds_ele_textdomain'),
		   'type' 	=> \Elementor\Controls_Manager::SWITCHER,
		   'label_on' => __( 'Show', 'your-plugin' ),
			'label_off' => __( 'Hide', 'your-plugin' ),
			'return_value' => 'yes',
			'default' => 'yes',
		   ]
	   );

	   $this->add_control(
		'show_elements',
		[
			'label' => __( 'Show Elements', 'plugin-domain' ),
			'type' => \Elementor\Controls_Manager::SELECT2,
			'multiple' => true,
			'options' => [
				'title'  => __( 'Title', 'plugin-domain' ),
				'description' => __( 'Description', 'plugin-domain' ),
				'button' => __( 'Button', 'plugin-domain' ),
				'image' => __( 'image', 'plugin-domain' ),
			],
			'default' => [ 'title', 'description' ],
		]
	);






//add content Image secton image title
	   $this->add_control(
		'wds-img',
		[
		'label' => __('imgs','wds_ele_textdomain'),
		'type' 	=> \Elementor\Controls_Manager::GALLERY,
		]
	);


	//add content Image secton image title
	$this->add_control(
		'wds-img-title',
		[
		'label' => __('Image Title','wds_ele_textdomain'),
		'type' 	=> \Elementor\Controls_Manager::TEXT,
		]
	);


	 $this->end_controls_section();
//start styel secton
		$this->start_controls_section(
			'wds-style-section',
			[
			'label' => __('STT','wds_ele_textdomain'),
						'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
			);
		$this->end_controls_section();
		}
//End Register control section

//start render

	protected function render(){
		$setting = $this->get_settings_for_display();
		if ( 'yes' === $setting['wds-switch'] ) {
			echo '<h2>' . $setting['wds-img-title'] . '</h2>';
		}
		?>	
		<h1 style="border:<?php echo $setting['border_style'];?>; color:<?php echo $setting['title_color'];?>; ?>"><?php echo $setting['wds-par-title'];?></h1>			
	<?php

		foreach ($setting['show_elements'] as $show_elements){
			echo $show_elements.'</br>';
		}

	}






}