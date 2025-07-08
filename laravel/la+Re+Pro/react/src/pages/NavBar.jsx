import Button from 'react-bootstrap/Button';
import Container from 'react-bootstrap/Container';
import Form from 'react-bootstrap/Form';
import Nav from 'react-bootstrap/Nav';
import Navbar from 'react-bootstrap/Navbar';
import NavDropdown from 'react-bootstrap/NavDropdown';
import { Link } from 'react-router-dom';
import { useNavigate } from 'react-router-dom';

function NavBar() {
  let u=JSON.parse(localStorage.getItem('user-info'));
  console.warn("user",u)
  const navigate = useNavigate();
  const logout=()=>{
    localStorage.clear();
    navigate('/login')
    
  }
  return (
    <Navbar expand="lg" className="bg-primary mt-3 fw-bold text-white fs-2">
      <Container fluid>
        <Navbar.Toggle aria-controls="navbarScroll" />
        <Navbar.Collapse id="navbarScroll">
          <Nav
            className="me-auto my-2 my-lg-0 fs-2 text-white me-3"
            style={{ maxHeight: '100px' }}
            navbarScroll
          >{
            localStorage.getItem('user-info')?
            <>
             <Link to="/" className='text-white me-3 text-decoration-none'>List </Link>
             <Link to="/update" className='text-white me-3 text-decoration-none'>Update </Link>
             <Link to="/add" className='text-white me-3 text-decoration-none'>Add</Link>
            </>:
            <>
           
             <Link to="/login" className='text-white me-3 text-decoration-none'>Login</Link>
             <Link to="/register" className='text-white me-3 text-decoration-none'>Register</Link>
            </>
          }
           
           
            {/* <Nav.Link href="#action2" className='text-white'>Link</Nav.Link> */}
            
          </Nav>
          {localStorage.getItem('user-info') ? (
      //  <NavDropdown className="" title={u && u.user.name} id="basic-nav-dropdown">
    
    <NavDropdown.Item onClick={logout}>Logout</NavDropdown.Item>
  // </NavDropdown>
) : null}

          <Form className="d-flex">
            <Form.Control
              type="search"
              placeholder="Search"
              className="me-2"
              aria-label="Search"
            />
            <Button variant="outline-success text-white">Search</Button>
          </Form>
        </Navbar.Collapse>
      </Container>
    </Navbar>
  );
}

export default NavBar;