<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pedid;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PedidController extends Controller
{
    public function index(){
        $pedids = Pedid::latest()->get();
        return view('admin.pedids.index')->with([
            'pedids' => $pedids
        ]);
    }

    public function updateFacturaAtDate(Pedid $pedid) {
        $pedid->update([
            'fechaFactura' => Carbon::now(),
            'statusped' => "2"
        ]);

        $pedids = Pedid::latest()->get();

        return redirect()->route('admin.pedids.index')->with('success', 'La fecha de la factura se actualizó correctamente');
    }

    public function updateDeliveredAtDate(Pedid $pedid) {
        $pedid->update([
            'fechaPagp' => Carbon::now(),
            'statusped' => "3"
        ]);
        $pedids = Pedid::latest()->get();

        return redirect()->route('admin.pedids.index')->with('success', 'La fecha de la factura se actualizó correctamente');
    }

    public function delete(Pedid $pedid) {
        $pedid->delete();

        $pedids = Pedid::latest()->get();

        return view('admin.pedids.index')->with([
            'success' => 'El pedido se elimino correctamente',
            'pedids' => $pedids
        ]);
    }
}
