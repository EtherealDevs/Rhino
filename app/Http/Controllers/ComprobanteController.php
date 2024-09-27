<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comprobante;
use App\Models\Order;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ComprobanteController extends Controller
{
   
    public function uploadProof(Request $request)
    {
        $validatedData = $request->validate([
            'comprobante' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048', 
            'dni' => 'required|integer'
        ]);

        if ($request->hasFile('comprobante')) {
            $filePath = $request->file('comprobante')->store('comprobantes');
            $comprobante = new Comprobante();
            $comprobante->dni = $request->input('dni');
            $comprobante->url = $filePath; // Guarda la URL del archivo
            $comprobante->user_id = Auth::id(); 
            $comprobante->status = 'pending'; 
            $comprobante->save();

            
            return response()->json(['message' => 'Comprobante subido con éxito, a la espera de asignar la orden', 'comprobante' => $comprobante]);
        }

        return response()->json(['error' => 'No se pudo subir el comprobante'], 500);
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
