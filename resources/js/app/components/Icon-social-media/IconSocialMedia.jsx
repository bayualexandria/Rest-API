import React from "react";

const IconSocialMedia = ({icon, className,...props}) => {
    return (
        <a
            {...props}
            className={`${
                className
                    ? className
                    : "bg-blue-600 focus:ring-blue-300 hover:text-blue-600 hover:ring-blue-300"
            } flex items-center justify-center w-10 h-10 text-white transition duration-200 border rounded-full shadow hover:bg-white focus:ring hover:ring`}
        >
            <i className={icon}></i>
        </a>
    );
};

export default IconSocialMedia;
