import React from "react";
import Nav from "../components/Navbar/Nav";

export default function App({ children }) {
    return (
        <div className="min-h-screen">
            <Nav />

            <div className="container px-5 md:px-10">{children}</div>
        </div>
    );
}
