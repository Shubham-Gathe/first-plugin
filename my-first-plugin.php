<?php
/**
 * Plugin Name: My First Plugin
 * Description: Adds some content in end of each single post.
 * Version: 1.0
 * Author: Shubham
 * Author URI : shubham.com
*/
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

Class BlogStatsPlugin{
    function __construct(){
        add_action('admin_init',array($this,'settingsOptions'));
        add_action('admin_menu',array($this,'ourSettingsPageLink'));
    }

    function ourSettingsPageLink(){
        add_options_page('Word Count Settings Page','Word Count','manage_options','word-count-settings-page',array($this, 'wordCountHtml'));
    }
    function locationFields(){ 
        ?>
       <select name="wsp_location">
        <option value="0" <?php selected(get_option('wsp_location'),'0'); ?>>Begining of post</option>
        <option value="1" <?php selected(get_option('wsp_location'),'1'); ?>>End of post</option>
       </select>
    <?php }
    function headingFields(){
        ?>
        <input type="text" name="wsp_heading_text" value="<?php echo esc_attr(get_option('wsp_heading_text')); ?>">
    <?php }
    function wordCountFields(){
    ?>
        <input type="checkbox" name="wsp_word_count" value="1" <?php checked(get_option("wsp_word_count"),'1'); ?>>
    <?php }
    function characterCountFields(){
        ?>
        <input type="checkbox" name="wsp_character_count" value="1" <?php checked(get_option('wsp_character_count'),'1') ?>>
    <?php }
    function readCountFields(){
        ?>
        <input type="checkbox" name="wsp_read_time" value='1' <?php checked(get_option('wsp_read_time'),'1'); ?>>
    <?php }
    function settingsOptions(){
        add_settings_section('wsp_first_section',null,null,'word-count-settings-page');

        add_settings_field('wsp_location','Display Location',array($this, 'locationFields'),'word-count-settings-page','wsp_first_section');
        register_setting('pluginsGeneral','wsp_location',array('sanitize_callback' => 'sanitize_text_field','default' => 'end'));
        
        add_settings_field('wsp_heading_text','Heading Text',array($this, 'headingFields'),'word-count-settings-page','wsp_first_section');
        register_setting('pluginsGeneral','wsp_heading_text',array('sanitize_callback' => 'sanitize_text_field','default' => 'Post Statistics'));

        add_settings_field('wsp_word_count','Display Word Count',array($this, 'wordCountFields'),'word-count-settings-page','wsp_first_section');
        register_setting('pluginsGeneral','wsp_word_count',array('sanitize_callback' => 'sanitize_text_field','default' => 'Post Statistics'));

        add_settings_field('wsp_character_count','Display character Count',array($this, 'characterCountFields'),'word-count-settings-page','wsp_first_section');
        register_setting('pluginsGeneral','wsp_character_count',array('sanitize_callback' => 'sanitize_text_field','default' => 'Post Statistics'));

        add_settings_field('wsp_read_time','Display read count',array($this, 'readCountFields'),'word-count-settings-page','wsp_first_section');
        register_setting('pluginsGeneral','wsp_read_time',array('sanitize_callback' => 'sanitize_text_field','default' => 'Post Statistics'));
    }
    function wordCountHtml(){ ?>
        <div class="wrapper-div"> 
            <h1>Word Count Settings</h1>
            <form action="options.php" method='POST'>
                <?php
                settings_fields('pluginsGeneral');  
                do_settings_sections('word-count-settings-page');
                submit_button();
                ?>
            </form>
        </div>
    <?php }
}
$blogStatsPlugin = new BlogStatsPlugin;


