<?php

Route::group(['prefix' => '/v1', 'namespace' => 'Api', 'as' => 'api.'], function () {

    Route::get('region', 'RegionController@getRegionsByOblastId')->name('region.oblastId');
    Route::get('school', 'SchoolController@getSchoolsByRegionId')->name('school.regionId');
    Route::get('grade', 'GradeController@index')->name('grade.index');
});
