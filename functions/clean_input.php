<?php
function clean_input($data)
{
    return htmlspecialchars(trim($data));
}
