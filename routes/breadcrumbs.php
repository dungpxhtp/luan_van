<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

Breadcrumbs::register('home',function($trail){
    $trail->push('Trang Chủ',route('home'));
});
Breadcrumbs::register('gender',function($trail,$name){
    $trail->push($name,route(''));
});
Breadcrumbs::register('detail',function($trail,$gender,$slug){
    $trail->parent('home',$gender,$slug);
    $trail->push($slug,route('productDetail',['slug'=>$slug]));
});
