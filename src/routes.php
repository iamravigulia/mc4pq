<?php
use Illuminate\Support\Facades\Route;

// Route::get('greeting', function () {
//     return 'Hi, this is your awesome package! mc2pq';
// });

// Route::get('picmatch/test', 'EdgeWizz\Picmatch\Controllers\PicmatchController@test')->name('test');

Route::post('fmt/mc2pq/store', 'EdgeWizz\Mc2pq\Controllers\Mc2pqController@store')->name('fmt.mc2pq.store');

Route::post('fmt/mc2pq/update/{id}', 'EdgeWizz\Mc2pq\Controllers\Mc2pqController@update')->name('fmt.mc2pq.update');

Route::post('fmt/mc2pq/csv_upload', 'EdgeWizz\Mc2pq\Controllers\Mc2pqController@csv_upload')->name('fmt.mc2pq.csv');

Route::any('fmt/mc2pq/delete/{id}', 'EdgeWizz\Mc2pq\Controllers\Mc2pqController@delete')->name('fmt.mc2pq.delete');
