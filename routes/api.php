<?php

Route::group(['prefix' => '/v1', 'namespace' => 'Api', 'as' => 'api.'], function () {
    Route::get('student', 'UserController@index')->name('students.index');
    Route::get('student-by-school-and-grade', 'UserController@schoolIdGradeId')->name('students.schoolIdGradeId');
    Route::get('regions', 'RegionController@getRegionsByOblastId')->name('region.oblastId');
    Route::get('region', 'RegionController@index')->name('region.index');
    Route::get('oblast', 'OblastController@index')->name('oblast.index');
    Route::get('schools', 'SchoolController@getSchoolsByRegionId')->name('school.regionId');
    Route::get('school', 'SchoolController@index')->name('school.index');
    Route::get('grade', 'GradeController@index')->name('grade.index');
});
