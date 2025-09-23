import React, { useEffect } from 'react'
import { useSelector } from 'react-redux'
import { Link, useLocation,  } from 'react-router-dom'
import { useDispatch } from 'react-redux'
import { axiosRequest, getConfig } from '../helpers/config'
import { setCurrentUser, setLoggedInOut, setToken } from '../../redux/slices/userSlice'

export default function Header() {
    const { cartItems } = useSelector(state => state.cart)
    const { isLoggedIn, token, user } = useSelector(state => state.user)
    const dispatch = useDispatch()
    const location = useLocation

    useEffect(() => {
        const getLoggedInUser = async () => {
            try {
                const response =await axiosRequest.get('user', getConfig(token))
                dispatch(setCurrentUser(response.data.user))
            } catch (error) {
                if(error?.response?.status === 401){
                    dispatch(setCurrentUser(null))
                    dispatch(setToken(''))
                    dispatch(setLoggedInOut(false))
                }
                console.log(error)
            }
        }
        if(token) getLoggedInUser()
    }, [token])

    const logoutUser = async () => {
        try {
            const response =await axiosRequest.post('user/logout',null, getConfig(token))
                dispatch(setCurrentUser(null))
                dispatch(setToken(''))
                dispatch(setLoggedInOut(false))
        } catch (error) {
            console.log(error)
        }
    }
    

    return (
        <nav className="navbar navbar-expand-lg"style={{borderBottom: '2px solid #ddd'}}>
            <div className="container-fluid">
                <Link className="navbar-brand" to="/">Aplicación AKRON</Link>
                <button className="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span className="navbar-toggler-icon"></span>
                </button>
                <div className="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul className="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li className="nav-item">
                            <Link className={`nav-link ${location.patname === '/' &&'active'}`} aria-current="page" to="/">Inicio</Link>
                        </li>
                        <li className="nav-item">
                            <Link className={`nav-link ${location.patname === '/cart' &&'active'}`} to="/cart">Carrito({cartItems.length})</Link>
                        </li>
                    </ul>
                    <ul className='navbar-nav ms-auto'>
                        {
                            isLoggedIn ?
                            <>
                            <li className="nav-item">
                                <Link className={`nav-link ${location.pathname === '/profile' && 'active'}`} to="/profile">
                                <i className='bi bi-person-square'></i>
                                {user.name}</Link>
                            </li>
                            <li className="nav-item">
                                <Link className="nav-link" to="#" onClick={() => logoutUser()}>
                                <i className='bi bi-door-open-fill'></i>
                                Salir</Link>
                            </li>
                            </>
                            :
                            <>
                            <li className="nav-item">
                                <Link className={`nav-link ${location.pathname === '/register' && 'active'}`} to="/register">Registro</Link>
                            </li>
                            <li className="nav-item">
                                <Link className={`nav-link ${location.pathname === '/login' && 'active'}`} to="/login">Login</Link>
                            </li>
                            </>
                        }
                    </ul>


                </div>
            </div>
        </nav>
    )
}