<?php

/**
 * Textarea Fieldtype
 */
class Billboard_ft extends EE_Fieldtype {

	var $info = array(
		'name'		=> 'Billboard',
		'version'	=> '1.0.0'
	);

	var $has_array_data = false;

	function validate($data)
	{

		return TRUE;

	}

	function display_field($data)
	{

		$settings = $this->settings['billboard_text_to_display'];

		// $params = array(
		// 	'name'     	=> $this->name(),
		// 	'value'    	=> $settings,
		// 	'rows'     	=> 6,
		// 	'disabled'	=> 'disabled',
		// 	'style'		=> ''
		// );

		$el = '<div style="width:100%;">' . $settings . '</div>';

		return $el;
	}

	function replace_tag($data, $params = '', $tagdata = '')
	{
		return null;
	}

	/**
	 * Accept all content types.
	 *
	 * @param string  The name of the content type
	 * @param bool    Accepts all content types
	 */
	public function accepts_content_type($name)
	{
		return true;
	}

	function display_settings($data)
	{

		ee()->load->model('addons_model');

		$format_options = ee()->addons_model->get_plugin_formatting(TRUE);

		$settings = array(
			array(
				'title' => 'Billboard Text',
				'desc' => 'The HTML you want to display in the channel entry form',
				'fields' => array(
					'billboard_text_to_display' => array(
						'type' => 'textarea',
						'value' => ( ! isset($data['billboard_text_to_display']) OR $data['billboard_text_to_display'] == '') ? '' : $data['billboard_text_to_display'],
						'rows'	=> 6,
					)
				)
			)
		);

		return array('field_options_billboard' => array(
			'label' => 'field_options',
			'group' => 'billboard',
			'settings' => $settings
		));
	}

	function grid_save_settings($data)
	{
		return array_merge($this->save_settings($data), $data);
	}

	function save_settings($data)
	{

		return array(
	        'billboard_text_to_display'  => ee()->input->post('billboard_text_to_display')
	    );

	}

	public function update($version)
	{
		return true;
	}

}