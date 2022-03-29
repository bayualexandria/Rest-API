import { Dialog, Menu, Transition } from "@headlessui/react";
import axios from "axios";
import { Fragment, useState } from "react";
import NavLink from "./NavLink";
import ResponsiveNavLink from "./ResponsiveNavLink";

export default function Nav() {
    const [loading, setLoading] = useState(false);
    const [isOpen, setIsOpen] = useState(false);
    const user = JSON.parse(localStorage.getItem("user"));
    function closeModal() {
        setIsOpen(false);
    }

    function openModal() {
        setIsOpen(true);
    }

    const logoutLink = async (e) => {
        e.preventDefault();
        console.log("success");
        await axios.post("http://127.0.0.1:8000/logout");
        setLoading(true);
        setTimeout(() => {
            localStorage.clear();
            return (document.location.href = "/login");
        }, 3000);
    };

    return (
        <div className="bg-blue-500">
            {/* Modal */}

            <Transition appear show={isOpen} as={Fragment}>
                <Dialog
                    as="div"
                    className="fixed inset-0 z-10 overflow-y-auto"
                    onClose={closeModal}
                >
                    <div className="min-h-screen px-4 text-center">
                        <Transition.Child
                            as={Fragment}
                            enter="ease-out duration-300"
                            enterFrom="opacity-0"
                            enterTo="opacity-100"
                            leave="ease-in duration-200"
                            leaveFrom="opacity-100"
                            leaveTo="opacity-0"
                        >
                            <Dialog.Overlay className="fixed inset-0" />
                        </Transition.Child>

                        {/* This element is to trick the browser into centering the modal contents. */}
                        <span
                            className="inline-block h-screen align-middle"
                            aria-hidden="true"
                        >
                            &#8203;
                        </span>
                        <Transition.Child
                            as={Fragment}
                            enter="ease-out duration-300"
                            enterFrom="opacity-0 scale-95"
                            enterTo="opacity-100 scale-100"
                            leave="ease-in duration-200"
                            leaveFrom="opacity-100 scale-100"
                            leaveTo="opacity-0 scale-95"
                        >
                            <div className="inline-block w-full max-w-md p-6 my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-xl rounded-2xl">
                                <Dialog.Title
                                    as="div"
                                    className="flex items-center justify-center"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        className="w-16 h-16 text-red-500 animate-bounce"
                                        viewBox="0 0 20 20"
                                        fill="currentColor"
                                    >
                                        <path
                                            fillRule="evenodd"
                                            d="M10 1.944A11.954 11.954 0 012.166 5C2.056 5.649 2 6.319 2 7c0 5.225 3.34 9.67 8 11.317C14.66 16.67 18 12.225 18 7c0-.682-.057-1.35-.166-2.001A11.954 11.954 0 0110 1.944zM11 14a1 1 0 11-2 0 1 1 0 012 0zm0-7a1 1 0 10-2 0v3a1 1 0 102 0V7z"
                                            clipRule="evenodd"
                                        />
                                    </svg>
                                </Dialog.Title>
                                <div className="mt-2 text-center">
                                    <p className="text-sm text-gray-500">
                                        {loading
                                            ? "Loading ..."
                                            : "Apakah anda ingin keluar dari sistem ini?"}
                                    </p>
                                </div>
                                {loading ? (
                                    <div className="flex items-center justify-center px-20 mt-8">
                                        <i className="text-green-600 fas fa-spinner animate-spin"></i>
                                    </div>
                                ) : (
                                    <div className="flex items-center mt-4 justify-evenly">
                                        <button
                                            type="button"
                                            onClick={closeModal}
                                            className="inline-flex justify-center px-4 py-2 text-sm font-medium text-blue-900 bg-blue-100 border border-transparent rounded-md hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-blue-500"
                                            // onClick={closeModal}
                                        >
                                            Tidak
                                        </button>
                                        <form
                                            method="post"
                                            onSubmit={logoutLink}
                                        >
                                            <button
                                                type="submit"
                                                className="inline-flex justify-center px-4 py-2 text-sm font-medium text-red-900 bg-red-100 border border-transparent rounded-md hover:bg-red-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-red-500"
                                                // onClick={closeModal}
                                            >
                                                Ya
                                            </button>
                                        </form>
                                    </div>
                                )}
                            </div>
                        </Transition.Child>
                    </div>
                </Dialog>
            </Transition>

            {/* Mobile */}
            <div className="w-full md:hidden">
                <div className="px-4 py-4 border-b border-gray-800">
                    <div className="flex items-center justify-between">
                        <a
                            href=""
                            className="mr-6 font-medium text-white uppercase"
                        >
                            b4yu 4lex@ndr!4
                        </a>

                        <Menu
                            as="div"
                            className="w-auto px-2 font-medium text-white "
                        >
                            <Menu.Button className="border-gray-400 rounded-full w-9 order h-9">
                                <img src="/images/default.png" alt="" />
                            </Menu.Button>

                            <Transition
                                as={Fragment}
                                enter="transition ease-out duration-100"
                                enterFrom="transform opacity-0 scale-95"
                                enterTo="transform opacity-100 scale-100"
                                leave="transition ease-in duration-75"
                                leaveFrom="transform opacity-100 scale-100"
                                leaveTo="transform opacity-0 scale-95"
                            >
                                <Menu.Items className="absolute top-0 right-0 w-40 py-2 mr-4 overflow-hidden bg-white rounded-lg mt-14">
                                    <ResponsiveNavLink>
                                        {user.name}
                                    </ResponsiveNavLink>
                                    <ResponsiveNavLink
                                        href="/blogs"
                                        children="Setting"
                                    />

                                    <button
                                        onClick={openModal}
                                        className="w-full text-left"
                                    >
                                        <ResponsiveNavLink>
                                            Logout
                                        </ResponsiveNavLink>
                                    </button>
                                </Menu.Items>
                            </Transition>
                        </Menu>
                    </div>
                </div>
            </div>

            {/* Desktop */}
            <div className="fixed bottom-0 w-full md:hidden">
                <div className="px-5 py-5">
                    <div className="px-2 py-2 bg-white border rounded-lg shadow-md ty-2ext-gray-600">
                        <div className="flex items-center justify-between px-3">
                            <a
                                href="/home"
                                className="flex flex-col items-center justify-center w-auto px-2 py-1 text-gray-600 transition duration-200 border-none rounded active hover:border hover:border-gray-600 hover:ring hover:bg-gray-400 focus:ring focus:ring-gray-300 hover:ring-gray-300 hover:text-white "
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    className="w-6 h-6 "
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        strokeLinecap="round"
                                        strokeLinejoin="round"
                                        strokeWidth={2}
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                                    />
                                </svg>
                                <p className="text-sm font-sm">Home</p>
                            </a>

                            <a
                                href="/blogs"
                                className="flex flex-col items-center justify-center w-auto px-2 py-1 text-gray-600 transition duration-200 border-none rounded hover:border hover:border-gray-600 hover:ring hover:bg-gray-400 focus:ring focus:ring-gray-300 hover:ring-gray-300 hover:text-white "
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    className="w-6 h-6"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        strokeLinecap="round"
                                        strokeLinejoin="round"
                                        strokeWidth={2}
                                        d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"
                                    />
                                </svg>
                                <p className="text-sm font-sm">Blogs</p>
                            </a>

                            <a
                                href="/categories"
                                className="flex flex-col items-center justify-center w-auto px-2 py-1 text-gray-600 transition duration-200 border-none rounded hover:border hover:border-gray-600 hover:ring hover:bg-gray-400 focus:ring focus:ring-gray-300 hover:ring-gray-300 hover:text-white "
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    className="w-6 h-6"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        strokeLinecap="round"
                                        strokeLinejoin="round"
                                        strokeWidth={2}
                                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"
                                    />
                                </svg>
                                <p className="text-sm font-sm">Category</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div className="hidden py-3 border-b border-white/10 md:block">
                <div className="container px-10 ">
                    <nav className="flex justify-between items center">
                        <div className="flex items-center gap-x-2">
                            <a
                                href=""
                                className="mr-6 font-medium text-white uppercase"
                            >
                                b4yu 4lex@ndr!4
                            </a>

                            <NavLink href="/home" children="Home" />
                            <NavLink href="/blogs" children="Blogs" />

                            <NavLink href="/categories" children="Category" />
                        </div>

                        <Menu as="div" className="flex items-center gap-x-2 ">
                            <Menu.Button>
                                <NavLink
                                    href="#"
                                    className="flex items-center gap-x-2 hover:bg-transparent"
                                >
                                    {user.name}
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        className="w-6 h-6"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path
                                            strokeLinecap="round"
                                            strokeLinejoin="round"
                                            strokeWidth={2}
                                            d="M19 9l-7 7-7-7"
                                        />
                                    </svg>
                                </NavLink>
                            </Menu.Button>
                            <Transition
                                as={Fragment}
                                enter="transition duration-100 ease-out"
                                enterFrom="transform scale-95 opacity-0"
                                enterTo="transform scale-100 opacity-100"
                                leave="transition duration-75 ease-out"
                                leaveFrom="transform scale-100 opacity-100"
                                leaveTo="transform scale-95 opacity-0"
                            >
                                <Menu.Items className="absolute top-0 right-0 w-40 py-2 overflow-hidden bg-white rounded-lg shadow-md mt-14 mr-36">
                                    <ResponsiveNavLink>
                                        Setting
                                    </ResponsiveNavLink>
                                    <button
                                        onClick={openModal}
                                        className="w-full text-left"
                                    >
                                        <ResponsiveNavLink>
                                            Logout
                                        </ResponsiveNavLink>
                                    </button>
                                </Menu.Items>
                            </Transition>
                        </Menu>
                    </nav>
                </div>
            </div>
        </div>
    );
}
