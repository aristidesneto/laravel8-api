<?php

if (!function_exists('validateCpf')) {
    function validateCpf ($value)
    {
        return str_replace('.', '', str_replace('-', '', trim($value)));
    }
}
