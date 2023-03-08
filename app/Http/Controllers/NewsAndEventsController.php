<?php

namespace App\Http\Controllers;

use App\Models\NewsEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laracasts\Flash\Flash;
use Yajra\DataTables\DataTables;

class NewsAndEventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
            $data = NewsEvent::select('*');
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('action', function ($data) {
                     
                    $edit = '';
                    $delete = '';
                    if (permission_check('NEWS_AND_EVENTS_EDIT'))
                    $edit   =   button('edit',route('news-and-events.edit', $data->id));

                    if (permission_check('NEWS_AND_EVENTS_DESTROY'))
                    $delete =   button('delete',route('news-and-events.destroy', $data->id));
                    return $edit.$delete;
                })->make(true);
        }
        return view('admin.news-and-events.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.news-and-events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['slug'] = Str::slug($request->title);
        $request->validate([
            'title'       => 'required',
            'description' => 'required',
            'slug'        => 'unique:news_events,slug'
        ],[ 'slug.unique' => 'Title Already been Taken' ]);
        $result = NewsEvent::create([
            'title'       => $request->title,
            'slug'        => Str::slug($request->title),
            'description' => $request->description,
            'posted_by'   => auth_user()->name,
        ]);
        if($result) {
            Flash::success(__('action.created',['type' => 'News & Events']));
        }
        return redirect()->route('news-and-events.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = NewsEvent::findOrFail($id);
        return view('admin.news-and-events.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request['slug'] = Str::slug($request->title);
        $request->validate([
            'title'       => 'required',
            'description' => 'required',
            'slug'        => 'unique:news_events,slug,'.$id.',id'
        ]);
        $result = NewsEvent::findOrFail($id)->update([
            'title'       => $request->title,
            'slug'        => Str::slug($request->title),
            'description' => $request->description,
            'posted_by'   => auth_user()->name,
        ]);
        if($result) {
            Flash::success(__('action.updated',['type' => 'News & Events']));
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(NewsEvent::find($id)->delete()) {
            Flash::success(__('action.deleted',['type' => 'News & Events']));
        }
        return redirect()->route('news-and-events.index');
    }
}
