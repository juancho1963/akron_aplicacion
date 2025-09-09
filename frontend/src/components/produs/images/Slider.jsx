import React, { useEffect, useState } from 'react'
import ImageGallery from 'react-image-gallery'

export default function Slider({ produ }) {
        const [images, setImages] = useState([])
        const [loaded, setLoaded] = useState(false)

        useEffect(() => {
            handleProduImages()
        }, [])

        const handleProduImages = () => {
            let updateImages = [
                {
                    original: produ?.foto2,
                    foto: produ?.foto2,                    
                }
            ]
            if (produ?.foto3){
                updateImages = [
                    ...updateImages, {
                        original: produ?.foto3,
                        foto: produ?.foto3,
                    }
                ]
            }
            if (produ?.foto4){
                updateImages = [
                    ...updateImages, {
                        original: produ?.foto4,
                        foto: produ?.foto4,
                    }
                ]
            }
            setImages(updateImages)
            setLoaded(true)
        }
    return (
        <ImageGallery
            showPlayButton={loaded}
            showFullscreenButton={loaded}
            items={images}
        />
    )
}