import React, { useEffect } from 'react'
import ProfileSidebar from './partials/ProfileSidebar'
import UpdateUserInfos from './partials/UpdateUserInfos'
import { useNavigate } from 'react-router-dom'
import { useSelector } from 'react-redux'


export default function Profile() {
    const { isLoggedIn, } = useSelector(state => state.user)
    const navigate = useNavigate()

    useEffect(() => {
        if (!isLoggedIn) navigate('/login')
    }, [isLoggedIn])
    return (
        <div className='row my-5 justify-content-center'>
            <ProfileSidebar />
            <UpdateUserInfos profile={true} />
        </div>
    )
}