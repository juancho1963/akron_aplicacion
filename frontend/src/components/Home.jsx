import React, { useEffect, useState } from 'react'
import ProdusList from './produs/ProdusList'
import { axiosRequest } from './helpers/config'
import { useDebounce } from 'use-debounce'
import Alert from './layouts/Alert'
import Spinner from './layouts/Spinner'

export default function Home() {
    const [produs, setProdus] = useState([])
    const [marcas, setMarcas] = useState([])
    const [loading, setLoading] = useState(false)

    const [selectMarca, setSelectMarca] = useState('')
    const [searchTerm, setSearchTerm] = useState('')
    const [message, setMessage] = useState('')
    const debouncedSearchTerm = useDebounce(searchTerm, 1000)

    const handleMarcaSelectBox = (e) => {
       setSearchTerm('')
       setSelectMarca(e.target.value)
    }

    const clearFilter = () => {
        setSelectMarca('')
    }  

    useEffect(() => {
        const fetchAllProdus = async () => {
            setMessage('')
            setLoading(true)
            try {
                if(selectMarca) {
                    const response = await axiosRequest.get(`produs/${selectMarca}/marca`)
                    setProdus(response.data.data)
                    setMarcas(response.data.marcas)
                    setLoading(false)
                }else if (debouncedSearchTerm[0]) {
                    const response = await axiosRequest.get(`produs/${searchTerm}/find`)
                    if(response.data.data.length > 0) {
                        setProdus(response.data.data)
                        setMarcas(response.data.marcas)
                        setLoading(false)
                    }else{
                        setMessage('Lo sentimos, no hemos encontrado productos que coincidan con tu busqueda.')
                        setLoading(false)
                    }
                }else{
                    const response = await axiosRequest.get('produs')
                    setProdus(response.data.data)
                    setMarcas(response.data.marcas)
                    setLoading(false)
                }

            } catch (error) {
                 console.log(error)
            }
        }
       
        fetchAllProdus()
    },[selectMarca, debouncedSearchTerm[0]])

    return(
        <div className='row my-5'>
            <div className='col-md-12'>
                <div className='row'>
                    <div className='col-md-8 mx-auto'>
                        <div className='row'>

                            <div className='col-md-4 mb-2'>
                                <div className='mb-2'>
                                    <span className='fw-bold'>
                                        Filtrar por Marca:
                                    </span>
                                </div>
                                <select name="marca_id" id="marca_id"
                                        defaultValue=""
                                        onChange={(e)=> handleMarcaSelectBox(e)}
                                        disabled={searchTerm}
                                        className='form-select'
                                >
                                    <option value="" disabled={!selectMarca}
                                        onChange={() => clearFilter}
                                    >
                                        Todas las Marcas
                                    </option>
                                    {
                                        marcas.map(marca => (
                                            <option value={marca.id} key={marca.id}>
                                                {marca.name}
                                            </option>
                                        ))
                                    }
                                 </select>
                            </div>

                            <div className='col-md-4 mb-2'>
                                <div className='mb-2'>
                                    <span className='fw-bold'>
                                        Buscar producto:
                                    </span>
                                </div>
                                <form className='d-flex'>
                                    <input type="search" className='form-control me-2'
                                        value={searchTerm}
                                        disabled={selectMarca}
                                        onChange={(e) => setSearchTerm(e.target.value)}
                                        placeholder='Buscar...' />
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {
                    message ?
                    <Alert type="primary" content={message}/>
                    :
                    loading ?
                    <Spinner/>
                    :
                    <ProdusList produs={produs}/>  
                }
               
            </div>
        </div>
       
    ) 
}