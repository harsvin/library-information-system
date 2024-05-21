<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::all();
        return view('members.index', compact('members'));
    }

    public function create()
    {
        return view('members.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'ic_no' => 'required|unique:members',
            'address' => 'required',
            'contact_information' => 'required',
        ]);

        Member::create($request->all());
        return redirect()->route('members.index')
                         ->with('success', 'Member created successfully.');
    }

    public function show(Member $member)
    {

        return view('members.show', compact('member'));
    }

    public function edit(Member $member)
    {
        $member = Member::findOrFail($member);
        return view('members.edit', compact('member'));
    }

    public function update(Request $request, Member $member)
    {
        $request->validate([
            'name' => 'required',
            'ic_no' => 'required|unique:members,ic_no,' . $member->id,
            'address' => 'required',
            'contact_information' => 'required',
        ]);
        $member = Member::findOrFail($member);
        $member->update($request->all());
        return redirect()->route('members.index')
                         ->with('success', 'Member updated successfully.');
    }

    public function destroy(Member $member)
    {

        $member = Member::findOrFail($member);
        $member->delete();
        return redirect()->route('members.index')
                         ->with('success', 'Member deleted successfully.');
    }
}
