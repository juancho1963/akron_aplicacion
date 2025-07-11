import React from 'react'
import { Link } from 'react-router-dom'
 
     export default function ProduListItem({ produ }) {
        return( 
          <div className='col-md-4 mb-3'>
               <Link className='text-decoration-none text-dark'>
                    <div className='card shadow-sm h-100'>
                         <img src={produ.foto} alt={produ.indice}
                              className='card-img-top' />
                         <div className='card-body'>
                              <div className='d-flex justify-content-between'>
                                   <h5 className='text-dark'>{produ.descripcion}</h5>                
                              </div>
                              <div className='d-flex justify-content-between'>
                                   <h6 className='text-dark'>Indice: {produ.indice}</h6>
                                   <h6 className='badge bg-success p-2'>Referencia: {produ.referencia}</h6>
                              </div>                    
                              <div className='d-flex justify-content-start aling-items-center mb-2'>
                                   {
                                        produ.marcas?.map(marca => (
                                            <span key={marca.id} className='bg-dark-subtle text-dark me-2 pe-1 ps-1 fw-bold'>
                                                <small>Marca: {marca.name}</small>
                                            </span>
                                        ))
                                   }                                 
                              </div>
                              <div className='d-flex justify-content-between'>                           
                                   <h6 className='badge bg-danger p-2'>Precio: Bs{produ.precio}</h6>
                                   <h6 className='badge bg-warning p-2'>Desc: {produ.descuento}</h6>
                              </div>  
                         </div>



                    </div>
               </Link>
          </div>
    )
}