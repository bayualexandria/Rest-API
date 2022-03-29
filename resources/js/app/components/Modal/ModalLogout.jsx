import { Dialog, Transition } from "@headlessui/react";
import axios from "axios";
import React, { Fragment, useState } from "react";
import ResponsiveNavLink from "../Navbar/ResponsiveNavLink";

export default function ModalLogout({setOpen,setModal,modal }) {
    const [loading, setLoading] = useState(false);

    const logoutLink=async()=> {
       try {
           
           console.log("success");
           let response =await axios.post('/logout');
           console.log(response.data);
   
           return (document.location.href = "/login");
       } catch (e) {
           
       }
      
    };

    
    return (
        <>
            <button
                type="button"
                onClick={setModal(true)}
                className="w-full text-left"
            >
                <ResponsiveNavLink>Logout</ResponsiveNavLink>
            </button>
          
                <div className={`${modal?'hidden':'block'} fixed top-0 bottom-0 left-0 right-0 h-64 px-4 py-2 m-auto overflow-hidden transition-all transform bg-white rounded-lg shadow-lg w-96`}                    
                >
                    <div className="py-8 text-center">
                        <div className="flex items-center justify-center">
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
                        </div>
                        <h6 className="mt-2 font-semibold text-gray-600 text-md">
                            {loading
                                ? "Loading ..."
                                : "Apakah anda ingin keluar dari sistem ini?"}
                        </h6>
                        {loading ? (
                            <div className="flex items-center justify-center px-20 mt-8">
                                <i className="text-green-600 fas fa-spinner animate-spin"></i>
                            </div>
                        ) : (
                            <div className="flex items-center justify-between px-20 mt-8">
                                <button
                                    onClick={() => setModal(false)}
                                    className="px-2.5 py-1 text-sm font-normal text-white bg-blue-600 rounded-full shadow-sm hover:bg-white hover:text-blue-600 hover:ring hover:ring-blue-300 transition duration-200 focus:ring focus:ring-blue-300 w-20 border border-blue-300"
                                >
                                    Tidak
                                </button>
                                <form method="post" onSubmit={logoutLink}>
                                    <button
                                        type="submit"
                                        className="px-2.5 py-1 text-sm font-normal text-white bg-red-600 rounded-full shadow-sm hover:bg-white hover:text-red-600 hover:ring hover:ring-red-300 transition duration-200 focus:ring focus:ring-red-300 w-20 border border-red-300"
                                    >
                                        Ya
                                    </button>
                                </form>
                            </div>
                        )}
                    </div>
                </div>
            

           
        </>
    );
}
