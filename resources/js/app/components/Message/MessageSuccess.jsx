import React from "react";

export default function MessageSuccess({ success }) {
    return (
        <div>
            {success ? (
                <div className="py-3 px-14">
                    <div className="w-full px-4 py-4 text-sm font-semibold text-white bg-green-500 rounded-sm shadow-sm">
                        {success}
                    </div>
                </div>
            ) : (
                ""
            )}
        </div>
    );
}
