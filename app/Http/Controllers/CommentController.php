<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\CommentFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * @var Comment|null
     */
    private $comment = null;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Method reiceves a id, validates if the user can edit, and return the view to edit a comment, if fails, redirect to home.
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function formEdit($id){
         $comment = $this->comment->find($id);
         if(Auth::user()->id != $comment->user_id){
             return redirect('home');
         }
         return view('comment.edit', ['comment' => $comment]);
    }


    /**
     * Method reiceve a request to edit the comment and call the method from model to edit.
     *
     * @param CommentFormRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function actionEdit(CommentFormRequest $request){
        $this->comment->edit($request->all(), $request->input('comment_id'));
        return redirect('home');
    }


    /**
     * Method reiceve a request to create a new comment and call the method from model to create.
     *
     * @param CommentFormRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     *
     */
    public function store(CommentFormRequest $request){
        $input = $request->all();
        $this->comment->store($input, Auth::user());
        return redirect('home');
    }

    /**
     * Method validate the parameters and calls the method from model to delete a comment, and redirect to home.
     *
     * @param $id
     * @return |null
     */
    public function deleteComment($id){
        $comment = $this->comment->find($id);
        if(!$comment || !Auth::user()->isAdmin() && Auth::user()->id != $comment->user_id){
            return redirect('home');
        }
        $this->comment->deleteComment($id);
        return redirect('home');
    }
}
