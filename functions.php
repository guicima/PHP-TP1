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

//Counting system
function incrementFile(string $file): void
{
    $counts = 1;
    if (file_exists($file)) {
        $counts = (int)file_get_contents($file);
        $counts++;
    }
    file_put_contents($file, $counts);
}

function countVisits(): void
{
    //total count
    $counter_file = 'data' . DIRECTORY_SEPARATOR . 'counter';
    //daily count
    $daily_counter_file = $counter_file . '-' . date('Y-m-d');
    incrementFile($counter_file);
    incrementFile($daily_counter_file);
}
function readVisits(): string
{
    return file_get_contents('data' . DIRECTORY_SEPARATOR . 'counter');
}
