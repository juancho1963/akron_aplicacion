import React, { useEffect, useState } from 'react'
import { loadStripe } from '@stripe/stripe-js'
import { Elements } from '@stripe/react-stripe-js'
import CheckoutForm from './CheckoutForm'
import { useSelector } from 'react-redux'
import { axiosRequest, getConfig } from '../helpers/config'


export default function Stripe() {
    const { token } = useSelector(state => state.user)
    const { cartItems } = useSelector(state => state.cart)

    const stripePromise = loadStripe('pk_test_51S1FxVRySfo6bmVTZWkxOqKWazAakYGW0ljOxYIvQVhyp7ItomMJjmc6C1aXKvzw8uZlAHPQOdKAWks4SnPkFm7i00MwadiulX')
    const [clientSecret, setClientSecret] = useState("")


    useEffect(() => {
        fetchClientSecret();
    }, []);

    const fetchClientSecret = async () => {
        try {
            const response = await axiosRequest.post('pay/pedid', {
                cartItems,
            }, getConfig(token));
            setClientSecret(response.data.clientSecret);
        } catch (error) {
            console.log(error)
        }
    }

    return (
        <>
            {
                stripePromise && clientSecret && <Elements stripe={stripePromise} options={{ clientSecret }}>
                    <CheckoutForm />
                </Elements>
                
            }
        </>
    )
}
