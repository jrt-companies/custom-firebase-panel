<?php
     // Get customizeJson
    $customizeJsonPath = '../customize.json';
    $customizeJsonContent = file_get_contents($customizeJsonPath);
    $customizeJson = json_decode($customizeJsonContent, true);

    // Important JSON values
    $startTap = $customizeJson['panel']['startTabArray'];

    // Get customizeJson values to create HTML parts
        // seoCrawl
        $seoCrawl = '';
        if ($customizeJson['seo']['crawl']) {$seoCrawl='index,follow,noarchive';}
        // panelTabs
        $panelTabs = "";
        foreach ($customizeJson['panel']['tabs'] as $tab) {
            $panelTabs .= '<a onclick="window.alert('."'Feature Update Soon'".');"><i class="far '.$tab['faIcon'].'"></i> '.$tab['title'].'</a>';
        }
        // panelSupport
        $panelSupport = "";
        if(isset($customizeJson['panel']['support'])) {
            $panelSupport = '
            <div class="more">
            <a href="'.$customizeJson['panel']['support'].'">'.$customizeJson['panel']['supportName'].'</a>
            </div>';
        }
        // panelTableColumns
        $panelTableColumns = "";
        foreach ($customizeJson['panel']['table']['columns'] as $column) {
            $panelTableColumns .= '<th>'.$column['title'].'</th>';
        }
        // fillTableDocs
        $fillTableDocs = "";
        foreach ($customizeJson['panel']['table']['columns'] as $column) {
            $fillTableDocs.="doc.data()['".$column['docData']."'],";
        }
        substr($fillTableDocs, 0, -1);
        // panelStarttabTitle
        $panelStarttabTitle = $customizeJson['panel']['tabs'][$startTap]['title'];
        // panelStarttabIcon
        $panelStarttabIcon = $customizeJson['panel']['tabs'][$startTap]['faIcon'];
        // panelStarttabDb
        $panelStarttabDb = $customizeJson['panel']['tabs'][$startTap]['db'];

    // Build  htmlTemplate
    $htmlTemplate = file_get_contents('template.txt');
    $htmlTemplate = str_replace([
        "{{SEO_TITLE}}",
        "{{SEO_DESC}}",
        "{{SEO_CRAWL}}",
        "{{STYLE_COLOR_PRIMARY}}",
        "{{STYLE_COLOR_PRIMARYLIGHT}}",
        "{{PANEL_NAME}}",
        "{{PANEL_TABS}}",
        "{{PANEL_SUPPORT}}",
        "{{PANEL_STARTTAB_ICON}}",
        "{{PANEL_STARTTAB_TITLE}}",
        "{{PANEL_TABLE_COLUMNS}}",
        "{{FIREBASE_APIKEY}}",
        "{{FIREBASE_AUTHDOMAIN}}",
        "{{FIREBASE_PROJECTID}}",
        "{{PANEL_STARTTAB_DB}}",
        "{{PANEL_COLUMN_DOCS}}"
    ],[
        $customizeJson['seo']['title'],
        $customizeJson['seo']['desc'],
        $seoCrawl,
        $customizeJson['style']['colors']['primary'],
        $customizeJson['style']['colors']['primaryLight'],
        $customizeJson['panel']['name'],
        $panelTabs,
        $panelSupport,
        $panelStarttabIcon,
        $panelStarttabTitle,
        $panelTableColumns,
        $customizeJson['firebase']['apiKey'],
        $customizeJson['firebase']['authDomain'],
        $customizeJson['firebase']['projectId'],
        $panelStarttabDb,
        $fillTableDocs
    ], $htmlTemplate);

    // test if writing on folder is possible
    $filename = '../export';
    if (!is_writable($filename)) {echo 'Please ensure, that writing is possible in the "export" folder!';die;}
    // Create temporary HTML file
    file_put_contents('tmp.html', $htmlTemplate);
    // Define documents for ZIP file
    $files = ['tmp.html', '../page.js', '../page.css', '../assets/docs/css/main/get.css'];

    // Creation of ZIP
    // is it possible to create one?
    if(!extension_loaded('zip')) {echo "ZIP extension missing";die;}
    // initialize zip archive
    $zip = new ZipArchive();
    // select a zip name
    $zipName = "custom-firebase-panel | export.zip";
    // has zip creation failed?
    if($zip->open($zipName, ZIPARCHIVE::CREATE)==false) { echo "ZIP creation failed";die;}
    // fill zip
    foreach($files as $file) {
        // rename tml.html to index.html
        if($file=='tmp.html'){ $zip->addFile($file,'index.html');}
        // or add file
        else {$zip->addFile($file);}
    }  
    // exit the zip
    $zip->close();
    // download zip
    header('Content-type: application/zip');  
    header('Content-Disposition: attachment; filename="'.$zipName.'"');  
    readfile($zipName);  
    // remove tmp files
    unlink($zipName);  
    unlink('tmp.html');
 ?>