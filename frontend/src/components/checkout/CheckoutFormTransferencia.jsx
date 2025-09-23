import React, { useState } from 'react';
import { useDispatch, useSelector } from 'react-redux'
import { axiosRequest, getConfig } from "../helpers/config"
import { clearCartItems, setValidCupon } from "../../redux/slices/cartSlice"
import { setCurrentUser } from "../../redux/slices/userSlice"
import { toast } from "react-toastify"

export default function CheckoutFormTransferencia() {
    const { cartItems, validCupon } = useSelector(state => state.cart)
    const { token } = useSelector(state => state.user)

    const [pagoTransInfos, setPagoTransInfos] = useState({})

    const [isProcessing, setIsProcessing] = useState(false)

    const dispatch = useDispatch()

    const totalOfCartItems = cartItems.reduce((acc, item) => acc += item.precio * item.cantidad * (100 - item.descuento) / 100, 0)
    const calculateDescuento = () => {
        return validCupon?.descuento && (totalOfCartItems * validCupon?.descuento / 100)
    }
    const totalAfterDescuento = () => {
        return (totalOfCartItems - calculateDescuento()).toFixed(2)
    }
    

    const storePedid = async () => { /* envia los datos del pedido al backend despues que el pago en stripe se ha confirmado */
        try {
            const response = await axiosRequest.post('store/pedid', {
                produ: cartItems,
                validCupon: validCupon,
                tipo: 'transferencia',
                compPago: pagoTransInfos,
            }, getConfig(token))
            dispatch(clearCartItems())
            dispatch(setValidCupon({
                cupon_id: '',
                name: '',
                descuento: 0
            }))
            dispatch(setCurrentUser(response.data.user))
            setIsProcessing(false)
            toast.success("El pago se realizó exitosamente.");

        } catch (error) {
            console.log(error)
            setIsProcessing(false)
            if (error.response && error.response.data) {
                toast.error(error.response.data.error);
            } else {
                toast.error("Ocurrió un error al procesar el pago. Por favor, inténtelo de nuevo.");
            }
        }
    }

    const handleSubmit = async (e) => { /* se ejecuta cuando el usuario envia el formulario */
        e.preventDefault()  // Previene el comportamiento por defecto del formulario (recargar la página).
        console.log(pagoTransInfos)
        storePedid()
    }
    
    return (
        <div className='col-md-12'>
            <div className='card shadow-sm'>
                <div className='card-header bg-white'>
                    <h5 className='text-center mt-2'>
                        Pago con Transferencia:
                    </h5>
                    <span>monto: {totalAfterDescuento()}</span>
                </div>
                <div className='card-body'>
                    <form className='mt-2' onSubmit={handleSubmit}>
                        <div className='mb-3'>
                            <label className='form-label'>Entidad Bancaria para tranferir</label>
                                <h4>Banco Mercantil</h4>
                        </div>

                        <div className='mb-3'>
                            <label className='form-label'>Numero de cuenta</label>
                                <h4>7676 7676 7676 7676 7676</h4>
                        </div>

                        <div className='mb-3'>
                            <label className='form-label'>Rif Empresa</label>J-45678912345
                                <h4>J-45678912345</h4>
                        </div>

                        <div className='mb-3'>
                            <label className='form-label'>Numero comprobante Pago</label>
                            <input type="text"
                                value={pagoTransInfos.compPago || ''}
                                onChange={(e) => setPagoTransInfos({
                                    ...pagoTransInfos, compPago: e.target.value
                                })}
                                required
                                className='form-control' id='docIdenUser'
                            />
                        </div>

                        <div className='mb-3'>
                            <label className='form-label'>Monto Pago</label>
                            <input type="text"
                                value={pagoTransInfos.transPago || ''}
                                onChange={(e) => setPagoTransInfos({
                                    ...pagoTransInfos, transPago: e.target.value
                                })}
                                required
                                className='form-control' id='numTelefoUser'
                            />
                        </div>

                        {
                            <button type='button' className='btn btn-dark btn-sm float-end' onClick={handleSubmit}>
                                {isProcessing ? "Procesando ... " : "Pagar ahora"}

                            </button>
                        }
                    </form>
                </div>
            </div>
        </div>
    )
}