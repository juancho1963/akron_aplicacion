import { BrowserRouter, Routes, Route } from 'react-router-dom'
import Header from './components/layouts/Header'
import Home from './components/Home'

function App() {

  return (
    <BrowserRouter>
      <Header/>
      <Routes>
        <Route path='/' element={<Home/>}/>  {/* se muestra el componete home en direc raiz */}
      </Routes>
    </BrowserRouter>    
  )
}

export default App  
 