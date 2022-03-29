import axios from "axios";
import React, { useState,useEffect } from "react";
import ReactDOM from "react-dom";
import App from "../../layouts/App";

export default function Blogs(props) {
    
    const [blogs, setBlogs] = useState([]);
    console.log(props.endpoint);


    useEffect(() => {
      
        // const response = fetch(props)
        console.log(dataDumy);
        console.log(blogs);
      
    }, [])

    const dataDumy = [
        {
            'name':'Bayu Wardana',
            'nim':'G.231.14.0169'
        },{
            'name':'Misbahul Anwar',
            'nim':'G.231.14.0163'
        }
    ]
    
    
    return (
        <App>
            <div className="container">
                <div className="py-5 text-center md:px-20 md:items-center md:justify-between md:flex">
                    <h6 className="text-xl font-semibold text-slate-500">
                        Data Blogs
                    </h6>
                    <a
                        href=""
                        className="px-2 py-1 text-white transition duration-200 rounded shadow-md bg-lime-500 focus:ring focus:ring-lime-300 hover:ring hover:ring-lime-300"
                    >
                       {
                           
                       }
                    </a>
                    
                    
                </div>
                <div className="grid py-5 md:gap-4 md:grid-cols-4">
                    <div className="relative col-span-2 col-start-2 rounded-md shadow-sm">
                        <div className="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none"></div>
                        <input
                            type="text"
                            name="price"
                            id="price"
                            className="focus:ring-blue-500 outline-blue-500 border border-blue-400 focus:border-blue-500 hover:outline-blue-400 block w-full px-5 py-2.5 sm:text-sm  rounded-md "
                            placeholder="Apa yang ingin kamu cari"
                        />
                        <div className="absolute inset-y-0 right-0.5 flex items-center">
                            <button className="bg-blue-800 text-white shadow-sm rounded-sm px-8 py-1.5 hover:ring hover:ring-blue-300 transition duration-200">
                                <i className="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div className="grid gap-4 md:grid-cols-4">
                    <div className="overflow-hidden rounded-md shadow-md">
                        <img
                            src="/images/image.png"
                            alt="content"
                            className="w-full"
                        />
                        <div className="px-5 py-5 space-y-2">
                            <h5 className="text-lg font-medium text-slate-600">Title content</h5>
                            <p className="text-sm font-normal text-slate-500">
                                Lorem ipsum dolor sit amet consectetur
                                adipisicing elit. Animi, natus.
                            </p>
                        </div>
                    </div>

                    <div className="overflow-hidden rounded-md shadow-md">
                        <img
                            src="/images/image.png"
                            alt="content"
                            className="w-full"
                        />
                        <div className="px-5 py-5 space-y-2">
                            <h5 className="text-lg font-medium text-slate-600">Title content</h5>
                            <p className="text-sm font-normal text-slate-500">
                                Lorem ipsum dolor sit amet consectetur
                                adipisicing elit. Animi, natus.
                            </p>
                        </div>
                    </div>

                    <div className="overflow-hidden rounded-md shadow-md">
                        <img
                            src="/images/image.png"
                            alt="content"
                            className="w-full"
                        />
                        <div className="px-5 py-5 space-y-2">
                            <h5 className="text-lg font-medium text-slate-600">Title content</h5>
                            <p className="text-sm font-normal text-slate-500">
                                Lorem ipsum dolor sit amet consectetur
                                adipisicing elit. Animi, natus.
                            </p>
                        </div>
                    </div>

                    <div className="overflow-hidden rounded-md shadow-md">
                        <img
                            src="/images/image.png"
                            alt="content"
                            className="w-full"
                        />
                        <div className="px-5 py-5 space-y-2">
                            <h5 className="text-lg font-medium text-slate-600">Title content</h5>
                            <p className="text-sm font-normal text-slate-500">
                                Lorem ipsum dolor sit amet consectetur
                                adipisicing elit. Animi, natus.
                            </p>
                        </div>
                    </div>

                    <div className="overflow-hidden rounded-md shadow-md">
                        <img
                            src="/images/image.png"
                            alt="content"
                            className="w-full"
                        />
                        <div className="px-5 py-5 space-y-2">
                            <h5 className="text-lg font-medium text-slate-600">Title content</h5>
                            <p className="text-sm font-normal text-slate-500">
                                Lorem ipsum dolor sit amet consectetur
                                adipisicing elit. Animi, natus.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </App>
    );
}

if (document.getElementById("blogs")) {
    var item = document.getElementById("blogs");
    ReactDOM.render(<Blogs endpoint={item.getAttribute("endpoint")} data={item.getAttribute("data")} />, item);
}
