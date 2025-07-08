import React, { useState } from 'react';
import { createProduct } from '../services/productService'; // Make sure this path is correct
import { useNavigate } from 'react-router-dom';

const AddProduct = () => {
  const [productNote, setProductNote] = useState('');
  const [productImage, setProductImage] = useState(null); // State to hold the image
  const navigate = useNavigate();
  
  const [error, setError] = useState(null);
  const [loading, setLoading] = useState(false);

  const handleImageChange = (e) => {
    const file = e.target.files[0];
    if (file) {
      setProductImage(file);
    }
  };

  const handleSubmit = async (e) => {
    e.preventDefault();

    const formData = new FormData();
    formData.append('name', e.target.name.value);
    formData.append('image', productImage); // Append the image file
    formData.append('qty', e.target.qty.value);
    formData.append('price', parseFloat(e.target.price.value));
    formData.append('note', productNote);

    try {
      setLoading(true);
      const response = await createProduct(formData); // Pass FormData to the API
      if (response.status === 201) {
        navigate('/');
      }
    } catch (error) {
      setError('Failed to add product');
    } finally {
      setLoading(false);
    }
  };

  return (
    <div>
      <div className="d-flex justify-content-between align-items-center">
        <h2>Create Product</h2>
        <a href="/" className="btn btn-danger btn-sm">Back</a>
      </div>

      {error && <div className="alert alert-danger mt-3">{error}</div>}

      <form onSubmit={handleSubmit} className="p-3 shadow-sm" encType="multipart/form-data">
        <div className="form-group mb-3">
          <label htmlFor="productName">Product Name</label>
          <input
            type="text"
            className="form-control"
            name="name"
            placeholder="Enter product name"
          />
        </div>

        <div className="form-group mb-3">
          <label htmlFor="productImage">Product Image</label>
          <input
            type="file"
            className="form-control"
            id="productImage"
            accept="image/*"
            onChange={handleImageChange} // Handle file change
          />
        </div>

        <div className="form-group mb-3">
          <label>Product Quantity</label>
          <input
            type="number"
            className="form-control"
            name="qty"
            placeholder="Enter quantity"
          />
        </div>

        <div className="form-group mb-3">
          <label>Product Price</label>
          <input
            type="number"
            step="0.01"
            className="form-control"
            name="price"
            placeholder="Enter price"
          />
        </div>

        <div className="form-group mb-3">
          <label htmlFor="productNote">Product Note</label>
          <textarea
            className="form-control"
            id="productNote"
            value={productNote}
            onChange={(e) => setProductNote(e.target.value)}
            placeholder="Enter any notes"
          />
        </div>

        <button type="submit" className="btn btn-primary" disabled={loading}>
          {loading ? 'Saving...' : 'Save'}
        </button>
      </form>
    </div>
  );
};

export default AddProduct;
