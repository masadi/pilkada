<?php
use Carbon\Carbon;
use Illuminate\Support\Str;
function loggedUser(){
    return auth()->user();
}
function theme_color($name){
    $data = [
        'danger' => "#ea5455",
        'dark' => "#4b4b4b",
        'info' => "#00cfe8",
        'light' => "#f6f6f6",
        'primary' => "#7367f0",
        'secondary' => "#82868b",
        'success' => "#28c76f",
        'warning' => "#ff9f43",
    ];
    return $data[$name];
}
function chartColors($name){
    $data = [
        'primaryColorShade' => '#836AF9',
        'yellowColor' => '#ffe800',
        'successColorShade' => '#28dac6',
        'warningColorShade' => '#ffe802',
        'warningLightColor' => '#FDAC34',
        'infoColorShade' => '#299AFF',
        'greyColor' => '#4F5D70',
        'blueColor' => '#2c9aff',
        'blueLightColor' => '#84D0FF',
        'greyLightColor' => '#EDF1F4',
        'tooltipShadow' => 'rgba(0, 0, 0, 0.25)',
        'lineChartPrimary' => '#666ee8',
        'lineChartDanger' => '#ff4961',
        'labelColor' => '#6e6b7b',
        'grid_line_color' => 'rgba(200, 200, 200, 0.2)',
    ];
    return $data[$name];
}
