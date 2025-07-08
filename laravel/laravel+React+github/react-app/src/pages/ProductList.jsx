import React, { useState, useEffect } from 'react';
import DataTable from 'react-data-table-component';  // Import DataTable
import { getProducts } from '../services/productService';

const ProductList = () => {
  const [products, setProducts] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  useEffect(() => {
    const fetchProducts = async () => {
      try {
        const data = await getProducts();
        setProducts(Array.isArray(data) ? data : []);
      } catch (err) {
        setError('Failed to fetch products');
        console.error('Error fetching products:', err);
      } finally {
        setLoading(false);
      }
    };

    fetchProducts();
  }, []);

  if (loading) {
    return <div>Loading...</div>;
  }

  if (error) {
    return <div>{error}</div>;
  }

  // Define columns for DataTable
  const columns = [
    {
      name: 'ID',
      selector: row => row.id,
      sortable: true,
    },
    {
      name: 'Image',
      selector: row => (
        <img src={row.image} alt={row.name} width="50" height="50" />
      ),
      sortable: false,
    },
    {
      name: 'Name',
      selector: row => row.name,
      sortable: true,
    },
    {
      name: 'Price',
      selector: row => `$${row.price}`,
      sortable: true,
    },
    {
      name: 'Actions',
      cell: row => (
        <div>
          <button className="btn btn-info mx-2">Edit</button>
          <button className="btn btn-danger mx-2">Delete</button>
        </div>
      ),
    },
  ];

  return (
    <div>
      <div className="d-flex justify-content-between align-items-center">
        <h2>Product List</h2>
        <a href="add-product" className="btn btn-success btn-sm">
          Add Product
        </a>
      </div>

      <DataTable
        title="Products"
        columns={columns}
        data={products}
        pagination
        highlightOnHover
        striped
        responsive
      />
    </div>
  );
};

export default ProductList;
