<?php

use App\Imports\AssetsImport;
use App\Models\AssetUpload;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Maatwebsite\Excel\Facades\Excel;

uses(RefreshDatabase::class);

it('imports assets with valid numeric data', function () {
    $data = [
        1 => 'A001', 2 => 'Test Asset', 8 => 1000.00,
    ];

    $import = new AssetsImport();
    $model = $import->model($data);

    expect($model->asset_no)->toBe('A001');
    expect($model->description)->toBe('Test Asset');
    expect($model->base_price)->toBe('1000.00');
});

it('handles non-numeric base_price by setting to null', function () {
    $data = [
        ['asset_no' => 'A002', 'description' => 'Test Asset', 'base_price' => '=SUM(I3:I591)'],
    ];

    $import = new AssetsImport();
    $model = $import->model($data[0]);

    expect($model->asset_no)->toBe('A002');
    expect($model->description)->toBe('Test Asset');
    expect($model->base_price)->toBeNull();
});

it('handles empty base_price by setting to null', function () {
    $data = [
        1 => 'A003', 2 => 'Test Asset', 8 => '',
    ];

    $import = new AssetsImport();
    $model = $import->model($data);

    expect($model->asset_no)->toBe('A003');
    expect($model->description)->toBe('Test Asset');
    expect($model->base_price)->toBeNull();
});
