<?php


Route::get('/', function () {
    return view('welcome');
});


/////////////////////////
/////// ADMIN PANEL 
///////////////// // // // // 

              ////////////////// Proudct Controller ///////////////
              Route::post('proudct/store','ADMIN\proudctController@store');
              Route::get('proudct/index','ADMIN\proudctController@index');
              Route::get('proudct/show/{id}','ADMIN\proudctController@show');
              Route::post('proudct/update/{id}','ADMIN\proudctController@update');
              Route::post('proudct/updateImage/{id}','ADMIN\proudctController@updateImage');
              Route::post('proudct/moreImage/{id}','ADMIN\proudctController@moreImage');
              Route::get('proudct/deleteImage/{id}','ADMIN\proudctController@deleteImage');
              Route::get('proudct/destroy/{id}','ADMIN\proudctController@destroy');