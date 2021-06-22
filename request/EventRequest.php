<?php
namespace request;
/**
 * Controller request class
 */
class EventRequest
{
    
    public static function rules()
    {
        return [
            'title'=>['require'],
            'start'=>['require','unique'],
            'start_time'=>['require',['merge','start']],
            'end'=>['require','unique'],
            'end_time'=>['require',['merge','end']],
            'all_day'=>['bool'],
       ];
    }
    
}
