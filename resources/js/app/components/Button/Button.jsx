import React from "react";

export default function Button({ title, loading, type, className }) {
    return (
        <div className={`${loading ? "flex justify-center" : ""} py-4 px-14`}>
            <button
                type={type ? type : "button"}
                className={`${
                    className
                        ? className
                        : "bg-blue-600  hover:bg-blue-500 focus-within:ring-blue-400"
                } ${
                    loading ? "w-auto" : "w-full"
                } flex items-center rounded-full justify-center  px-4 py-2 text-white transition duration-100  focus:ring`}
            >
                {loading ? (
                    <i className="fas fa-spinner animate-spin"></i>
                ) : title ? (
                    title
                ) : (
                    "Button"
                )}
            </button>
        </div>
    );
}
