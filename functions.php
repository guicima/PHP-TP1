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

function readAndCountByMonth(int $month, int $year): int
{
    $views = 0;
    foreach (glob('data' . DIRECTORY_SEPARATOR . "counter-$year-$month-*") as $file) {
        $views = +file_get_contents($file);
    }
    return $views;
}

function dashboardButtons(array $ensemble, int $parent): string
{
    $result[] = "<div class=\"nav flex-column nav-pills\" id=\"v-pills-tab\" role=\"tablist\" aria-orientation=\"vertical\">";
    foreach ($ensemble as $item) {
        $result[] = "<a class=\"nav-link\" id=\"v-pills-$item$parent-tab\" data-toggle=\"pill\" href=\"#v-pills-$item$parent\" role=\"tab\" aria-controls=\"v-pills-$item$parent\" aria-selected=\"true\">$item $parent</a>";
    }
    $result[] = "</div>";
    return implode($result);
}

function dashboardDisplay(array $ensemble, int $parent): string
{
    //$result[] = "<div class=\"tab-content\" id=\"v-pills-tabContent\">";
    foreach ($ensemble as $key => $item) {
        $key++;
        $result[] = "<div class=\"tab-pane fade\" id=\"v-pills-$item$parent\" role=\"tabpanel\" aria-labelledby=\"v-pills-$item$parent-tab\">Nombre total de visites: " . readVisits() . "</br>Nombre de visites pour le mois de $item $parent: " . readAndCountByMonth($key, $parent) . "</div>";
    }
    //$result[] = "</div>";
    return implode($result);
}

//Prototype
/*function buildDashboard(array $ensemble, int $parent): string
{
    for ($i = $parent; $i > 2015; $i--) {
        $result[] = "<div class=\"nav flex-column nav-pills\" id=\"v-pills-tab\" role=\"tablist\" aria-orientation=\"vertical\"><a class=\"nav-link\" id=\"v-pills-parent$i-tab\" data-toggle=\"pill\" href=\"#v-pills-parent$i\" role=\"tab\" aria-controls=\"v-pills-parent$i\" aria-selected=\"true\">$i</a></div><div class=\"tab-content\" id=\"v-pills-tabContent\"><div class=\"tab-pane fade\" id=\"v-pills-parent$i\" role=\"tabpanel\" aria-labelledby=\"v-pills-parent$i-tab\">";
        $result[] = dashboardButtons($ensemble, $i);
        $result[] = "</div></div>";
        $result[] = dashboardDisplay($ensemble, $i);
    }
    return implode($result);
}*/

function buildDashboard(array $ensemble, int $parent): string
{
    $button[] = "<div class=\"nav flex-column nav-pills\" id=\"v-pills-tab\" role=\"tablist\" aria-orientation=\"vertical\">";
    $result[] = "<div class=\"tab-content\" id=\"v-pills-tabContent\">";
    $display[] = "<div class=\"tab-content\" id=\"v-pills-tabContent\">";
    for ($i = $parent; $i > 2015; $i--) {
        $button[] = "<a class=\"nav-link\" id=\"v-pills-parent$i-tab\" data-toggle=\"pill\" href=\"#v-pills-parent$i\" role=\"tab\" aria-controls=\"v-pills-parent$i\" aria-selected=\"true\">$i</a>";
        $result[] = "<div class=\"tab-pane fade\" id=\"v-pills-parent$i\" role=\"tabpanel\" aria-labelledby=\"v-pills-parent$i-tab\">";
        $result[] = dashboardButtons($ensemble, $i);
        $result[] = "</div>";
        $display[] = dashboardDisplay($ensemble, $i);
    }
    $display[] = "</div>";
    $result[] = "</div>";
    $button[] = "</div>";
    return implode($button) . implode($result) . implode($display);
}
