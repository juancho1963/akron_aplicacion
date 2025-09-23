import React, { useEffect, useState} from 'react'
import CheckoutFormTransferencia from './CheckoutFormTransferencia'
import { useSelector } from 'react-redux'
import { axiosRequest, getConfig } from '../helpers/config'


export default function Stripe() {
    const { token } = useSelector(state => state.user) //obtiene token desde Redux
    const { cartItems } = useSelector(state => state.cart) //obtiene cartItem desde Redux

    const [montoTotal, handleMontoTotal] = useState();

    useEffect(() => {
        fetchClientSecret();
    }, []);

    const fetchClientSecret = async () => {
        try {
            const response = await axiosRequest.post('pay/transf', {
                cartItems,
            }, getConfig(token));
            handleMontoTotal(response.data.montoTotal)
            console.log(montoTotal)
        } catch (error) {
            console.log(error)
        }
    }

    return (         
            <div className='col-md-12 mx-auto'>
                <CheckoutFormTransferencia/>
            </div>
    )
}
