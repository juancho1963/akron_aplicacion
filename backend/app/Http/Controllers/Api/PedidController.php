<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Cupon;
use App\Models\Pedid;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use ErrorException;

class PedidController extends Controller
{
    public function store(Request $request) { /* //crear nuevos registros en la tabla Pedid// */

        $cart= $request->produ;
        $total = $this->calculatePedidTotalTransferencia($cart);

        $pedid = new Pedid([
            'user_id' => $request->user()->id,
                /* 'cupon_id' => '1', */
            'fechaPedido' => Carbon::now(),
            'nameCupon' => $request->validCupon['name'],
            'descuentoCupon' => $request->validCupon['descuento'],
            'statusped' => '1',
            'numTelefoUser' => $request->user()->numTelefoUser,
            'direcUser' => $request->user()->direcUser,
            'docIdenUser' => $request->user()->docIdenUser,
            'nameUser' => $request->user()->name,
            'compPago' => 'Tarjeta',
            'montoTotalPed' => $total
        ]);

        if ($request->tipo === 'transferencia') {

            if ($total == $request->compPago['transPago']) {
                $pedid->compPago = $request->compPago['compPago'];
            } else {
                 return response()->json([
                    'error' => 'monto incorrecto',
                 ],400);
            }

        }

        $pedid->save();

        foreach ($request->produ as $produ) { /* //crear nuevos registros en la tabla Pedid// */

            $pedid->produs()->attach($produ['produ_id'], /* relacion muchos a muchos */
                        [
                            'precio_prod' => $produ['precio'],
                            'cantidad_prod' => $produ['cantidad'],
                            'descuento' => (int) $produ['descuento'],
                        ]
                   );
        }
        return response()->json([
         'user' => UserResource::make($request->user())
        ]);
    }

     public function calculateTotal($precio, $cantidad, $descuento, $cupon_id){ /* calcula el total de cada producto */
        $discount = 0;
        $total = $precio * $cantidad * (100-$descuento) / 100;
        $cupon = Cupon::find($cupon_id);
        if ($cupon) {
            if ($cupon->checkIfValid()) {
                $discount = $total * $cupon->descuento / 100;
            }
        }
        return $total - $discount;
    }

    public function payPedidByStripe(Request $request) {
        Stripe::setApiKey(env('STRIPE_KEY'));
        try {
            $paymentIntent = PaymentIntent::create([
                'amount' => (int) $this->calculatePedidTotal($request->cartItems),
                'currency' => 'usd',
                'description' => 'AppAkron',
            ]);
            $output = [
                'clientSecret' => $paymentIntent->client_secret
            ];
            return response()->json($output);
        } catch (ErrorException $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }

    public function calculatePedidTotal($items){
        $total = 0;
        foreach ($items as $item) {
            $total += $this->calculateTotal($item['precio'],$item['cantidad'],$item['descuento'],$item['cupon_id']);
        }
        return $total * 100;
    }

    public function payPedidByTransferencia(Request $request) {

        try {

            $output = [
                'montoTotal' => $this->calculatePedidTotalTransferencia($request->cartItems),
            ];
            return response()->json($output);
        } catch (ErrorException $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }

    public function calculatePedidTotalTransferencia($items){
        $total = 0;
        foreach ($items as $item) {
            $total += $this->calculateTotal($item['precio'],$item['cantidad'],$item['descuento'],$item['cupon_id']);
        }
        return round($total, 2);
    }

}
