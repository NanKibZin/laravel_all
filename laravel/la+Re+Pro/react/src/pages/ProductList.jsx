// import React, { useEffect, useState } from 'react'
// import { Table } from 'react-bootstrap';

// const ProductList = () => {
//     const [data,setData]=useState([]);
//     useEffect( ()=>{
//         const fetchData= async ()=>{
//             let result= await fetch("http://127.0.0.1:8000/api/list");
//             result=await result.json();
//             setData(result);
//         };
//         fetchData();
//     },[])
//   return (
//     <div>
//       <Table>
//         {data.map((itme)=>
//       <tr key={itme.id}>
//           <td>{itme.id}</td>
//           <td>{itme.name}</td>
//           <td>
//             <img src={itme.image}/>
//           </td>
//           <td>{itme.des}</td>
//         </tr>
//     )}
//       </Table>
//     </div>
//   )
// }

// export default ProductList
import React, { useEffect, useState } from 'react';
import { Table } from 'react-bootstrap';

const ProductList = () => {
  const [data, setData] = useState([]);

  useEffect(() => {
    const fetchData = async () => {
      let result = await fetch("http://127.0.0.1:8000/api/list");
      result = await result.json();
      setData(result.products);
    };
    fetchData();
  }, []);

  return (
    <div>
      <h2>Product list</h2>
      <Table striped bordered hover>
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Image</th>
            <th>Description</th>
          </tr>
        </thead>
        <tbody>
          {data.map((item) => (
            <tr key={item.id}>
              <td>{item.id}</td>
              <td>{item.name}</td>
              <td>
                <img src={item.image} alt={item.name} width="100" />
              </td>
              <td>{item.des}</td>
            </tr>
          ))}
        </tbody>
      </Table>
    </div>
  );
};

export default ProductList;
