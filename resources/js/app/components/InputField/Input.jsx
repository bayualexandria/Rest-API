import React from "react";

const Input = ({ title, name, type, error, ...props }) => {
    return (
        <div className="flex flex-col py-3 px-14">
            <label htmlFor={name ? name : "noname"} className="mb-3 text-sm">
                {title ? title : "Input"}
            </label>
            <input
                type={type ? type : "text"}
                className="w-full px-4 py-2 text-gray-600 duration-100 border border-blue-400 rounded-full tansition focus:ring focus:ring-blue-200 outline-blue-400 hover:ring hover:ring-blue-300"
                name={name ? name : "noname"}
                id={name ? name : "noname"}
                {...(props ? props : "")}
            />
            {error ? (
                <div className="mt-3 text-xs text-red-600">
                    <p className="text-red-600">{error[0]}</p>
                </div>
            ) : (
                ""
            )}
        </div>
    );
};

export default Input;
