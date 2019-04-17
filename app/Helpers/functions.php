<?php

function assets_v()
{
    return basename(base_path());
}

function pre(...$what)
{
    echo "<pre>";
    array_map('print_r', $what);
    echo "</pre>";

    die;
}
