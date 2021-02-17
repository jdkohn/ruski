import React from "react";
import Navbar from "react-bootstrap/Navbar";
import Nav from "react-bootstrap/Nav";
import ato from "../img/ato.jpg";

export default function NavBar() {
  return (
    <Navbar bg="primary" variant="dark">
      {/* <img
        src={ato}
        alt="Tau Logo"
        style={{ maxWidth: "100%", maxHeight: "100%" }}
      /> */}
      <Navbar.Brand>Durham Ruski Club</Navbar.Brand>
      {/* <Nav className="mr-auto">
        <Nav.Link href="#halloffame">Hall of Fame</Nav.Link>
        <Nav.Link href="#bracket">Bracket</Nav.Link>
        <Nav.Link href="#rules">Rules</Nav.Link>
      </Nav> */}
    </Navbar>
  );
}
