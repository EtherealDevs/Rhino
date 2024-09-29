<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comprobante;
use App\Models\Order;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ComprobanteController extends Controller
{

    public function store(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $url=Storage::put('comprobante', $file);
            $comprobante = new Comprobante();
            $comprobante->dni = $request->input('dni');
            $comprobante->url = $url;
            $comprobante->order_id = $request->input('order_id');
            $comprobante->save();
            return redirect()->route('oder.index');
        }
    }


    public function createOrderAndAssignProof(Request $request)
    {

        $validatedData = $request->validate([
            'address' => 'required|string|max:255',
            'total' => 'required|numeric',
        ]);


        $order = new Order();
        $order->user_id = Auth::id();
        $order->address = $request->input('address');
        $order->total = $request->input('total');
        $order->status = 'processing';
        $order->save();
        $comprobante = Comprobante::where('user_id', Auth::id())
                                  ->where('status', 'pending') // Comprobantes pendientes
                                  ->first();

        if ($comprobante) {
            $comprobante->order_id = $order->id;
            $comprobante->status = 'associated'; // Actualiza el estado
            $comprobante->save();
        }


        return response()->json(['message' => 'Orden creada y comprobante asociado correctamente', 'order' => $order, 'comprobante' => $comprobante]);
    }
}
