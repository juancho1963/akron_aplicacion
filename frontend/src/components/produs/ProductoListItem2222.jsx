import React from 'react'
import { Link } from 'react-router-dom'
import { colorTranslations } from '../helpers/colorTranslation'
export default function ProductoListItem({ producto}) { 
    return (
      /*   ocupamos 4 columnas */
        <div className='col-mb-4 mb-3'> 
            <Link className='text-decoration-none text-dark'>
                <div className='card shadow-sm h-100'>
                    <img src={producto.foto} alt={producto.indice}
                        className='card-img-top'/>
                        <div className='card-body'>
                            <div className='d-flex justify-content-between'>
                                <h5 className='text-dark'>{producto.indice}</h5>
                                <h6 className='badge bg-success p-2'>Bs{producto.precio}</h6>
                            </div>
                            <div className='d-flex justify-content-between'>
                                <div className='d-flex justify-content-start aling-items-center mb-3'>
                                    {
                                        producto.marcas?.map(marca => (
                                            <span key={marca.id} className='bg-dark-subtle text-dark me-2 pe-1 ps-1 fw-bold'>
                                                <small>{marca.name}</small>
                                            </span>
                                        ))
                                    }
                                    <h6 className='badge bg-success p-2'>{producto.referencia}</h6>

                                </div>

                            </div>
                                            
                           <div className='d-flex justify-content-between'>
                                <h5 className='text-dark'>{producto.descripcion}</h5>
                                <h6 className='badge bg-success p-2'>{producto.descuento}</h6>
   
                            </div>
                        </div>
                    </div>
            </Link>
        </div>
    )
}