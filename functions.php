<?php
function createNavbar(array $navbar_items, string $currentpage): string
{

    foreach ($navbar_items as $navbar_item => $url) {
        if ($currentpage === $navbar_item) {
            $active = 'active';
        } else {
            $active = '';
        }
        $menu[] = "<a class=\"nav-item nav-link $active\" href=\"$url\">$navbar_item</a>";
    }
    return implode($menu);
}

function countVisits()
{
    $counter_file = 'data' . DIRECTORY_SEPARATOR . 'counter.txt';
    if (file_exists($counter_file)) {
        $counts = (int)file_get_contents($counter_file);
        $counts++;
        file_put_contents($counter_file, $counts);
    } else {
        file_put_contents($counter_file, '1');
    }
}
