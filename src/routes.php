<?php
use Illuminate\Support\Facades\Route;

// Route::get('greeting', function () {
//     return 'Hi, this is your awesome package! mc4pq';
// });

// Route::get('picmatch/test', 'EdgeWizz\Picmatch\Controllers\PicmatchController@test')->name('test');

Route::post('fmt/mc4pq/store', 'EdgeWizz\Mc4pq\Controllers\Mc4pqController@store')->name('fmt.mc4pq.store');

Route::post('fmt/mc4pq/update/{id}', 'EdgeWizz\Mc4pq\Controllers\Mc4pqController@update')->name('fmt.mc4pq.update');

Route::post('fmt/mc4pq/csv_upload', 'EdgeWizz\Mc4pq\Controllers\Mc4pqController@csv_upload')->name('fmt.mc4pq.csv');

Route::any('fmt/mc4pq/delete/{id}', 'EdgeWizz\Mc4pq\Controllers\Mc4pqController@delete')->name('fmt.mc4pq.delete');
