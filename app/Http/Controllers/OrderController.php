<?php

namespace App\Http\Controllers;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::where('user_id',Auth::user()->id)->get();
         return view('order.index',compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('order.edit');
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
            'title' => 'required',
            'description' => 'required',
        ]);
        $order = new Order;
        $input = $request->all();
        if($file = $request->file('image'))
        {
          $name = time().$file->getClientOriginalName();
          $file->move('images',$name);
          $input['image'] = $name;
        }
        $input['user_id'] = Auth::user()->id;
        $order->fill($input)->save();
        
        if( $order){
			return redirect()->route('order.index')->with('success', 'Added successfully');
        }
        else{
            return redirect()->route('order.index')->with('error', 'Not added');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::where('user_id',Auth::user()->id)->find($id);
        return view('order.show',compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::where('user_id',Auth::user()->id)->find($id);
        return view('order.edit',compact('order'));
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
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
        $input = $request->all();
        if($file = $request->file('image'))
        {
          $name = time().$file->getClientOriginalName();
          $file->move('images',$name);
          $input['image'] = $name;
        }
        $input['user_id'] = Auth::user()->id;
        $order = Order::find($id)->update($input);
        
        return redirect()->route('order.index')->with('success', 'Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id)->delete();
        return redirect()->back()->with('success', 'Deleted successfully');
    }
}
