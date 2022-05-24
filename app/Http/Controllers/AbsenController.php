<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AbsenController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Absen::class, 'absenrsc');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $absen = Absen::where('user_id',Auth::id())->paginate(7);
        return Inertia::render('AbsenPage/AbsenList', [
            'absenlist' => $absen,
        ]);
    }

    public function viewDataAllAbsen(){

        $this->authorize('DataAbsenAll', Absen::class);

        $absen = Absen::paginate(7);
        return Inertia::render('AbsenPage/AbsenListAll', [
            'absenlist' => $absen,
        ]);
    }

    public function search()
    {
        $absen = Absen::latest()->search(request(['search']))->paginate(7);

        return Inertia::render('AbsenPage/AbsenList', [
            'absenlist' => $absen,
        ]);
    }

    public function searchWithActiveLogin()
    {
        $absen = Absen::latest()->where('user_id', Auth::id())->search(request(['search']))->paginate(7);

        return Inertia::render('AbsenPage/AbsenList', [
            'absenlist' => $absen,
        ]);
    }

    public function showOrgChart(){
        return Inertia::render('User/ChartIndex');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $created_at = Carbon::now()->format('d D M Y, H:m:s');
        return Inertia::render('AbsenPage/AbsenIndex', compact('created_at'));
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
            'user_id' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'department' => ['required', 'max:220'],
            'posname' => ['required', 'max:220'],
            'activity' => ['max:250'],
            'absenvalue' => ['required'],
            'absentype' => ['required', 'max:220',
                    function ($attribute, $value, $fail) {
                        if ($value === 'invalid') {
                            $fail('The Absen Type is invalid. Please Choose a Valid Value');
                        }
                    }
                ]
        ]);

        Absen::create([
            'user_id' => $request->user_id,
            'name' => $request->name,
            'email' => $request->email,
            'department' => $request->department,
            'posname' => $request->posname,
            'activity' => $request->activity,
            'absentype' => $request->absentype,
            'absenvalue' => $request->absenvalue
        ]);

        return redirect()->back()->with('message', 'Absen Successfull');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Absen  $absen
     * @return \Illuminate\Http\Response
     */
    public function show(Absen $absen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Absen  $absen
     * @return \Illuminate\Http\Response
     */
    public function edit(Absen $absen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Absen  $absen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Absen $absen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Absen  $absen
     * @return \Illuminate\Http\Response
     */
    public function destroy(Absen $absen)
    {
        //
    }
}
