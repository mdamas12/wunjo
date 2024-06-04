<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\BranchesRequest;
use App\Models\Branch;
use Inertia\Response;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $branches = Branch::paginate(10);
        return inertia('Branches/index',['branches' => $branches]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Branches/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BranchesRequest $request)
    {
        Branch::create($request->validated());
        $branches = Branch::paginate(15);
        return inertia('Branches/index',['branches' => $branches]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Branch $branch)
    {
        return inertia('Branches/edit',['branch' => $branch]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BranchesRequest $request, Branch $branch )
    {
        $branch->update($request->validated());
        return redirect()->route('branches.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Branch $branch)
    {
        $branch->delete();
        return redirect()->route('branches.index');
    }
}
