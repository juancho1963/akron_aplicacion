import { BrowserRouter, Routes, Route } from 'react-router-dom'
import Header from './components/layouts/Header'
import Home from './components/Home'
import Produ from './components/produs/Produ'
import Cart from './components/cart/Cart'
import Checkout from './components/checkout/Checkout'
import Login from './components/user/Login'
import Register from './components/user/Register'
import Profile from './components/user/Profile'
import PayByStripe from './components/checkout/PayByStripe'
import PayByTransferencia from './components/checkout/PayByTransferencia'
/* import UserPedid from './components/user/UserPedid' */

function App() {

  return (
    <BrowserRouter>
      <Header />
      <Routes>
        <Route path='/' element={<Home />} />  {/* se muestra el componete home en direc raiz */}
        <Route path='/produ/:id' element={<Produ />} />
        <Route path='/cart' element={<Cart />} />
        <Route path='checkout' element={<Checkout />}/>       
        <Route path='/login' element={<Login />} />
        <Route path='/register' element={<Register />} />
        <Route path='/profile' element={<Profile />} />
        <Route path='/pay/pedid' element={<PayByStripe />} />
        <Route path='/pay/transferencia' element={<PayByTransferencia />} />

      {/*   <Route path='r/user/pedids' element={<UserPedid />} />  */}
      </Routes>
    </BrowserRouter>    
  )
}

export default App  
 