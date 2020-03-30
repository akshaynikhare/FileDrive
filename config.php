<?php
class FileDriveConfig extends PluginConfig
{
    public function getOptions()
    {


        // if (!file_exists(ROOT_DIR."fd/index.php")){
        //         die("<br>FD Dir do not exist<br>");
        // }
     /*   $_configs['FileDrive_root'] = new TextboxField(
            [
                'configuration' => array('size' => 60, 'length' => 255),
                'required' => true,
                'label' => __('Root path'),
                'default' => 'fd/DirRoot',
                'hint' => __('Enter the path of root folder'),
            ]);

        $_configs['FileDrive_lang'] = new ChoiceField(
            [
                'configuration' => array('size' => 60, 'length' => 255),
                'required' => true,
                'label' => __('Language'),
                'hint' => __('Language'),
                'default' => 'en',
                'choices' => [
                    'en' => 'English',

                ],
            ]);
            */
        $_configs['FileDrive_Admin_enable'] = new BooleanField(
            [
                'label' => __('Admin panel'),
                'default' => '1',
                'hint' => __('Enable in Admin panel'),
            ]);
        $_configs['FileDrive_Staff_enable'] = new BooleanField(
            [
                'label' => __('staff panel'),
                'default' => '1',
                'hint' => __('Enable in staff panel'),
            ]);

        $_configs['FileDrive_client_enable'] = new BooleanField(
            [
                'label' => __('client panel'),
                'default' => '1',
                'hint' => __('Enable in client panel'),
            ]);
        $_configs['FileDrive_guest_enable'] = new BooleanField(
            [
                'label' => __('Guest panel'),
                'default' => '1',
                'hint' => __('Enable in guest panel'),
            ]);
/*
        $_configs['FileDrive_show_hidden'] = new BooleanField(
            [
                'label' => __('Hidden Files'),
                'default' => '1',
                'hint' => __('Show Hidden Files'),
            ]);
        $_configs['FileDrive_error_reporting'] = new BooleanField(
            [
                'label' => __('error reporting'),
                'default' => '1',
                'hint' => __('Enable error reporting'),
            ]);
        $_configs['FileDrive_hide_Cols'] = new BooleanField(
            [
                'label' => __('hide Cols'),
                'default' => '1',
                'hint' => __('Enable in atribute preiview in File Browser'),
            ]);
        $_configs['FileDrive_calc_folder'] = new BooleanField(
            [
                'label' => __('Calc folder Size'),
                'default' => '1',
                'hint' => __('calculate folder size when browsing folders'),
            ]);
*/
   
        return $_configs;
    }

/// A chance to check the settings before saving
    public function pre_save(&$config, &$errors)
    {
        global $msg;
/*
        if ($config['FileDrive_root'] === "") {
            // Validate the settings ?
            $errors['err'] = 'Root path can not be Empty'; // example only
            return false;
        } elseif (!is_dir(dirname(__file__) . $config['FileDrive_root'])) {
            $errors['err'] = 'Root Directory ( ' .dirname(__file__) .  $config['FileDrive_root'] . ' ) does not exist.'; // example only
            return false;
        }
*/
        if (!$errors) {
            $msg = 'Configuration updated successfully'; // This is the default, and doesn't need to be set.
        }

        return true;
    }
}
