<?php

class Billboard_ft extends EE_Fieldtype
{
    public $info = [
        'name'      => 'Billboard',
        'version'   => '1.0.1'
    ];

    public $has_array_data = false;

    public function validate($data)
    {
        return true;
    }

    public function display_field($data)
    {

        $settings = $this->settings['billboard_text_to_display'];
        $el = '<div style="width:100%;">' . $settings . '</div>';

        return $el;
    }

    public function replace_tag($data, $params = '', $tagdata = '')
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
        return ($name == 'channel' || $name == 'grid' || $name == 'bloqs/1');
    }

    public function display_settings($data)
    {
        ee()->load->model('addons_model');

        $format_options = ee()->addons_model->get_plugin_formatting(true);

        $settings = array(
            array(
                'title' => 'Billboard Text',
                'desc' => 'The HTML you want to display in the channel entry form',
                'fields' => array(
                    'billboard_text_to_display' => array(
                        'type' => 'textarea',
                        'value' => (!isset($data['billboard_text_to_display']) || $data['billboard_text_to_display'] == '') ? '' : $data['billboard_text_to_display'],
                        'rows'  => 6,
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

    public function grid_save_settings($data)
    {
        return array_merge($this->save_settings($data), $data);
    }

    public function save_settings($data)
    {
        return [
            'billboard_text_to_display'  => ee()->input->post('billboard_text_to_display')
        ];
    }

    public function update($version)
    {
        return true;
    }
}
