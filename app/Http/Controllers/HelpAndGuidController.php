<?php

namespace App\Http\Controllers;

use App\Http\Requests\HelpAndGuidStoreRequest;
use App\Models\HelpAndGuid;
use App\Models\User;

class HelpAndGuidController extends Controller
{
    public function index()
    {
        $helpAndGuids = HelpAndGuid::query()
            ->with(['user:id,name'])
            ->latest()
            ->paginate(10);

        $contributors = User::select('id','name','email')
            ->withCount('help_and_guids')
            ->having('help_and_guids_count','>',0)
            ->get();

        return view('helpAndGuid.index',[
            'helpAndGuids' => $helpAndGuids,
            'contributors' => $contributors
        ]);
    }

    public function store(HelpAndGuidStoreRequest $request){
        auth()->user()->help_and_guids()->create($request->validated());
        return redirect()->back()->with('success', 'New post created success');
    }
}
