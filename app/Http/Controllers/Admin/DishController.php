<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Dish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $id = Auth::id();
        $piatti = Dish::all()->where('user_id', $id);
        $user = User::all()->where('id', $id);

        $data = [
            'dishes' => $piatti,
            'user' => $user
        ];
        return view('admin.dishes.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @param  \Illuminate\Http\Request  $request
     */
    public function create(Request $request)
    {   
        $id = Auth::id();
        $user = User::all()->where('id', $id);
        return view('admin.dishes.create',compact('user'));
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
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'price' => 'required|between:1.00,20.00',
            'visibility' => 'required',
        ]);
        
        $data = $request->all();
        $new_Dish = new Dish();
        $new_Dish->fill($data);
        $new_Dish->user_id = Auth::id();

        $new_Dish->save();
        return redirect()->route('admin.dish.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function show(Dish $dish)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function edit(Dish $dish)
    {   
        $id = Auth::id();
        $user = User::all()->where('id', $id);
        $data = [
            'user' => $user,
            'dish' => $dish
        ];
        return view('admin.dishes.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dish $dish)
    {   
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'price' => 'required|between:1.00,20.00',
            'visibility' => 'required',
        ]);

        $data = $request->all();
        
        $dish->update($data);
        return redirect()->route('admin.dish.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dish $dish)
    {   
        $dish->orders()->sync([]);
        $dish->delete();
        return redirect()->route('admin.dish.index');
    }
}
