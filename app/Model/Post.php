<?php

namespace App\Model;

use Carbon\Carbon;

class Post extends Model
{
    public function setSlug($slug)
    {
        $this->attributes['slug'] = 'adasd-dasdsad-dasda';
    }

    
    public function publicationDate($date)
    {
        $this->attributes['publication_date'] = Carbon::now();
    }

}
