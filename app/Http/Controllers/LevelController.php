<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLevelsRequest;
use App\Http\Requests\UpdateLevelsRequest;
use App\Level;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display a listing of Level.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $levels = Level::all();

        return view('levels.index', compact('levels'));
    }

    /**
     * Show the form for creating new Level.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('levels.create');
    }

    /**
     * Store a newly created Level in storage.
     *
     * @param  \App\Http\Requests\StoreLevelsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLevelsRequest $request)
    {
        Level::create($request->all());

        return redirect()->route('levels.index');
    }


    /**
     * Show the form for editing Level.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $level = Level::findOrFail($id);

        return view('levels.edit', compact('level'));
    }

    /**
     * Update Level in storage.
     *
     * @param  \App\Http\Requests\UpdateLevelsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLevelsRequest $request, $id)
    {
        $level = Level::findOrFail($id);
        $level->update($request->all());

        return redirect()->route('levels.index');
    }


    /**
     * Display Level.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $level = Level::findOrFail($id);

        return view('levels.show', compact('level'));
    }


    /**
     * Remove Level from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $level = Level::findOrFail($id);
        $level->delete();

        return redirect()->route('levels.index');
    }

    /**
     * Delete all selected Level at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if ($request->input('ids')) {
            $entries = Level::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
