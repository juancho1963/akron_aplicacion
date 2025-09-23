import { PaymentElement } from "@stripe/react-stripe-js"
import { useState } from "react"
import { useStripe, useElements } from "@stripe/react-stripe-js"
import { useDispatch, useSelector } from 'react-redux'
import { useNavigate } from 'react-router-dom'
import { axiosRequest, getConfig } from "../helpers/config"
import { clearCartItems, setValidCupon } from "../../redux/slices/cartSlice"
import { setCurrentUser } from "../../redux/slices/userSlice"
import { toast } from "react-toastify"

export default function CheckoutForm() {
    const { cartItems, validCupon } = useSelector(state => state.cart)
    const { token } = useSelector(state => state.user)

    const stripe = useStripe()
    const elements = useElements()

    const [message, setMessage] = useState(null)
    const [isProcessing, setIsProcessing] = useState(false)

    const dispatch = useDispatch()
    const navigate = useNavigate()

    const storePedid = async () => { /* envia los datos del pedido al backend despues que el pago en stripe se ha confirmado */
        try {
            const response = await axiosRequest.post('store/pedid', {
                produ: cartItems, /* envia los datos del carrito al backend */
                validCupon: validCupon,
                tipo: 'tarjeta'
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
        }

    }
    const handleSubmit = async (e) => { /* se ejecuta cuando el usuario envia el formulario */
        e.preventDefault()

        if (!stripe || !elements) {
            // Stripe.js aún no se ha cargado.
            // Asegura de deshabilitar el envío de formulario hasta que Stripe.js se haya cargado.
            return
        }

        setIsProcessing(true)

        const response = await stripe.confirmPayment({
            elements,
            confirmParams: {
                // Asegúrese de cambiar esto en su página de finalización de pago.
            },
            redirect: 'if_required'
        });

        console.log(response.paymentIntent)
        if (response.error && response.error.type === "card_error" || response.error && response.error.type === "validation_error") {
            setMessage(response.error.message);/*  mensaje de error */
        } else if (response.paymentIntent.id) { /*  Si el pago fue exitoso llama a storeOrder */
            //Mostrar mensaje de éxito y redirigir al storeOrder
            storePedid()
        }

        setIsProcessing(false)
    }

    return (
        <form id="payment-form" onSubmit={handleSubmit}>  {/* Agrega el boton en el formulario de Pago para pagar con targeta */}
            <PaymentElement id="payment-element" />
            <button disabled={isProcessing || !stripe || !elements} id="submit">
                <span id="button-text">
                    {isProcessing ? "Procesando ... " : "Pagar ahora"}
                </span>
            </button>
            {/*Mostrar cualquier mensaje de error o éxito */}
            {message && <div id="payment-message">{message}</div>}
        </form>
    )
}