<?php
final class Appilo_Core
{
    function __construct()
    {
        add_action('elementor/controls/controls_registered', array($this, 'init_controls'), 10);
    }

    //Control
    const LIST_CONTROL = 'appilo_lists_control';
    public function get_multi_list($settings, $tag){
        $feature = $settings;
        if(!empty($feature)){
            $content_decode = json_decode($feature, true);
            foreach ($content_decode as $value) {
                return "<$tag>" .$value['content_list']. "</$tag>";
            }
        }
    }
    //Register Control
    public function init_controls()
    {

        require_once(plugin_dir_path(__FILE__) . 'controls/class-control-list.php');

        $controls_manager = \Elementor\Plugin::$instance->controls_manager;

        $controls_manager->register_control(self::LIST_CONTROL, new Appilo_Lists_Control());
    }
}
new Appilo_Core();

/** Control Sample
$repeater->add_control(
    'd_list',
    [
        'label' => __('Details', 'appilo'),
        'type' => Appilo_Core::LIST_CONTROL,
    ]
);
 *  echo Appilo_Core::get_multi_list($item['d_list'], 'li');
 * */