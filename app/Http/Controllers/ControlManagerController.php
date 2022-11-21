<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreControlManagerRequest;
use App\Http\Requests\UpdateControlManagerRequest;
use App\Http\Resources\ControlManagerResource;
use App\Models\SchoolGroup;
use App\Models\ControlManager;
use Inertia\Inertia;

class ControlManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('ControlManager/Index', [
            'control_managers' => ControlManagerResource::collection(ControlManager::all()),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('ControlManager/Create', [
            'school_groups' => SchoolGroup::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreControlManagerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreControlManagerRequest $request)
    {
        ControlManager::create($request->all());

        return redirect()->route('controlManager.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ControlManager  $ControlManager
     * @return \Illuminate\Http\Response
     */
    public function show(ControlManager $controlManager)
    {
        return Inertia::render('ControlManager/Show',[
            'control_manager' => $controlManager
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ControlManager  $ControlManager
     * @return \Illuminate\Http\Response
     */
    public function edit(ControlManager $controlManager)
    {
        // $controlManager = ControlManager::first();
        return Inertia::render('ControlManager/Edit',[
            'control_manager' => $controlManager,
            'school_groups' => SchoolGroup::all()

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateControlManagerRequest  $request
     * @param  \App\Models\ControlManager  $ControlManager
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateControlManagerRequest $request, ControlManager $controlManager)
    {
        $controlManager->update($request->all());
        return redirect()->route('controlManager.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ControlManager  $ControlManager
     * @return \Illuminate\Http\Response
     */
    public function destroy(ControlManager $controlManager)
    {
        $controlManager->delete();
        return redirect()->route('controlManager.index');
    }
}
