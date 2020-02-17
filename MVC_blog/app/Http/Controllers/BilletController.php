<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Billet;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BilletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $billets = Billet::paginate(5);
        return view('billets.index', compact('billets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('billets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $billet = Billet::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('billets.index')
                            ->with('success', 'Billet created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Billet $billet)
    {
        $comments = Comment::where('billet_id', $billet->id)->paginate(5);
        return view('billets.show', compact('billet', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Billet $billet)
    {
        if($billet->user_id != Auth::id())
        {
            return redirect()->route('billets.index')
                            ->with('success', "vous n'avez pas les droit pour editez ce billet");

        }
        else
        {
            return view('billets.edit',compact('billet'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Billet $billet)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $billet->update($request->all());

        return redirect()->route('billets.index')
                            ->with('success', 'Billet update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Billet $billet)
    {
        if($billet->user_id != Auth::id())
        {
            return redirect()->route('billets.index')
                            ->with('success', "vous n'avez pas les droit pour suprimer ce billet");

        }
        else
        {
            DB::table('comments')->where('billet_id', '=', $billet->id)->delete();
            $billet->delete();

        return redirect()->route('billets.index')
                            ->with('success', 'billet delete successfully.');
        }
    }
}
