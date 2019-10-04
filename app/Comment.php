<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'comment'];


    /**
     * The function reiceves parameters, store on the database and returns the comment.
     *
     * @param $input
     * @param $user
     * @return Comment
     */
    public function store($input, $user){
        $comment = new self();
        $comment->fill($input);
        $comment->user_id = $user->id;
        $comment->save();
        return $comment;
    }

    /**
     * The function reiceves parameters, edit on the database and returns the comment.
     *
     * @param $input
     * @param $id
     * @return Comment
     */
    public function edit($input, $id){
        $comment = $this->find($id);
        $comment->fill($input);
        $comment->save();
        return $comment;
    }

    /**
     * The function delete a comment from database.
     *
     * @param $id
     * @return true
     */
    public function deleteComment($id){
        $comment = $this->find($id);
        $comment->delete();
        return true;
    }


    /**
     * The function determines the relationship between comments and users on the comment model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo(User::class);
    }

}
