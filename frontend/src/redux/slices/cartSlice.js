import { createSlice } from "@reduxjs/toolkit"
import { toast } from 'react-toastify'

const initialState = {
    cartItems: [],
    validCupon: {
        name: '',
        descuento: 0
    }
}

export const cartSlice = createSlice({
    name: 'cart',
    initialState,
    reducers: {
        addToCart(state,action){
            const item = action.payload
            let produItem = state.cartItems.find(produ => produ.produ_id === item.produ_id
                && produ.color === item.marca === item.size
            )
            if (produItem) {
                toast.info('Este producto ya esta en tu carrito.')
            }else {
                state.cartItems = [item,...state.cartItems]
                toast.success('El producto ha sido añadido a tu carrito.')
            }
        },
        incrementCantidad(state,action){
            const item = action.payload
            let produItem = state.cartItems.find(produ => produ.produ_id === item.produ_id
                && produ.marca === item.marca
            )
            if (produItem.cantidad === produItem.maxCantidad) {
                toast.info(`Solo contamos con ${produItem.maxCantidad} productos disponible.`)
            }else {
                produItem.cantidad += 1
            }
        },
        decrementCantidad(state,action){
            const item = action.payload
            let produItem = state.cartItems.find(produ => produ.produ_id === item.produ_id
                && produ.marca === item.marca
            )
            produItem.cantidad -= 1
            if (produItem.cantidad === 0) {
                state.cartItems = state.cartItems.filter(produ => produ.produ_id !== item.produ_id
                || produ.marca !== item.marca)            
            }
        },
        removeFromtCantidad(state, action){
            const item = action.payload

            state.cartItems = state.cartItems.filter(produ => produ.produ_id !== item.produ_id
                || produ.marca !== item.marca)
            toast.warning('El producto ha sido eliminado del carrito de compras.')           
            
        },
        setValidCupon(state, action){
            state.validCupon = action.payload
        },
        addCuponIdToCartItem(state, action){
            const cupon_id = action.payload
            state.cartItems = state.cartItems.map(item => {
                return {...item, cupon_id}
            })
        },
        clearCartItems(state, action){
            state.cartItems = []
        }
    }
})

const cartReducer = cartSlice.reducer
export const { addToCart, incrementCantidad, decrementCantidad, removeFromtCantidad,
                setValidCupon, addCuponIdToCartItem, clearCartItems
 } = cartSlice.actions
export default cartReducer

