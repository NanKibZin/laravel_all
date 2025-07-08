import api from "./api";

export const getProducts = async () => {
    try {
        const response = await api.get("/product");
        let products = await response.data.products;
        return products;

    } catch (error) {
        console.error("Error fetching products:", error);
        throw error;
    }
};

export const getProductById = async (id) => {
    try {
        const response = await api.get(`/products/${id}`);
        return response.data;
    } catch (error) {
        console.error("Error fetching product:", error);
        throw error;
    }
};

export const createProduct = async (product) => {
    try {
        const response = await api.post("/product", product);
        return response;
    } catch (error) {
        console.error("Error adding product:", error);
        throw error;
    }
};

export const updateProduct = async (id, product) => {
    try {
        const response = await api.put(`/products/${id}`, product);
        return response.data;
    } catch (error) {
        console.error("Error updating product:", error);
        throw error;
    }
};

export const deleteProduct = async (id) => {
    try {
        await api.delete(`/products/${id}`);
    } catch (error) {
        console.error("Error deleting product:", error);
        throw error;
    }
};
