import { useState, useEffect } from "react";
import { getProducts, deleteProduct } from "../services/productService"; // Import service functions

const useProducts = () => {
    const [products, setProducts] = useState([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);

    useEffect(() => {
        fetchProducts();
    }, []);

    const fetchProducts = async () => {
        try {
            const data = await getProducts(); // Call service function
            setProducts(data);
        } catch (err) {
            setError("Failed to load products.");
            console.error(err);
        } finally {
            setLoading(false);
        }
    };

    const handleDelete = async (id) => {
        try {
            await deleteProduct(id); 
            setProducts(products.filter((product) => product.id !== id));
        } catch (err) {
            setError("Failed to delete product.");
            console.error(err);
        }
    };

    return { products, loading, error, fetchProducts, handleDelete };
};

export default useProducts;
