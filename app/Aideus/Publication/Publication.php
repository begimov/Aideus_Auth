<?php

namespace Aideus\Publication;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Publication extends Eloquent
{
    protected $table = 'publications';

    protected $fillable = [
        'authors',
        'title',
        'published_in',
        'pdf_link',
        'web_link',
        'category'
    ];

    public function getAuthors()
    {
        return "{$this->authors}";
    }

    public function getTitle()
    {
        return "{$this->title}";
    }

    public function getPublicationPlace()
    {
        return "{$this->published_in}";
    }

    public function getPdfLink()
    {
        return "{$this->pdf_link}";
    }

    public function getWebLink()
    {
        return "{$this->web_link}";
    }
}
