<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSchoolGroupRequest;
use App\Http\Requests\UpdateSchoolGroupRequest;
use App\Http\Resources\SchoolGroupResource;
use App\Models\SchoolGroup;
use Inertia\Inertia;

class SchoolGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('SchoolGroup/Index', [
            'school_groups' => SchoolGroupResource::collection(SchoolGroup::all()),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('SchoolGroup/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSchoolGroupRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSchoolGroupRequest $request)
    {
        SchoolGroup::create($request->all());

        return redirect()->route('schoolGroup.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SchoolGroup  $schoolGroup
     * @return \Illuminate\Http\Response
     */
    public function show(SchoolGroup $schoolGroup)
    {
        return Inertia::render('SchoolGroup/Show',[
            'school_group' => $schoolGroup
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SchoolGroup  $schoolGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(SchoolGroup $schoolGroup)
    {
        // dd($schoolGroup);
        return Inertia::render('SchoolGroup/Edit',[
            'school_group' => $schoolGroup
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSchoolGroupRequest  $request
     * @param  \App\Models\SchoolGroup  $schoolGroup
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSchoolGroupRequest $request, SchoolGroup $schoolGroup)
    {
        $schoolGroup->update($request->all());
        return redirect()->route('schoolGroup.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SchoolGroup  $schoolGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(SchoolGroup $schoolGroup)
    {
        $schoolGroup->delete();
        return redirect()->route('schoolGroup.index');
    }
}
