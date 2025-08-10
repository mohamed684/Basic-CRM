<?php

function e($value) {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function e_html($value) {
    // Allowed TinyMCE tags
    $allowed_tags = '<p><br><b><strong><i><em><u><a><ul><ol><li><img><h1><h2><h3><h4><h5><h6>';

    // Strip out disallowed tags
    $clean = strip_tags($value, $allowed_tags);

    // Remove dangerous attributes like onclick, style, etc.
    $clean = preg_replace('/on\w+="[^"]*"/i', '', $clean); 
    $clean = preg_replace('/javascript:/i', '', $clean);

    return $clean;
}
