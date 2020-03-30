<?php

/**
 * Show image
 * @param string $img
 */
function fm_show_image($img)
{
    $modified_time = gmdate('D, d M Y 00:00:00') . ' GMT';
    $expires_time = gmdate('D, d M Y 00:00:00', strtotime('+1 day')) . ' GMT';

    $img = trim($img);
    $images = fm_get_images();
    $image = 'iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAEElEQVR42mL4//8/A0CAAQAI/AL+26JNFgAAAABJRU5ErkJggg==';
    if (isset($images[$img])) {
        $image = $images[$img];
    }
    $image = base64_decode($image);
    if (function_exists('mb_strlen')) {
        $size = mb_strlen($image, '8bit');
    } else {
        $size = strlen($image);
    }

    if (function_exists('header_remove')) {
        header_remove('Cache-Control');
        header_remove('Pragma');
    } else {
        header('Cache-Control:');
        header('Pragma:');
    }

    header('Last-Modified: ' . $modified_time, true, 200);
    header('Expires: ' . $expires_time);
    header('Content-Length: ' . $size);
    header('Content-Type: image/png');
    echo $image;

    exit;
}


/**
 * Language Translation System
 * @param string $txt
 * @return string
 */
function lng($txt) {
    global $lang;

    // English Language
    $tr['en']['AppName']        = 'Tiny File Manager';      $tr['en']['AppTitle']           = 'File Manager';
    $tr['en']['Login']          = 'Sign in';                $tr['en']['Username']           = 'Username';
    $tr['en']['Password']       = 'Password';               $tr['en']['Logout']             = 'Sign Out';
    $tr['en']['Move']           = 'Move';                   $tr['en']['Copy']               = 'Copy';
    $tr['en']['Save']           = 'Save';                   $tr['en']['SelectAll']          = 'Select all';
    $tr['en']['UnSelectAll']    = 'Unselect all';           $tr['en']['File']               = 'File';
    $tr['en']['Back']           = 'Back';                   $tr['en']['Size']               = 'Size';
    $tr['en']['Perms']          = 'Perms';                  $tr['en']['Modified']           = 'Modified';
    $tr['en']['Owner']          = 'Owner';                  $tr['en']['Search']             = 'Search';
    $tr['en']['NewItem']        = 'New Item';               $tr['en']['Folder']             = 'Folder';
    $tr['en']['Delete']         = 'Delete';                 $tr['en']['Rename']             = 'Rename';
    $tr['en']['CopyTo']         = 'Copy to';                $tr['en']['DirectLink']         = 'Direct link';
    $tr['en']['UploadingFiles'] = 'Upload Files';           $tr['en']['ChangePermissions']  = 'Change Permissions';
    $tr['en']['Copying']        = 'Copying';                $tr['en']['CreateNewItem']      = 'Create New Item';
    $tr['en']['Name']           = 'Name';                   $tr['en']['AdvancedEditor']     = 'Advanced Editor';
    $tr['en']['RememberMe']     = 'Remember Me';            $tr['en']['Actions']            = 'Actions';
    $tr['en']['Upload']         = 'Upload';                 $tr['en']['Cancel']             = 'Cancel';
    $tr['en']['InvertSelection']= 'Invert Selection';       $tr['en']['DestinationFolder']  = 'Destination Folder';
    $tr['en']['ItemType']       = 'Item Type';              $tr['en']['ItemName']           = 'Item Name';
    $tr['en']['CreateNow']      = 'Create Now';             $tr['en']['Download']           = 'Download';
    $tr['en']['Open']           = 'Open';                   $tr['en']['UnZip']              = 'UnZip';
    $tr['en']['UnZipToFolder']  = 'UnZip to folder';        $tr['en']['Edit']               = 'Edit';
    $tr['en']['NormalEditor']   = 'Normal Editor';          $tr['en']['BackUp']             = 'Back Up';
    $tr['en']['SourceFolder']   = 'Source Folder';          $tr['en']['Files']              = 'Files';
    $tr['en']['Move']           = 'Move';                   $tr['en']['Change']             = 'Change';
    $tr['en']['Settings']       = 'Settings';               $tr['en']['Language']           = 'Language';
    $tr['en']['MemoryUsed']     = 'Memory used';            $tr['en']['PartitionSize']      = 'Partition size';
    $tr['en']['ErrorReporting'] = 'Error Reporting';        $tr['en']['ShowHiddenFiles']    = 'Show Hidden Files';
    $tr['en']['Full size'] 		= 'Full size';				$tr['en']['Help'] 				= 'Help';
    $tr['en']['Free of'] 		= 'Free of';				$tr['en']['Preview'] 			= 'Preview';
	$tr['en']['Help Documents'] = 'Help Documents';			$tr['en']['Report Issue']		= 'Report Issue';
    $tr['en']['Generate'] 		= 'Generate';				$tr['en']['FullSize']           = 'Full Size';
    $tr['en']['FreeOf']         = 'free of';                $tr['en']['CalculateFolderSize']= 'Calculate folder size';
    $tr['en']['ProcessID']      = 'Process ID';
    $tr['en']['HideColumns']    = 'Hide Perms/Owner columns';
    $tr['en']['Check Latest Version']= 'Check Latest Version'; $tr['en']['Generate new password hash'] = 'Generate new password hash';

    $i18n = fm_get_translations($tr);
    $tr = $i18n ? $i18n : $tr;

    if (!strlen($lang)) $lang = 'en';
    if (isset($tr[$lang][$txt])) return fm_enc($tr[$lang][$txt]);
    else if (isset($tr['en'][$txt])) return fm_enc($tr['en'][$txt]);
    else return "$txt";
}

/**
 * Get base64-encoded images
 * @return array
 */
function fm_get_images()
{
    return array(
        'favicon' => 'Qk04AgAAAAAAADYAAAAoAAAAEAAAABAAAAABABAAAAAAAAICAAASCwAAEgsAAAAAAAAAAAAAIQQhBCEEIQQhBCEEIQQhBCEEIQ
        QhBCEEIQQhBCEEIQQhBCEEIQQhBHNO3n/ef95/vXetNSEEIQQhBCEEIQQhBCEEIQQhBCEEc07ef95/3n/ef95/1lohBCEEIQQhBCEEIQQhBCEEIQ
        RzTt5/3n8hBDFG3n/efyEEIQQhBCEEIQQhBCEEIQQhBHNO3n/efyEEMUbef95/IQQhBCEEIQQhBCEEIQQhBCEErTVzTnNOIQQxRt5/3n8hBCEEIQ
        QhBCEEIQQhBCEEIQQhBCEEIQQhBDFG3n/efyEEIQQhBCEEIQQhBCEEIQQhBCEEIQQxRt5/3n+cc2stIQQhBCEEIQQhBCEEIQQhBCEEIQQIIZxz3n
        /ef5xzay0hBCEEIQQhBCEEIQQhBCEEIQQhBCEEIQQhBDFG3n/efyEEIQQhBCEEIQQhBCEEIQQhBK01c05zTiEEMUbef95/IQQhBCEEIQQhBCEEIQ
        QhBCEEc07ef95/IQQxRt5/3n8hBCEEIQQhBCEEIQQhBCEEIQRzTt5/3n8hBDFG3n/efyEEIQQhBCEEIQQhBCEEIQQhBKUUOWfef95/3n/ef95/IQ
        QhBCEEIQQhBCEEIQQhBCEEIQQhBJRW3n/ef95/3n8hBCEEIQQhBCEEIQQhBCEEIQQhBCEEIQQhBCEEIQQhBCEEIQQhBCEEIQQAAA=='
    );
}
?>