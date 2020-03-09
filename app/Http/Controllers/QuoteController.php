<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Quote;
use Illuminate\Support\Facades\Auth;
use function GuzzleHttp\Psr7\str;

class QuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userID = Auth::id();
        $quotes = Quote::where(['user_id' => $userID])->get();

        return view('index', compact('quotes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userID = Auth::id();

        $validatedData = $request->validate([
            'season' => 'required|numeric',
            'episode' => 'required|numeric',
            'quote' => 'required|max:255',
        ]);

        $validatedData['user_id'] = $userID;

        $id = rand(1,1000);
        $validatedData['img'] = "https://picsum.photos/id/$id/200";

        $quote = Quote::create($validatedData);

        return redirect('/quotes')->with('success', 'Quote has been successfully saved');
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
        $userID = Auth::id();
        $quote = Quote::where(['user_id' => $userID, 'id' => $id])->first();
        return view('edit', compact('quote'));
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
        $userID = Auth::id();
        $validatedData = $request->validate([
            'season' => 'required|numeric',
            'episode' => 'required|numeric',
            'quote' => 'required|max:255',
        ]);

        $validatedData['user_id'] = $userID;

        Quote::whereId($id)->update($validatedData);

        return redirect('/quotes')->with('success', 'Quote has been successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $userID = Auth::id();
        $quote = Quote::where(['user_id' => $userID, 'id' => $id])->first();
        $quote->delete();

        return redirect('/quotes')->with('success', 'Quote has been successfully deleted');
    }
}
