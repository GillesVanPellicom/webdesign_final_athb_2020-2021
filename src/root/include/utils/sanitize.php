<?php
function sanitizeString($s): string
{
    return stripslashes(htmlspecialchars(trim($s)));
}