<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;


class Note extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'note';
    protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = ['name','college_name','course','semester','files'];
    // protected $hidden = [];
    // protected $dates = [];
    protected $casts=[
        'files' => 'array',
    ];
    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public static function boot()
    {
        parent::boot();
        
        static::deleting(function($obj) {
            if (count((array)$obj->files)) {
                foreach ($obj->files as $file_path) {
                    Storage::disk('public')->delete($file_path);
                }
            }
        });
    }
    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
    public function setFilesAttribute($data)
    {
        $attribute_name = "files";
        $disk = "public";
        $name=$this->name;
        $college=$this->college_name;
        $course=$this->course;
        $semester=$this->semester;
        // dd([$college,$course,$semester,$name]);
        $destination_path = '/'.$college.'/'.$course.'/'.$semester.'/'.$name."/pdfs";
        $this->uploadMultipleFilesToDisk($data, $attribute_name, $disk, $destination_path);
    }
}
