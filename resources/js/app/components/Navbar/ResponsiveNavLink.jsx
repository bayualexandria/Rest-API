import { Menu } from "@headlessui/react";
import React from "react";

export default function ResponsiveNavLink({ children, href, className }) {
    return (
        <Menu.Item>

        <a
            href={href}
            className={`${
                className ? className : ""
            } block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-black`}
        >
            {children}
        </a>
        </Menu.Item>
    );
}
