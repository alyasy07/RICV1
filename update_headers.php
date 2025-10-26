<?php
// This is a helper script to update all admin blade files to use the header layout

$files = [
    'c:/laragon/www/FTMSV14/resources/views/Admin/geranpadanan.blade.php',
    'c:/laragon/www/FTMSV14/resources/views/Admin/granindustri.blade.php',
    'c:/laragon/www/FTMSV14/resources/views/Admin/kajiankes.blade.php',
    'c:/laragon/www/FTMSV14/resources/views/Admin/perundingan.blade.php',
    'c:/laragon/www/FTMSV14/resources/views/Admin/moamou.blade.php',
    'c:/laragon/www/FTMSV14/resources/views/Admin/manageUser.blade.php',
    'c:/laragon/www/FTMSV14/resources/views/Admin/manageProfile.blade.php'
];

foreach ($files as $file) {
    $content = file_get_contents($file);
    
    // Pattern to match the navbar section
    $pattern = '/<!-- Topbar -->.*?<!-- Topbar Navbar -->.*?<\/nav>/s';
    $replacement = '@include(\'layouts.header\')';
    
    // Replace the navbar section
    $newContent = preg_replace($pattern, $replacement, $content);
    
    // Write the updated content back to the file
    file_put_contents($file, $newContent);
    
    echo "Updated: $file\n";
}

echo "All files updated successfully!\n";