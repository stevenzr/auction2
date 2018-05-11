<?php

function staticImage($filename) {
    return "http://auction-thesis.herokuapp.com/{$filename}";
}

function clean($string) {
    return preg_replace('/[^a-zA-Z0-9]+/', '-', $string);
}

function formatPrice($price) {
    return number_format($price, 0, '', '.');
}

function formatDate($date) {
    return date('F d, Y H:i a (T)', strtotime($date));
}
