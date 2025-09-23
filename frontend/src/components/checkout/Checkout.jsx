import React from 'react'
import { useDispatch, useSelector } from 'react-redux'
import Cupon from '../cupons/Cupon'
import { setValidCupon } from '../../redux/slices/cartSlice'
import { toast } from 'react-toastify'
import { Link } from 'react-router-dom'
import Alert from '../layouts/Alert'
import UpdateUserInfos from '../user/partials/UpdateUserInfos'

export default function Checkout() {
    const { cartItems, validCupon } = useSelector(state => state.cart)
    const { user } = useSelector(state => state.user)
    const dispatch = useDispatch()
    
    const totalOfCartItems = cartItems.reduce((acc, item) => acc += item.precio * item.cantidad * (100 - item.descuento) / 100, 0)
    const calculateDescuento = () => {
        return validCupon?.descuento && (totalOfCartItems * validCupon?.descuento / 100)
    }
    const removeCupon = () => {
        dispatch(setValidCupon({
            cupon_id: '',
            name: '',
            descuento: 0
        }))
        toast.success('Cupon eliminado')
    }
    const totalAfterDescuento = () => {
        return (totalOfCartItems - calculateDescuento()).toFixed(2)
    }
    return (
        <div className='card my-2 mb-4'>
            <div className='card-body'>
                <div className='row my-5 justify-content-center '>
                    <div className='col-md-7'>
                        {/* Datos de usuario */}
                        <UpdateUserInfos profile={false} />
                    </div>


                    <div className='col-md-5'>
                        {/* Campo del Cupon */}
                        <Cupon />
                        <ul className='list-group'>
                            {
                                cartItems.map((item, index) => (
                                    <li key={index} className='list-group-item d-flex'>
                                        <img src={item.image}
                                            width={60} height={60}
                                            className='img-fluid rounded me-2'
                                        />
                                        <div className='d-flex flex-column'>
                                            <h6 className='my-1'>{item.descripcion}</h6>
                                            <span className='text-muted'><strong>Marca: </strong>{item.marca}</span>

                                        </div>
                                        <div className='d-flex flex-column ms-auto'>
                                            <span className='text-muted'><strong>Cantidad: </strong>{item.cantidad}</span>
                                            <span className='text-muted'><strong>Precio: </strong> Bs.{item.precio}</span>
                                            <span className='text-muted'><strong>Descuento: </strong>%{item.descuento}</span>

                                            <span className='text-danger fw-bold'>Bs.{item.precio * item.cantidad * (100 - item.descuento) / 100}</span>
                                        </div>
                                    </li>
                                ))
                            }
                            <li className='list-group-item d-flex justify-content-between'>
                                <span className='fw-bold'>SubTotal</span>
                                <span className='fw-bold'>Bs.{totalOfCartItems}</span>
                            </li>
                            <li className='list-group-item d-flex justify-content-between'>
                                <span className='fw-bold'>Descuento {validCupon?.descuento} %</span>
                                {
                                    validCupon?.name &&
                                    <span className='text-danger'>{validCupon?.name}
                                        <i className='bi bi-trash'
                                            style={{ cursor: 'pointer' }}
                                            onClick={() => removeCupon()}
                                        ></i>
                                    </span>
                                }
                                <span className='fw-bold text-danger'> -Bs.{calculateDescuento()}</span>
                            </li>
                            <li className='list-group-item d-flex justify-content-between'>
                                <span className='fw-bold'>Total a pagar</span>
                                <span className='fw-bold'>Bs. {totalAfterDescuento()}</span>
                            </li>
                        </ul>
                        <div className='my-3'>
                            {
                                user?.datoCompleUser ?
                                    <Link to="/pay/pedid" className='btn btn-warning rounder-0'>Pagar con tarjeta de credito</Link>
                                    :
                                    <Alert content="Para terminar tu compra, es necesario que ingreses los detalles de la factura"
                                        type="warning" />
                            }
                        </div>

                        <div className='my-3'>
                            {
                                user?.datoCompleUser ?
                                    <Link to="/pay/transferencia" className='btn btn-success rounder-0'>Pagar con transferencia bancaria</Link>
                                    :
                                    <Alert content="Para terminar tu compra, es necesario que ingreses los detalles de la factura"
                                        type="warning" />
                            }
                        </div>
                    </div>
                </div>
            </div>
        </div>
    )
} 