import React, {useState} from 'react'
import ProdusListItem from './ProduListItem'
 
export default function ProdusList({ produs }) {
   const [produsToShow, setProdusToShow] = useState(3)

    const loadMoreProdus = () => {
        if (produsToShow > produs?.length) {
            return;
        }else {
            setProdusToShow(prevProdusToShow => prevProdusToShow += 3)
        }
    }
    return (
        <div className='row my-5'>
            {
                produs?.slice(0,produsToShow).map(produ =>(
                    <ProdusListItem produ={produ} key={produ.id}/>
                ))
            }
            {
                produsToShow < produs.length &&
                <div className='d-flex justify-content-center my-3'>
                    <button className='btn btn-sm btn-dark'
                        onClick={() => loadMoreProdus()}
                    >
                        <i className='bi bi-arrow-clockwise'></i>{" "}
                        Cargar mas
                    </button>
                </div>
            }
        </div>
    )
}