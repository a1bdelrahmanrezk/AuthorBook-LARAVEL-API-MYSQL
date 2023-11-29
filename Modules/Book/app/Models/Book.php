<?php

namespace Modules\Book\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Author\app\Models\Author;
use Modules\Book\Database\factories\BookFactory;

class Book extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'title'
    ];
    
    public function authors()
    {
        return $this->belongsToMany(
            Author::class,
            'author_book',
            'book_id', // foriegn key of this table [BOOK] 
            'author_id', // foriegn key of another table [AUTHOR]
            'id',  // Primary key of this table [BOOK]
            'id', // Primary key of another table [AUTHOR] 
            'authors' // Name of relation
        );
    }
}
