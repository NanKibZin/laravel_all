import React from 'react'
import { Outlet } from 'react-router-dom'
import './style.css';

const Master = () => {
  return (
    <div>
        <header className=' bg-dark text-center text-center p-3 text-light'>
            <h1>React + Laravel</h1>
        </header>
        <main className='container my-5'>
            <Outlet />
        </main>
    </div>
  )
}

export default Master