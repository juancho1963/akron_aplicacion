import { createRoot } from 'react-dom/client'
import App from './App.jsx'

import 'bootstrap/dist/css/bootstrap.min.css'
import 'bootstrap/dist/js/bootstrap.min.js'
import 'bootstrap-icons/font/bootstrap-icons.css'
import 'react-toastify/dist/ReactToastify.css'

import './index.css'

import { ToastContainer } from 'react-toastify';

createRoot(document.getElementById('root')).render(
  <div className='container card shadow-sm my-4'>nota main jsx
    <ToastContainer position='right'/>
    <App />
  </div>
 
) 