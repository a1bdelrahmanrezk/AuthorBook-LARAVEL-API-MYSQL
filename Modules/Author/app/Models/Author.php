<?php

namespace Modules\Author\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Author\Database\factories\AuthorFactory;
use Modules\Book\app\Models\Book;

class Author extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
    ];
    
    public function books(){
        return $this->belongsToMany(
            Book::class,
            'author_book',
            'author_id',
            'book_id',
            'id',
            'id',
            'books',
        );
    }
}
