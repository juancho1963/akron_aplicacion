import React, { useRef, useState } from 'react'
import { useDispatch, useSelector } from 'react-redux'
import { axiosRequest, getConfig } from '../../helpers/config'
import { setCurrentUser } from '../../../redux/slices/userSlice'
import { toast } from 'react-toastify'
import useValidations from '../../custom/useValidations'
import { Link } from 'react-router-dom'

export default function ProfileSidebar() {
    const { user, token } = useSelector(state => state.user)
        const [image, setImage] = useState('')
        const [validationErrors, setValidationErrors] = useState([])
        const [loading, setLoading] = useState(false)
        const dispatch = useDispatch()
        const fileInput =useRef()
    
        const updateProfileImage = async () => {
            setValidationErrors([])
            setLoading(true)
            const formData = new FormData()
            formData.append('profile_image', image)
            formData.append('_method', 'PUT')
            try {
                const response = await axiosRequest.post('user/profile/update',
                    formData,getConfig(token, 'multipart/form-data'))
                    dispatch(setCurrentUser(response.data.user))
                    setImage('')
                    setLoading(false)
                    fileInput.current.value=''
                    toast.success(response.data.message)
            } catch (error) {
                if(error?.response?.status === 422){
                    setValidationErrors(error.response.data.errors)
                }
                console.log(error)
                setLoading(false)
            }
        }
    return (
        <div className='col-md-4'>
            <div className='card p-3 shadow-sw'>
                <h6 className='text-dark fw-bold m-3'>
                    Foto de perfil
                </h6>
                <div className='d-flex flex-column justify-content-center align-item-center'>
                    <img src={user?.profile_image} alt={user?.name}
                        width={120}
                        height={120}
                        className='rounded-circle img-thumbnail m-3'
                    />
                    <div className='input-group mb-3 w-100'>
                        <input type="file"
                            accept='image/*'
                            ref={fileInput}
                            onChange={(e) => setImage(e.target.files[0])}
                            className='form-control form-control-sm'
                        />
                        <button className='btn btn-sm btn-warning'
                            disabled={!image}
                            onClick={() => updateProfileImage()}
                        >
                            {loading ? "Subiendo..." : "Cambiar foto"}
                        </button>
                    </div>
                    {
                        useValidations(validationErrors, "profile_image") && (
                            <span className='text-danger small'>
                                {useValidations(validationErrors, "profile_image")}
                            </span>
                        )
                    }
                </div>
                <div className='text-left'>
                    <h6 className='text-dark fw-bold m-3'>
                        Datos personales
                    </h6>
                    <ul className='list-group w-100'>
                        <li className='list-group-item'>
                            <label className='form-label fw-bold mb-0'>Nombres</label>
                            <p className='text-muted mb-0'>{user?.name || "Nombres no disponibles"}</p>
                        </li>
                        <li className='list-group-item'>
                            <label className='form-label fw-bold mb-0'>Correo electrónico</label>
                            <p className='text-muted mb-0'>{user?.email || "Correo electrónico no disponibles"}</p>
                        </li>
                        <li className='list-group-item'>
                            <Link to="/user/pedids" className='text-decoration-none text-dark'>
                                <i className='bi bi-bag-check-fill'></i> Pedidos
                            </Link>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    )
}