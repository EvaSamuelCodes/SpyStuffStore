<?php

function present($buffer) {
    $html = Pharse::str_get_dom($buffer);
    return Pharse::dom_format($html, array('attributes_case' => CASE_LOWER));
}
