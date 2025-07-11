import React from 'react'
import ProdusListItem from './ProduListItem'
 
export default function ProdusList({ produs}) {
    return (
        <div className='row my-5'>
            {
                produs?.map(produ =>(
                    <ProdusListItem produ={produ} key={produ.id}/>
                ))
            }
        </div>
    )
} 