import { BrowserRouter, Routes, Route } from 'react-router-dom'
import Header from './components/layouts/Header'
import Home from './components/Home'
import Produ from './components/produs/Produ'
import Cart from './components/cart/Cart'

function App() {

  return (
    <BrowserRouter>
      <Header/>
      <Routes>
        <Route path='/' element={<Home/>}/>  {/* se muestra el componete home en direc raiz */}
        <Route path='/produ/:id' element={<Produ/>}/>
        <Route path='/cart' element={<Cart/>}/>
      </Routes>
    </BrowserRouter>    
  )
}

export default App  
 