<?php
/**
 * set default value to given array if !isset
 * !isset example : undefined or null
 */
function array_default($originalArray, $defaultArray)
{
    foreach ($defaultArray as $key => $value) {
        if (!isset($originalArray[$key])) {
            $originalArray[$key] = $value;
        }
    }
    return $originalArray;
}

// Generate links to sort columns
function sort_by($column, $title, $param_id = null)
{
    $icon = '';
    $order = (\Request::get('order') == 'asc') ? 'desc' : 'asc';

    if (\Request::has('sortBy') && \Request::get('sortBy') === $column) {
        $icon = (\Request::get('order') == 'asc') ? 'long arrow up' : 'long arrow down';
    }

    $params = ['sortBy' => $column, 'order' => $order]+\Request::except('sortBy', 'order');

    if ($param_id) {
        $params = ['id' => $param_id] + $params;
    }

    $url = url()->current() . '/?' . http_build_query($params);

    return
        '<a href="' . $url . '">
            ' . $title . '
            <i class="' . $icon . ' mini icon"></i>
        </a>';
}

/**
 * Convert minutes to hours minutes
 */
function mins2HrsMins($time) {
    if ($time < 1) {
        return;
    }
    $hours = floor($time / 60);
    $minutes = ($time % 60);
    $format = '%d hrs %d mins';
    return sprintf($format, $hours, $minutes);
}


/**
 * Facades return Prefixer to Add prefix to ID
 */
function prefix()
{
    return  app(\App\Services\Prefixer::class);
}