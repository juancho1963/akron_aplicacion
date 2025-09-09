import React, { useEffect, useState } from 'react'
import { useParams } from 'react-router-dom'
import { axiosRequest } from '../helpers/config'
import Alert from '../layouts/Alert'
import Spinner from '../layouts/Spinner'
import Slider from './images/Slider'
import { useDispatch } from 'react-redux'
import { addToCart } from '../../redux/slices/cartSlice'

export default function Produ () {
        const [produ, setProdu] =useState([])
        const [loading, setLoading] = useState(false)        
        const [selectMarca, setSelectMarca] = useState(null)
        const [cantidad, setCantidad] = useState(1)
        const [error, setError] = useState('')
        const { id} = useParams()
        const dispatch =useDispatch()

        useEffect(() => {
            const fetchProduByIndice = async () => {
                setLoading(true)
                try {
                    const response = await axiosRequest.get(`produs/${id}/show`)
                    setProdu(response.data.data)
                    setLoading(false)
                } catch (error) {
                    if(error?.response?.status === 404) {
                        setError('Lo sentimos,pero el producto que buscas no esta disponible.')
                    }
                    console.log(error)
                    setLoading(false)
                }
            }
            fetchProduByIndice()
        },[id])

        const decrementCantidad = () => {
            if (cantidad > 1)
                setCantidad(cantidad - 1)
        }

        const handleInputChange = (e) => {
            const value =Math.max(1, Math.max(Number(e.target.value), produ?.cantidad || 1))
            setCantidad(value)
        }

        const incrementCantidad = () => {
            if (cantidad < produ?.cantidad) {
                setCantidad(cantidad + 1)
            }
        }

    return (
        <div className='card my-5'>
        {
            error ?
            <Alert type="danger" content={error}/>
            :
            loading ?
            <Spinner/>
            :
            <div className='row g-0'>
                <div className='col-md-4 p-2'>
                    <Slider produ={produ}/>
                </div>
                <div className='col-md-8'>
                    <div className='card-body'>
                        <div className='d-flex justify-content-between'>
                            <h5 className='text-dark'>{produ?.descripcion}</h5>                
                        </div>
                        <div className='d-flex justify-content-between'>
                                   <h6 className='text-dark'>Indice: {produ.indice}</h6>
                                   <h6 className='badge bg-success p-2'>Referencia: {produ.referencia}</h6>
                        </div>                    
                        <div className='d-flex justify-content-start aling-items-center mb-2'>
                                   { 
                                        produ.marcas?.map(marca => (
                                            <span key={marca.id}
                                                onClick={() => setSelectMarca(marca)}
                                                style={{ cursor: 'pointer'}}
                                                className={`border border-2 bg-dark-subtle text-dark me-2 pe-1 ps-1 fw-medium
                                                        ${selectMarca?.id === marca.id ?
                                                            'border border-2 border-dark-subtle fw-bold text-decoration-underline':''
                                                        }
                                                `}>
                                                <small>{marca.name}</small>
                                            </span>
                                        ))
                                   }                                 
                        </div>
                        <div className='d-flex justify-content-between'>                           
                                   <h6 className='badge bg-danger p-2'>Precio: Bs. {produ.precio}</h6>
                                   <h6 className='badge bg-warning p-2'>Desc: {produ.descuento}</h6>
                        </div> 
                    </div>
                    <div className='row mt-5'>
                        <div className='d-flex justify-content-center'>
                            <div className='input-group mb-5' style={{maxWidth: '150px' }}>
                                <button className='btn btn-outline-secondary'
                                    type='button'
                                    onClick={decrementCantidad}
                                    disabled={cantidad <= 1}
                                >-</button>
                                <input type="number" className='form-control'
                                    placeholder='Cantidad'
                                    value={cantidad}
                                    onChange={handleInputChange}
                                    min={1}
                                    max={produ?.cantidad > 1 ? produ?.cantidad : 1}
                                />
                                <button className='btn btn-outline-secondary'
                                    type='button'
                                    onClick={incrementCantidad}
                                    disabled={cantidad >= produ?.cantidad}
                                >+</button>       
                            </div>
                        </div>
                    </div>
                    <div className='d-flex justify-content-center'>
                        <button className='btn btn-dark'
                            disabled={ !selectMarca || produ?.cantidad == 0}
                            onClick={() => {
                                dispatch(addToCart({
                                    produ_id: produ.id,
                                    descripcion: produ.descripcion,
                                    cantidad: cantidad,
                                    precio: parseInt(produ.precio),
                                    descuento: produ.descuento,
                                    marca: selectMarca.name,
                                    maxCantidad: parseInt(produ.cantidad),
                                    image: produ.foto,
                                    cupon_id: null

                                }))
                                setSelectMarca(null)
                                setCantidad(1)
                            }}
                        >
                            <i className='bi bi-cart-fill'></i> {" "} Agregar al carrito
                        </button>
                    </div>
                </div>
            </div>
        }             
        </div>
    )
} 