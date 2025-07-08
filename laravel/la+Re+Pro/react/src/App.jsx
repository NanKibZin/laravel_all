import React from 'react'
import {Button} from "react-bootstrap"
import NavBar from './pages/Navbar'
import Login from './pages/Login'
import Register from './pages/Register'
import Update from './pages/Update'
import AddProduct from './pages/AddProduct'
import { BrowserRouter, Route, Routes } from 'react-router-dom'
import ProductList from './pages/ProductList'
function App() {
  return (
    <div className='container text-center mt-5'>
      <BrowserRouter>
      <h3>Thy Sodanan</h3>
      <button className='btn btn-danger'>Button</button>
      <NavBar></NavBar>
      <Routes>
      <Route path='/' element={<ProductList/>}></Route>
      <Route path='/Add' element={<AddProduct/>}></Route>
      <Route path='/update' element={<Update/>}></Route>
      <Route path='/login' element={<Login/>}></Route>
      <Route path='/register' element={<Register/>}></Route>
      </Routes>
      </BrowserRouter>
    </div>
  )
}

export default App
