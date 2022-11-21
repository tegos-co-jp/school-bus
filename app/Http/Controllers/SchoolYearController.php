<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSchoolYearRequest;
use App\Http\Requests\UpdateSchoolYearRequest;
use App\Http\Resources\SchoolYearResource;
use App\Models\School;
use App\Models\SchoolYear;
use Inertia\Inertia;
use Carbon\Carbon;

class SchoolYearController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('SchoolYear/Index', [
            'school_years' => SchoolYearResource::collection(SchoolYear::all()),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('SchoolYear/Create', [
            'schools' => School::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSchoolYearRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSchoolYearRequest $request)
    {
        // $request->start_on->format('Y/m/d');
        SchoolYear::create([
            'year' => $request->year,
            'start_on' => (new Carbon($request->start_on))->format('Y/n/j'),
            'end_on' => (new Carbon($request->end_on))->format('Y/n/j'),
            'this_year' => $request->this_year,
            'school_id'=> $request->school_id,
        ]);


        return redirect()->route('schoolYear.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SchoolYear  $schoolYear
     * @return \Illuminate\Http\Response
     */
    public function show(SchoolYear $schoolYear)
    {
        return Inertia::render('SchoolYear/Show',[
            'school_year' => $schoolYear
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SchoolYear  $schoolYear
     * @return \Illuminate\Http\Response
     */
    public function edit(SchoolYear $schoolYear)
    {
        return Inertia::render('SchoolYear/Edit',[
            'school_year' => $schoolYear,
            'schools' => School::all()

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSchoolYearRequest  $request
     * @param  \App\Models\SchoolYear  $schoolYear
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSchoolYearRequest $request, SchoolYear $schoolYear)
    {
        $schoolYear->update($request->all());
        return redirect()->route('schoolYear.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SchoolYear  $schoolYear
     * @return \Illuminate\Http\Response
     */
    public function destroy(SchoolYear $schoolYear)
    {
        $schoolYear->delete();
        return redirect()->route('schoolYear.index');
    }
}
