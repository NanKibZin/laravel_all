import React, { useState } from 'react'

function AddProduct() {
 const [name,setName]=useState("");
 const [price,setPrice]=useState("");
 const [des,setDes]=useState("");
 const [image,setImage]=useState("");
 const [qty,setQty]=useState("");

  return (
    <div>
      <h1>Add Product</h1>
      <form style={{ maxWidth: "300px", margin: "auto" }}>
      <input
        type="text"
        name="name"
        placeholder="name"
        onChange={(e)=>setName(e.target.value)}
        style={{ display: "block", marginBottom: "10px", width: "100%" }}
      />
      <input
        type="file"
        name="file"
        onChange={(e)=>setImage(e.target.value)}
        style={{ display: "block", marginBottom: "10px", width: "100%" }}
      />
      <input
        type="text"
        name="price"
        placeholder="price"
        onChange={(e)=>setPrice(e.target.value)}
        style={{ display: "block", marginBottom: "10px", width: "100%" }}
      />
      <input
        type="text"
        name="description"
        placeholder="description"
        onChange={(e)=>setDes(e.target.value)}
        style={{ display: "block", marginBottom: "10px", width: "100%" }}
      />
      <button type="button" style={{ backgroundColor: "#007bff", color: "white", padding: "10px", border: "none", width: "100%" }}>
        Add Product
      </button>
    </form>
    </div>
  )
}

export default AddProduct
