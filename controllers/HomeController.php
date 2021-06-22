<?php
namespace controllers;

use core\Date;
use core\Request;
use core\Controller;
use core\Application;
use request\EventRequest;

/**
 * Home controllers
 */
class HomeController extends Controller
{
    
    public function create()
    {
        return view('form',['post'=>"This is my post"]);

    }


    public function store(Request $request)
    {
        $messages = [];
        $attributes = $request->validate(EventRequest::rules());

        if($attributes){
            $attributes['start'] = Date::getUnixTimeStamp($attributes['start']);
            $attributes['end']   = Date::getUnixTimeStamp($attributes['end']);
            $attributes['description'] = $request->getBody()['description'];

            !Date::isUnique('start',  $attributes['start'])?$request->errors['start'] = 'Already exists ':'';
            !Date::isUnique('end',  $attributes['end'])?$request->errors['end'] = 'Already exists ':'';

            if($request->valid()){
                Application::$app->db->create($attributes);
                $messages['success'] = "Successfully Event Created";
            }
       }
       $messages['errors'] = $request->errors;
       return view('form',$messages);

    }



}
