import React from "react";

export default function NavLink({ href, children, className }) {
    return (
        <a
            
            href={href}
            className={`${
                className ? className : ""
            } px-4 py-2 text-gray-300 rounded-lg hover:text-white hover:bg-gray-700/40`}
        >
            {children}
        </a>
    );
}
