import { createContext, useState, useEffect } from "react";
import api from "../services/api";
// import api from "api";

export const ProductContext = createContext();

export const ProductProvider = ({ children }) => {
    const [products, setProducts] = useState([]);

    useEffect(() => {
        fetchProducts();
    }, []);

    const fetchProducts = async () => {
        try {
            const response = await api.get("http://127.0.0.1:8000/api/products");
            setProducts(response.data);
        } catch (error) {
            console.error("Error fetching products:", error);
        }
    };

    const addProduct = async (product) => {
        try {
            const response = await api.post("http://127.0.0.1:8000/api/products", product);
            setProducts([...products, response.data]);
        } catch (error) {
            console.error("Error adding product:", error);
        }
    };

    const deleteProduct = async (id) => {
        try {
            await api.delete(`http://127.0.0.1:8000/api/products/${id}`);
            setProducts(products.filter((product) => product.id !== id));
        } catch (error) {
            console.error("Error deleting product:", error);
        }
    };

    return (
        <ProductContext.Provider value={{ products, fetchProducts, addProduct, deleteProduct }}>
            {children}
        </ProductContext.Provider>
    );
};
