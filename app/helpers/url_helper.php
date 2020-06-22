<?php
// Simple page redirect
function redirect($page)
{
    header('location: ' . URLROOT . '/' . $page);
}

// Active Links
function active($link)
{
    if (stripos($_SERVER['REQUEST_URI'], $link) !== false && strlen($link) !== 1) {echo 'active';}
}
