import { BrowserRouter as Router, Routes, Route } from "react-router-dom";

import Master from "../layout/Master";
import ProductList from "../pages/ProductList";
import AddProduct from "../pages/AddProduct";
import EditProduct from "../pages/EditProduct";


const AppRoutes = () => {
    return (
        <Router>
            <Routes>
                <Route path="/" element={<Master/>}>
                    <Route index element={<ProductList />} />
                    <Route path="add-product" element={<AddProduct />} />
                    <Route path="edit-product/:id" element={<EditProduct />} />
                </Route>
            </Routes>
        </Router>
    );
};

export default AppRoutes;
