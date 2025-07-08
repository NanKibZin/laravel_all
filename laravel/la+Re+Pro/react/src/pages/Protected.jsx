import React, { useEffect } from 'react'
import { useNavigate } from 'react-router-dom';

function Protected() {
  useEffect(()=>{
    if(localStorage.getItem('user-info')){
      navigate('/add');
    }
  })
  const navigate = useNavigate();
  return (

    <div>
      <h1>Login Page</h1>
    </div>
  )
}

export default Protected
