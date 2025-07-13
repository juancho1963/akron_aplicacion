import React from 'react'
import { ThreeCircles } from 'react-loader-spinner'

export default function Spinner() {
    return (
        <div className='d-flex justify-content-center my-5'>
            <ThreeCircles
            visible={true}
            height="100"
            width="100"
            color="#133E87"
            ariaLabel="three-circles-loading"
            />
        </div>
    )
}
