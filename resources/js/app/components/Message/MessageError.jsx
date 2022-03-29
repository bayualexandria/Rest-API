import React from "react";

export default function MessageError({ error }) {
    return (
        <div>
            {error ? (
                <div className="py-3 px-14">
                    <div className="w-full px-4 py-4 text-sm font-semibold text-white bg-red-500 rounded-sm shadow-sm ">
                        {error}
                    </div>
                </div>
            ) : (
                ""
            )}
        </div>
    );
}
