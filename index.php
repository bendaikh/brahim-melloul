<?php

/**
 * Laravel - A PHP Framework For Web Artisans
 * This file serves as the entry point for shared hosting environments
 * where the document root cannot be set to the public folder.
 */

// Redirect to public folder
header('Location: public/');
exit;
