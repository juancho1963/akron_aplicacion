import React, { useEffect, useState } from 'react'
import { useNavigate } from 'react-router-dom'
import { axiosRequest, getConfig } from '../../helpers/config'
import { toast } from 'react-toastify'
import { useDispatch, useSelector } from 'react-redux'
import { setCurrentUser } from '../../../redux/slices/userSlice'

export default function UpdateUserInfos({ profile }) {
    const { isLoggedIn, user, token } = useSelector(state => state.user)
    const [userInfos, setUserInfos] = useState({
        direcUser: user?.direcUser,
        zPostalUser: user?.zPostalUser,
        docIdenUser: user?.docIdenUser,
        numTelefoUser: user?.numTelefoUser,
    })

    const [loading, setLoading] = useState(false)
    const navigate = useNavigate()
    const dispatch = useDispatch()

    useEffect(() => {
        if (!isLoggedIn) navigate('/login')
    }, [isLoggedIn])

    const UpdateUserInfos = async (e) => {
        e.preventDefault()
        setLoading(true)

        try {
            const response = await axiosRequest.put('user/profile/update', userInfos, getConfig(token))
            dispatch(setCurrentUser(response.data.user))
            setLoading(false)
            toast.success(response.data.message)

        } catch (error) {
            console.log(error)
            setLoading(false)
        }
    }

    return (
        <div className='col-md-6'>
            <div className='card shadow-sm'>
                <div className='card-header bg-white'>
                    <h5 className='text-center mt-2'>
                     {profile ? 'Informacion personal' : 'Detalles de facturación'}
                    </h5>
                </div>
                <div className='card-body'>
                    <form className='mt-2' onSubmit={(e) => UpdateUserInfos(e)}>
                        <div className='mb-3'>
                            <label className='form-label'>Direccion de usuario</label>
                            <input type="text"
                                value={userInfos.direcUser || ''}
                                onChange={(e) => setUserInfos({
                                    ...userInfos, direcUser: e.target.value
                                })}
                                required
                                className='form-control' id='direcUser'
                            />
                        </div>

                        <div className='mb-3'>
                            <label className='form-label'>Zona Postal</label>
                            <input type="text"
                                value={userInfos.zPostalUser || ''}
                                onChange={(e) => setUserInfos({
                                    ...userInfos, zPostalUser: e.target.value
                                })}
                                required
                                className='form-control' id='zPostalUser'
                            />
                        </div>

                        <div className='mb-3'>
                            <label className='form-label'>Documento de Identidad</label>
                            <input type="text"
                                value={userInfos.docIdenUser || ''}
                                onChange={(e) => setUserInfos({
                                    ...userInfos, docIdenUser: e.target.value
                                })}
                                required
                                className='form-control' id='docIdenUser'
                            />
                        </div>

                        <div className='mb-3'>
                            <label className='form-label'>Numero telefonico</label>
                            <input type="text"
                                value={userInfos.numTelefoUser || ''}
                                onChange={(e) => setUserInfos({
                                    ...userInfos, numTelefoUser: e.target.value
                                })}
                                required
                                className='form-control' id='numTelefoUser'
                            />
                        </div>

                        {
                            loading ?
                                <button type='submit' className='btn btn-dark btn-sm float-end'>
                                    <span className='spinner-border spinner-border-sm me-2'></span>
                                    Registrando...
                                </button>
                                :
                                !user?.datoCompleUser || profile ?
                                    <button type='submit' className='btn btn-dark btn-sm float-end'>
                                        Registrar
                                    </button>
                                    : ''
                        }
                    </form>
                </div>
            </div>
        </div>
    )
}                                                           

