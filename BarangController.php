<?php
public function index(Request $request)
    {
        if ($request){

            $data=Barang::search($request->search)->paginate(10);

            return view('barangs/home')->with('items', $data);

        }
        $data = Barang::paginate(10);
        return view('barangs/home')->with('items', $data);
    }