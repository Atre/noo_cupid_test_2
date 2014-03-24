<?php
// Get current dir
$dir = getcwd();

// Get all 'txt' files to array
$files = glob('*.txt');

$resultFileNames = array();
$resultContent = array();

foreach ($files as $f) {
    array_push($resultFileNames, basename($f, '.txt'));
    array_push($resultContent, file_get_contents($f));
}

if (!empty($_POST['filename']) || !empty($_POST['content'])) {

    $filename = trim(filter_input(INPUT_POST, 'filename'));
    $content = trim(filter_input(INPUT_POST, 'content'));

    //TODO '^' only for filename search (?)
    $resNames = @preg_grep('/^' . $filename . '/i', $resultFileNames);
    $resContents = @preg_grep('/' . $content . '/i', $resultContent);

    $html = '';

    if ($filename && $resNames) {
        $html .= 'Search results by file name:<br />';
        foreach ($resNames as $r) {
            $html .= $r . '.txt<br /><br />';
        }
    }

    if ($content && $resContents) {
        $html .= '<hr>';
        $html .= 'Search results by file content:<br/><br/>';
        foreach ($resContents as $k => $r) {
            $html .= $r . '<br/>Source file: ' . $resultFileNames[$k] . '.txt<br/><br/>';
        }
    }

    echo $html;
    exit;
}

include_once('views/form.html');






