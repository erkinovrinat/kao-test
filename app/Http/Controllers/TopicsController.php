<?php

namespace App\Http\Controllers;

use App\Topic;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTopicsRequest;
use App\Http\Requests\UpdateTopicsRequest;

class TopicsController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display a listing of Topic.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topics = Topic::all();

        return view('topics.index', compact('topics'));
    }

    /**
     * Show the form for creating new Topic.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $relations = [
            'grades' => \App\Grade::get()->pluck('name', 'id')->prepend('Please select', ''),
        ];


        return view('topics.create', $relations);
    }

    /**
     * Store a newly created Topic in storage.
     *
     * @param  \App\Http\Requests\StoreTopicsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTopicsRequest $request)
    {
        Topic::create($request->all());

        return redirect()->route('topics.index');
    }


    /**
     * Show the form for editing Topic.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $relations = [
            'grades' => \App\Grade::get()->pluck('name', 'id')->prepend('Please select', ''),
        ];

        $topic = Topic::findOrFail($id);

        return view('topics.edit', compact('topic') + $relations);
    }

    /**
     * Update Topic in storage.
     *
     * @param  \App\Http\Requests\UpdateTopicsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTopicsRequest $request, $id)
    {
        $topic = Topic::findOrFail($id);
        $topic->update($request->all());

        return redirect()->route('topics.index');
    }


    /**
     * Display Topic.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $topic = Topic::findOrFail($id);

        return view('topics.show', compact('topic'));
    }


    /**
     * Remove Topic from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $topic = Topic::findOrFail($id);
        $topic->delete();

        return redirect()->route('topics.index');
    }

    /**
     * Delete all selected Topic at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if ($request->input('ids')) {
            $entries = Topic::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
