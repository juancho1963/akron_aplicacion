import React, { useState } from 'react'
import { useSelector, useDispatch } from 'react-redux'
import { axiosRequest, getConfig } from '../helpers/config'
import { toast } from 'react-toastify'
import { addCuponIdToCartItem, setValidCupon } from '../../redux/slices/cartSlice'

export default function Cupon() {
    const { token } = useSelector(state => state.user)
    const [cupon, setCupon] = useState({
        name: ''
    })
    const dispatch = useDispatch()

    const applyCupon = async () => {
        try {
            const response = await axiosRequest.post('apply/cupon', cupon, 
                getConfig(token))
            if(response.data.error){
                toast.error(response.data.error)         
                setCupon({
                    name:''
                })
            } else {
                dispatch(setValidCupon(response.data.cupon))
                dispatch(addCuponIdToCartItem(response.data.cupon.id))
                setCupon({
                name: ''
                })
                toast.success(response.data.message)
            }
        } catch (error) {
            console.log(error)
        }
    }
    return (
        <div className='row mb-3'>
            <div className='col-md-12'>
                <div className='d-flex'>
                    <input type="text" value={cupon.name}
                        onChange={(e) => setCupon({
                            ...cupon, name: e.target.value
                        })}
                        className='form-control rounded-0'
                        placeholder='Introducir el cupón de descuento'
                    />
                    <button className='btn btn-dark rounded-0'
                        disabled={!cupon.name}
                        onClick={() => applyCupon()}
                    >Aplicar</button>
                </div>
            </div>
        </div>
    )
}   